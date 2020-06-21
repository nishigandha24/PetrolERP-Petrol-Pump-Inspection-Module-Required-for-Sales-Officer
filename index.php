<?php
error_reporting(0);
$uname = $_POST['uname'];
$pass = $_POST['pass'];
$error = "";
$success = "";
if (isset($_POST['submit'])) {
    if ($uname == "admin") {
        if ($pass == "password") {
            $success = "Welcome admin!!!";
            header("Location:home.php");
        } else {
            $error = "Invalid Password...";
            $success = "";
        }
    } else {
        $error = "Invalid Username";
        $success = "";
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Login </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
        <link rel="stylesheet" type="text/css" href="css/util.css">
        <link rel="stylesheet" type="text/css" href="css/main.css">
    </head>
    <body>
        <div class="limiter">
            <div class="container-login100">
                <div class="wrap-login100">
                    <div class="login100-form-title" style="background-image: url(images/bg-01.jpg);">
                        <span class="login100-form-title-1">
                            Sign In
                        </span>
                    </div>
                    <p style="text-align: center; color: blue" class="error"><?php echo $error; ?></p>
                    <p style="text-align: center; color: blue" class="success"><?php echo $success; ?></p>
                    <form class="login100-form validate-form" target="_self"  method="post">
                        <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
                            <span class="label-input100">Username</span>
                            <input class="input100" type="text" name="uname" placeholder="Enter username" required>
                            <span class="focus-input100"></span>
                        </div>
                        <div class="wrap-input100 validate-input m-b-18" data-validate = "Password is required">
                            <span class="label-input100">Password</span>
                            <input class="input100" type="password" name="pass" placeholder="Enter password" required>
                            <span class="focus-input100"></span>
                        </div>
                        <div class="flex-sb-m w-full p-b-30">
                        </div>
                        <div class="container-login100-form-btn">
                            <input class="login100-form-btn" type="submit" name="submit" value="Login">		
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="js/jquery.min.js" type="text/javascript"></script>
        <script src="js/jquery-3.3.1.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="js/main.js"></script>
    </body>
</html>