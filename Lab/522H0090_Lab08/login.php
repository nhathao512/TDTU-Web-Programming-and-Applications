<?php


session_start();
if (isset($_SESSION['user'])) {
    header('Location: index.php');
    exit();
}

$error = '';

$user = 'admin';
$pass = '123456';

if (isset($_POST['user']) && isset($_POST['pass'])) {
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    if (empty($user)) {
        $error = 'Please enter your username';
    } else if (empty($pass)) {
        $error = 'Please enter your password';
    } else if (strlen($pass) < 6) {
        $error = 'Password must have at least 6 characters';
    } else if ($user == 'admin' && $pass == '123456') {
        // success

        $_SESSION['user'] = 'admin';
        $_SESSION['name'] = 'Mai Van Manh';

        header('Location: index.php');
        exit();
    } else {
        $error = 'Invalid username or password';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>User Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <h3 class="text-center text-secondary mt-5 mb-3">User Login</h3>
                <form method="post" action="" class="border rounded w-100 mb-5 mx-auto px-3 pt-3 bg-light">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input value="<?= $user ?>" name="user" id="user" type="text" class="form-control" placeholder="Username">
                    </div>



                    <div class="form-group">
                        <label for="pass">Password</label>
                        <div class="input-group">
                            <input value="<?= $pass ?>" name="pass" required class="form-control" type="password" placeholder="Password" id="pass">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="togglePassVisibility" onclick="togglePasswordVisibility('pass')">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                        <div class="invalid-feedback">Password is not valid.</div>
                    </div>


                    <div class="form-group custom-control custom-checkbox">
                        <input <?= isset($_POST['remember']) ? 'checked' : '' ?> name="remember" type="checkbox" class="custom-control-input" id="remember">
                        <label class="custom-control-label" for="remember">Remember login</label>
                    </div>
                    <div class="form-group">
                        <?php
                        if (!empty($error)) {
                            echo "<div class='alert alert-danger'>$error</div>";
                        }
                        ?>
                        <button class="btn btn-success px-5">Login</button>
                    </div>
                    <div class="form-group">
                        <p>Don't have an account yet? <a href="register.php">Register now</a>.</p>
                        <p>Forgot your password? <a href="forgot.php">Reset your password</a>.</p>
                    </div>
                </form>
                <p class="text-danger">Đăng nhập bằng tài khoản: <strong>admin</strong> - <strong>123456</strong></p>
                <p class="text-danger">Username và mật khẩu này đang viết trực tiếp trong code, cần bổ sung chức năng đọc database để lấy username và mật khẩu trong database</p>
            </div>
        </div>
    </div>

    <script>
        function togglePasswordVisibility(inputId) {
            var passwordInput = document.getElementById(inputId);
            var buttonIcon = document.getElementById('toggle' + inputId.charAt(0).toUpperCase() + inputId.slice(1) + 'Visibility').querySelector('i');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                buttonIcon.classList.remove('fa-eye');
                buttonIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                buttonIcon.classList.remove('fa-eye-slash');
                buttonIcon.classList.add('fa-eye');
            }
        }
    </script>

</body>

</html>