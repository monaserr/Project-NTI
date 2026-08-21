<?php
if (isset($_POST['login'])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Tech Journey</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        .login-page {
            background-color: #F8FAFC;
            color: #0F172A;
            padding: 40px 20px 50px;
        }

        .login-page .login-card {
            width: 100%;
            max-width: 850px;
            margin: 60px auto 0;
            background-color: #FFFFFF;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(15, 23, 42, 0.08);
        }

        .login-page .login-image {
            min-height: 430px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #F8FAFC;
            padding: 20px;
            overflow: hidden;
        }

        .login-page .login-image img {
            width: 85%;
            max-width: 350px;
            height: auto;
            object-fit: contain;
        }

        .login-page .login-form {
            padding: 45px;
        }

        .login-page .login-form h1 {
            color: #1E3A8A;
            font-size: 30px;
            font-weight: 700;
            margin: 0 0 8px;
        }

        .login-page .login-subtitle {
            color: #64748B;
            font-size: 16px;
            margin: 0 0 30px;
        }

        .login-page .form-label {
            color: #0F172A;
            font-weight: 600;
            margin-bottom: 7px;
        }

        .login-page .form-control {
            height: 48px;
            border: 1px solid #E2E8F0;
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 15px;
        }

        .login-page .form-control:focus {
            border-color: #2563EB;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.10);
        }

        .login-page .remember {
            color: #64748B;
            font-size: 14px;
        }

        .login-page .forgot-password {
            color: #7C3AED;
            text-decoration: none;
            font-size: 14px;
        }

        .login-page .forgot-password:hover {
            color: #1E3A8A;
        }

        .login-page .login-btn {
            width: 100%;
            height: 48px;
            border: none;
            border-radius: 8px;
            background-color: #2563EB;
            color: #FFFFFF;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
        }

        .login-page .login-btn:hover {
            background-color: #1E3A8A;
        }

        .login-page .signup-text {
            text-align: center;
            color: #64748B;
            margin: 22px 0 0;
        }

        .login-page .signup-text a {
            color: #2563EB;
            text-decoration: none;
            font-weight: 600;
        }

        .login-page .signup-text a:hover {
            color: #1E3A8A;
        }

        @media (max-width: 768px) {
            .login-page {
                padding: 25px 15px 40px;
            }

            .login-page .login-card {
                margin-top: 30px;
            }

            .login-page .login-image {
                min-height: 250px;
                padding: 15px;
            }

            .login-page .login-image img {
                width: 70%;
                max-width: 260px;
            }

            .login-page .login-form {
                padding: 30px 25px;
            }

            .login-page .login-form h1 {
                font-size: 27px;
            }
        }
    </style>
</head>
<body>
    <?php include 'includes/navbar.php'; ?>

    <main class="login-page">
        <div class="login-card">
            <div class="row g-0">
                <div class="col-md-6">
                    <div class="login-image">
                        <img src="images\login-boy.png" alt="Tech Journey Login">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="login-form">
                        <h1>Welcome Back 👋</h1>
                        <p class="login-subtitle">Login to your account</p>

                        <form method="POST">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter your email">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Enter your password">
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember">
                                    <label class="form-check-label remember" for="remember">Remember me</label>
                                </div>
                            </div>

                            <button type="submit" name="login" class="login-btn">Login</button>

                            <p class="signup-text">
                                Don't have an account?
                                <a href="register.php">Sign Up</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>
</html>