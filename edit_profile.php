<?php
session_start();
require_once 'connect.php';
require_once 'student_helpers.php';
if (!isset($_SESSION['user_id']) || !in_array(($_SESSION['role'] ?? ''), ['student', 'instructor'], true)) {
    header('Location: login.php');
    exit;
}
$uid = (int) $_SESSION['user_id'];
$s = mysqli_prepare($conn, 'SELECT * FROM users WHERE id=? LIMIT 1');
mysqli_stmt_bind_param($s, 'i', $uid);
mysqli_stmt_execute($s);
$user = mysqli_fetch_assoc(mysqli_stmt_get_result($s));
mysqli_stmt_close($s);
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first = trim($_POST['first_name'] ?? '');
    $last = trim($_POST['last_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $pass = $_POST['password'] ?? '';
    $confirm = $_POST['password_confirmation'] ?? '';
    $image = $user['image'] ?? '';
    if ($first === '' || $last === '' || !filter_var($email, FILTER_VALIDATE_EMAIL))
        $error = 'Please enter valid personal data.';
    elseif ($pass !== '' && strlen($pass) < 6)
        $error = 'Password must be at least 6 characters.';
    elseif ($pass !== $confirm)
        $error = 'Password confirmation does not match.';
    if (isset($_POST['delete_photo'])) {
        $image = '';
    }
    if (!$error && isset($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, ['jpg', 'jpeg', 'png', 'webp'], true) || $_FILES['image']['size'] > 5242880)
            $error = 'Choose JPG, PNG or WEBP up to 5MB.';
        else {
            if (!is_dir('upload/profile'))
                mkdir('upload/profile', 0777, true);
            $new = 'upload/profile/profile_' . $uid . '_' . time() . '.' . $ext;
            if (move_uploaded_file($_FILES['image']['tmp_name'], $new))
                $image = $new;
            else
                $error = 'Could not upload the photo.';
        }
    }
    if (!$error) {
        if ($pass !== '') {
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $q = mysqli_prepare($conn, 'UPDATE users SET first_name=?,last_name=?,email=?,password=?,image=? WHERE id=?');
            mysqli_stmt_bind_param($q, 'sssssi', $first, $last, $email, $hash, $image, $uid);
        } else {
            $q = mysqli_prepare($conn, 'UPDATE users SET first_name=?,last_name=?,email=?,image=? WHERE id=?');
            mysqli_stmt_bind_param($q, 'ssssi', $first, $last, $email, $image, $uid);
        }
        if (mysqli_stmt_execute($q)) {
            if ($image !== ($user['image'] ?? '') && !empty($user['image']) && file_exists($user['image']))
                @unlink($user['image']);
            $_SESSION['user_name'] = $first . ' ' . $last;
            $_SESSION['user_email'] = $email;
            $_SESSION['user_image'] = $image;
            header('Location: profile.php?updated=1');
            exit;
        }
        mysqli_stmt_close($q);
        $error = 'Could not save changes.';
    }
}
$pageTitle = 'Edit Profile';
include 'includes/navbar.php';
$initials = student_initials($user); ?>
<main class="profile-edit-page">
    <div class="container">
        <div class="profile-edit-card">
            <h1>Edit Profile</h1>
            <p>Update any of your personal data.</p><?php if ($error): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div><?php endif; ?>
            <form method="post" enctype="multipart/form-data">
                <div class="row g-3">
                    <div class="col-md-6"><label class="form-label">First Name</label><input class="form-control"
                            name="first_name" value="<?= htmlspecialchars($user['first_name']) ?>" required></div>
                    <div class="col-md-6"><label class="form-label">Last Name</label><input class="form-control"
                            name="last_name" value="<?= htmlspecialchars($user['last_name']) ?>" required></div>
                    <div class="col-12"><label class="form-label">Email</label><input class="form-control" type="email"
                            name="email" value="<?= htmlspecialchars($user['email']) ?>" required></div>
                    <div class="col-md-6"><label class="form-label">New Password</label><input class="form-control"
                            type="password" name="password" placeholder="Leave empty to keep current"></div>
                    <div class="col-md-6"><label class="form-label">Confirm New Password</label><input
                            class="form-control" type="password" name="password_confirmation"
                            placeholder="Repeat new password"></div>
                </div><label class="form-label mt-4">Profile Photo</label>
                <div class="profile-photo-edit">
                    <div class="avatar"><?php if (!empty($user['image'])): ?><img
                                src="<?= htmlspecialchars($user['image']) ?>"
                                alt="Profile Photo"><?php else: ?><span><?= htmlspecialchars($initials) ?></span><?php endif; ?>
                    </div>
                    <div><strong>Profile Photo</strong>
                        <div class="text-muted small">Choose Photo — the selected file will appear below.</div>
                    </div>
                </div>
                <div class="photo-file-wrap"><input class="form-control" type="file" name="image"
                        accept=".jpg,.jpeg,.png,.webp" id="profilePhotoInput"><?php if (!empty($user['image'])): ?><button
                            type="submit" name="delete_photo" value="1" class="delete-photo">Delete
                            Photo</button><?php endif; ?></div>
                <div id="selectedPhotoPath" class="small text-muted mt-2">No new photo selected</div>
                <div class="d-flex gap-2 mt-4"><button class="learn-more-btn" type="submit">Save Changes</button><a
                        class="login-btn" href="profile.php">Cancel</a></div>
            </form>
        </div>
    </div>
</main>
<script>document.getElementById('profilePhotoInput').addEventListener('change', e => { document.getElementById('selectedPhotoPath').textContent = e.target.files.length ? e.target.value : 'No new photo selected'; });</script>
<?php include 'includes/footer.php'; ?>