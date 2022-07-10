<?php
session_start();
if (isset($_SESSION['username_student'])) {
    header("location: welcome_student.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style2.css">
    <title>Login Account</title>
    <link rel="icon" type="image/png" href="assets/logo/logo0.png">
</head>

<body>
    <section class="login">
        <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
            <div class="container">
                <div class="card login-card">
                    <div class="row no-gutters">
                        <div class="col-md-6" style="background-color:#f5cb5c">
                            <img src="assets/logo/login.png" alt="login" class="login-card-img pb-4">
                        </div>
                        <div class="col-md-6">
                            <div class="card-body">
                                <div class="brand-wrapper">
                                    <img src="assets/logo/logoSD.png" alt="logo" class="logo">
                                    SD SEA Sentosa
                                </div>
                                <p class="login-card-description">Login as Student</p>
                                <div style="color: red;margin-bottom: 15px;">
                                    <?php
                                    if (isset($_COOKIE["message"])) {
                                        echo $_COOKIE["message"];
                                    }
                                    ?>
                                </div>
                                <form action="process.php" method="post">
                                    <div class="login-details">
                                        <div class="input-box">
                                            <label for="id_student_log" class="sr-only">ID</label>
                                            <input type="text" name="id_student_log" id="id_student_log" class="form-control" placeholder="ID" required autofocus>
                                        </div>
                                        <div class="input-box mb-4">
                                            <label for="password_log" class="sr-only">Password</label>
                                            <input type="password" name="password_log" id="password_log" class="form-control" placeholder="***********" required>
                                        </div>
                                    </div>
                                    <button name="login" id="login" class="btn btn-block login-btn mb-4" type="submit">Login</button>
                                </form>
                                <a class="forgot-password-link">Forgot your password?</a>
                                <p>Didn't have account? <a href="signup.php" class="text-reset">Click in here!</a></p>
                                <nav class="login-card-footer-nav">
                                    <a href="#!">Terms of use.</a>
                                    <a href="#!">Privacy policy</a>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </section>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>

</html>