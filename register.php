<?php
session_start();
require_once "connect.php";

$errors = [];
$success = false;
$first_name = "";
$last_name = "";
$email = "";
$role = "student";
$image = null;
$agree_terms = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $first_name = trim($_POST["first_name"] ?? "");
    $last_name = trim($_POST["last_name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";
    $confirm_password = $_POST["confirm_password"] ?? "";
    $role = $_POST["role"] ?? "student";
    $agree_terms = isset($_POST["agree_terms"]);

    if ($first_name === "") {
        $errors[] = "Please enter your first name.";
    } elseif (mb_strlen($first_name) > 50) {
        $errors[] = "First name is too long.";
    }

    if ($last_name === "") {
        $errors[] = "Please enter your last name.";
    } elseif (mb_strlen($last_name) > 50) {
        $errors[] = "Last name is too long.";
    }

    if ($email === "") {
        $errors[] = "Please enter your email.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }

    if ($password === "") {
        $errors[] = "Please enter a password.";
    } elseif (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters.";
    }

    if ($confirm_password === "") {
        $errors[] = "Please confirm your password.";
    } elseif ($password !== $confirm_password) {
        $errors[] = "Password and confirm password do not match.";
    }

    if (!in_array($role, ["student", "instructor"], true)) {
        $errors[] = "Invalid role selected.";
    }

    if (!$agree_terms) {
        $errors[] = "You must agree to the Terms of Service and Privacy Policy.";
    }

    if (empty($errors)) {
        $checkSql = "SELECT id FROM users WHERE email = ? LIMIT 1";
        $checkStmt = mysqli_prepare($conn, $checkSql);

        if ($checkStmt) {
            mysqli_stmt_bind_param($checkStmt, "s", $email);
            mysqli_stmt_execute($checkStmt);
            mysqli_stmt_store_result($checkStmt);

            if (mysqli_stmt_num_rows($checkStmt) > 0) {
                $errors[] = "This email is already registered. Please login.";
            }

            mysqli_stmt_close($checkStmt);
        } else {
            $errors[] = "An error occurred while checking your email.";
        }
    }

    if (empty($errors) && isset($_FILES["image"]) && $_FILES["image"]["error"] !== UPLOAD_ERR_NO_FILE) {
        if ($_FILES["image"]["error"] !== UPLOAD_ERR_OK) {
            $errors[] = "There was an error uploading the image.";
        } else {
            $allowedTypes = ["image/jpeg", "image/png", "image/webp"];
            $fileType = mime_content_type($_FILES["image"]["tmp_name"]);

            if (!in_array($fileType, $allowedTypes, true)) {
                $errors[] = "Only JPG, PNG and WEBP images are allowed.";
            } elseif ($_FILES["image"]["size"] > 2 * 1024 * 1024) {
                $errors[] = "Image size must be less than 2MB.";
            } else {
                $extension = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
                $fileName = uniqid("profile_", true) . "." . $extension;
                $uploadDir = "uploads/profile/";

                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                $destination = $uploadDir . $fileName;

                if (move_uploaded_file($_FILES["image"]["tmp_name"], $destination)) {
                    $image = $destination;
                } else {
                    $errors[] = "Failed to save the profile image.";
                }
            }
        }
    }

    if (empty($errors)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $insertSql = "INSERT INTO users (first_name, last_name, email, password, image, role) VALUES (?, ?, ?, ?, ?, ?)";
        $insertStmt = mysqli_prepare($conn, $insertSql);

        if ($insertStmt) {
            mysqli_stmt_bind_param(
                $insertStmt,
                "ssssss",
                $first_name,
                $last_name,
                $email,
                $hashedPassword,
                $image,
                $role
            );

            if (mysqli_stmt_execute($insertStmt)) {
                $success = true;
                $first_name = "";
                $last_name = "";
                $email = "";
                $role = "student";
                $image = null;
                $agree_terms = false;
            } else {
                $errors[] = "An error occurred while creating your account.";
            }

            mysqli_stmt_close($insertStmt);
        } else {
            $errors[] = "Database error.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join Tech Journey</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/register.css">
</head>

<body>

    <?php require_once "includes/navbar.php"; ?>

    <div class="wrapper">
        <div class="register-card">
            <div class="illustration">
                <div class="tech-illustration">
                    <svg viewBox="0 0 650 600" xmlns="http://www.w3.org/2000/svg">
                        <g fill="#8b5cf6">
                            <path d="M100 150 L105 164 L120 169 L105 174 L100 190 L95 174 L80 169 L95 164 Z" />
                            <path d="M530 135 L535 149 L550 154 L535 159 L530 175 L525 159 L510 154 L525 149 Z" />
                            <path d="M560 335 L564 346 L576 350 L564 354 L560 366 L556 354 L544 350 L556 346 Z" />
                            <path d="M125 360 L129 371 L141 375 L129 379 L125 390 L121 379 L109 375 Z" />
                        </g>

                        <g fill="#fff">
                            <path d="M170 110 L174 122 L186 126 L174 130 L170 142 L166 130 L154 126 L166 122 Z" />
                            <path d="M490 215 L494 227 L506 231 L494 235 L490 247 L486 235 L474 231 L486 227 Z" />
                            <path d="M200 420 L204 432 L216 436 L204 440 L200 452 L196 440 L184 436 L196 432 Z" />
                        </g>

                        <g class="float-icon">
                            <rect x="72" y="235" width="100" height="100" rx="22" fill="#7544e8" />
                            <rect x="78" y="241" width="88" height="88" rx="19" fill="#6738d7" />
                            <path d="M103 285 L88 297 L103 309" stroke="#fff" stroke-width="8" stroke-linecap="round"
                                stroke-linejoin="round" fill="none" />
                            <path d="M141 285 L156 297 L141 309" stroke="#fff" stroke-width="8" stroke-linecap="round"
                                stroke-linejoin="round" fill="none" />
                            <path d="M132 278 L116 316" stroke="#fff" stroke-width="8" stroke-linecap="round" />
                        </g>

                        <g class="float-icon">
                            <rect x="475" y="235" width="100" height="100" rx="22" fill="#7544e8" />
                            <rect x="481" y="241" width="88" height="88" rx="19" fill="#6738d7" />
                            <path d="M513 268 L513 312 L548 290 Z" fill="#fff" />
                        </g>

                        <g class="float-icon">
                            <rect x="70" y="365" width="92" height="92" rx="20" fill="#7b4ae8" />
                            <path d="M91 388 C102 383 114 385 124 391 L124 428 C113 422 102 420 91 425 Z" fill="#fff" />
                            <path d="M124 391 C135 385 147 383 158 388 L158 425 C147 420 136 422 124 428 Z"
                                fill="#f8f7ff" />
                        </g>

                        <g class="float-icon">
                            <rect x="490" y="370" width="92" height="92" rx="20" fill="#fff" />
                            <rect x="510" y="421" width="10" height="21" rx="3" fill="#7444e8" />
                            <rect x="527" y="407" width="10" height="35" rx="3" fill="#7444e8" />
                            <rect x="544" y="390" width="10" height="52" rx="3" fill="#7444e8" />
                        </g>

                        <rect x="185" y="310" width="280" height="180" rx="12" fill="#17134d" />
                        <rect x="198" y="323" width="254" height="154" rx="6" fill="#eeeaff" />
                        <circle cx="218" cy="343" r="5" fill="#9b7bea" />
                        <circle cx="235" cy="343" r="5" fill="#c2b2ff" />
                        <circle cx="252" cy="343" r="5" fill="#d7cdff" />
                        <rect x="220" y="360" width="210" height="92" rx="8" fill="#dcd4ff" />
                        <path d="M318 445 C315 463 320 478 330 489 C340 477 345 463 342 445 Z" fill="#ffcf70" />
                        <path d="M327 450 C326 463 329 470 334 477 C338 468 339 459 337 450 Z" fill="#fff" />

                        <path
                            d="M334 185 C294 220 286 280 296 350 C302 389 317 419 334 438 C351 419 366 389 372 350 C382 280 374 220 334 185 Z"
                            fill="#fff" />
                        <path d="M334 185 C318 199 306 216 300 238 L368 238 C362 216 350 199 334 185 Z"
                            fill="#6540d8" />
                        <circle cx="334" cy="295" r="27" fill="#6c43dc" />
                        <circle cx="334" cy="295" r="16" fill="#f4f1ff" />
                        <path d="M298 332 C276 345 266 370 270 400 C283 392 296 382 306 365 Z" fill="#5330c7" />
                        <path d="M370 332 C392 345 402 370 398 400 C385 392 372 382 362 365 Z" fill="#5330c7" />
                        <path d="M334 330 L334 390" stroke="#6740d7" stroke-width="8" stroke-linecap="round" />

                        <path
                            d="M175 490 L475 490 L505 520 C510 526 505 534 496 534 L172 534 C163 534 158 526 163 520 Z"
                            fill="#5432c7" />
                        <path d="M205 493 L445 493 L460 512 L190 512 Z" fill="#7d5ae2" />
                        <rect x="285" y="513" width="100" height="9" rx="4" fill="#9b82ef" />

                        <g fill="#fff">
                            <circle cx="235" cy="445" r="18" />
                            <circle cx="253" cy="437" r="25" />
                            <circle cx="280" cy="448" r="17" />
                            <rect x="220" y="445" width="78" height="20" rx="10" />
                            <circle cx="382" cy="444" r="17" />
                            <circle cx="402" cy="437" r="23" />
                            <circle cx="425" cy="447" r="16" />
                            <rect x="370" y="445" width="70" height="20" rx="10" />
                        </g>

                        <ellipse cx="335" cy="555" rx="220" ry="20" fill="#d8cff7" />
                    </svg>
                </div>
            </div>

            <div class="form-side">
                <h1>Join Tech Journey 🚀</h1>
                <p class="subtitle">Create an account to unlock amazing resources</p>

                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger">
                        <strong>Please fix the following:</strong>
                        <ul>
                            <?php foreach ($errors as $err): ?>
                                <li><?= htmlspecialchars($err) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <?php if ($success): ?>
                    <div class="alert alert-success">
                        Account created successfully! 🎉
                        <a href="login.php">Login now</a>
                    </div>
                <?php endif; ?>

                <form method="POST" enctype="multipart/form-data" novalidate>
                    <div class="form-row">
                        <div class="form-group">
                            <label>First Name</label>
                            <div class="input-wrap">
                                <input type="text" name="first_name" placeholder="Enter your first name"
                                    value="<?= htmlspecialchars($first_name) ?>" required>
                                <span class="icon">👤</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Last Name</label>
                            <div class="input-wrap">
                                <input type="text" name="last_name" placeholder="Enter your last name"
                                    value="<?= htmlspecialchars($last_name) ?>" required>
                                <span class="icon">👤</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <div class="input-wrap">
                            <input type="email" name="email" placeholder="Enter your email"
                                value="<?= htmlspecialchars($email) ?>" required>
                            <span class="icon">✉️</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <div class="input-wrap">
                            <input type="password" name="password" placeholder="Create a password" required>
                            <span class="icon">🔒</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Confirm Password</label>
                        <div class="input-wrap">
                            <input type="password" name="confirm_password" placeholder="Confirm your password" required>
                            <span class="icon">🔒</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Profile Picture</label>
                        <div class="custom-file">
                            <input type="file" name="image" id="profileImage" accept="image/jpeg,image/png,image/webp">
                            <label for="profileImage" class="choose-file-btn">
                                <span class="upload-icon">↑</span>
                                Choose File
                            </label>
                            <span class="file-name" id="fileName">No file chosen</span>
                        </div>
                        <small class="file-note">Optional - JPG, PNG or WEBP, maximum 2MB</small>
                    </div>

                    <div class="form-group">
                        <label>Choose your role</label>
                        <div class="role-options">
                            <label class="role-card">
                                <input type="radio" name="role" value="student" <?= $role === "student" ? "checked" : "" ?>>
                                <div>
                                    <strong>🎓 Student</strong>
                                    <small>I'm here to learn and develop my skills.</small>
                                </div>
                            </label>

                            <label class="role-card">
                                <input type="radio" name="role" value="instructor" <?= $role === "instructor" ? "checked" : "" ?>>
                                <div>
                                    <strong>👨‍🏫 Instructor</strong>
                                    <small>I'm here to teach and share my knowledge.</small>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="terms">
                        <input type="checkbox" id="agree_terms" name="agree_terms" <?= $agree_terms ? "checked" : "" ?>>
                        <label for="agree_terms">
                            I agree to
                            <a href="#">Terms of Service</a>
                            and
                            <a href="#">Privacy Policy</a>
                        </label>
                    </div>

                    <button type="submit" class="submit-btn">Create Account</button>
                </form>

                <p class="footer-text">
                    Already have an account?
                    <a href="login.php">Login</a>
                </p>
            </div>
        </div>
    </div>

    <script>
        const profileImage = document.getElementById("profileImage");
        const fileName = document.getElementById("fileName");

        profileImage.addEventListener("change", function () {
            if (this.files.length > 0) {
                fileName.textContent = this.files[0].name;
                fileName.classList.add("selected");
            } else {
                fileName.textContent = "No file chosen";
                fileName.classList.remove("selected");
            }
        });
    </script>

</body>

</html>