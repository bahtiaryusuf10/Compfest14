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
                        <div class="col-md-6">
                            <div class="card-body">
                                <div class="brand-wrapper">
                                    <img src="assets/logo/logoSD.png" alt="logo" class="logo">
                                    SD SEA Sentosa
                                </div>
                                <p class="login-card-description">Sign up as Student</p>
                                <form action="process.php" method="post">
                                    <div class="login-details">
                                        <div class="input-box">
                                            <label for="name_student" class="sr-only">Name</label>
                                            <input type="text" name="name_student" id="name_student" class="form-control" placeholder="Name" required autofocus>
                                        </div>
                                        <div class="input-box mb-4">
                                            <label for="id_student_reg" class="sr-only">ID</label>
                                            <input type="text" name="id_student_reg" id="id_student_reg" class="form-control" placeholder="ID" required autofocus>
                                        </div>
                                        <div class="input-box mb-4">
                                            <label for="password_reg" class="sr-only">Password</label>
                                            <input type="password" name="password_reg" id="password_reg" class="form-control" placeholder="***********" required>
                                        </div>
                                    </div>
                                    <button name="signup" id="signup" class="btn btn-block login-btn mb-4" type="submit">Sign up</button>
                                </form>
                                <p>Have an account? <a href="login.php" class="text-reset">Click in here!</a></p>
                                <nav class="login-card-footer-nav">
                                    <a href="#!">Terms of use.</a>
                                    <a href="#!">Privacy policy</a>
                                </nav>
                            </div>
                        </div>
                        <div class="col-md-6" style="background-color:#f5cb5c;">
                            <img src="assets/logo/signup.png" alt="login" class="register-card-img pb-4">
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