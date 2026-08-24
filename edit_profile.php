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
$initials = student_initials($user);
?>

<div class="evt-page-wrapper container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card evt-edit-form-card p-4 mb-5">
                <h2 class="text-center mb-4 fw-bold text-purple">Edit Profile</h2>

                <?php if ($error): ?>
                    <div class="alert alert-danger">
                        <?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>

                <form method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name"
                                value="<?= htmlspecialchars($user['first_name']) ?>" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name"
                                value="<?= htmlspecialchars($user['last_name']) ?>" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="<?= htmlspecialchars($user['email']) ?>" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="role" class="form-label">Role</label>
                            <input type="text" class="form-control" id="role"
                                value="<?= htmlspecialchars(ucfirst($_SESSION['role'] ?? '')) ?>" disabled>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Leave empty to keep current">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="password_confirmation" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation" placeholder="Repeat new password">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label d-block">Current Photo</label>
                        <?php if (!empty($user['image'])): ?>
                            <img src="<?= htmlspecialchars($user['image']) ?>" alt="Profile Photo"
                                style="height: 120px; width: 120px; object-fit: cover; border-radius: 50%;" class="mb-2">
                        <?php else: ?>
                            <p class="text-muted small">No photo uploaded</p>
                        <?php endif; ?>
                    </div>

                    <div class="mb-4">
                        <label for="profilePhotoInput" class="form-label">Replace Profile Photo (optional)</label>

                        <div class="custom-file">
                            <input type="file" name="image" id="profilePhotoInput" accept=".jpg,.jpeg,.png,.webp">

                            <label for="profilePhotoInput" class="choose-file-btn">
                                <span class="upload-icon">↑</span>
                                Choose File
                            </label>

                            <span class="file-name" id="selectedPhotoPath">No file chosen</span>
                        </div>

                        <small class="file-note">
                            Optional - JPG, PNG or WEBP, maximum 5MB
                        </small>

                        <?php if (!empty($user['image'])): ?>
                            <button type="submit" name="delete_photo" value="1" class="btn btn-outline-danger btn-sm mt-3">
                                Delete Photo
                            </button>
                        <?php endif; ?>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-save w-100 py-2 fw-bold">
                            Save Changes
                        </button>
                        <a href="profile.php" class="btn btn-outline-secondary w-100 py-2 fw-bold text-center">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('profilePhotoInput').addEventListener('change', function (e) {
        const label = document.getElementById('selectedPhotoPath');
        if (e.target.files.length) {
            label.textContent = e.target.files[0].name;
            label.classList.add('selected');
        } else {
            label.textContent = 'No file chosen';
            label.classList.remove('selected');
        }
    });
</script>

<?php include 'includes/footer.php'; ?>