<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="icon" href="../usjr_app new/graphics/usjr-logo.png" type="image">
    <link rel="stylesheet" href="../usjr_app new/css/login.css">
</head>
<body>
    <div class="school-container">
        <img src="../usjr_app new/graphics/school.jpg" alt="">
    </div>
    <div class="login-container">
        <form action="processlogin.php" method="post">
            <div class="greetings">
                <h1>Welcome Back!</h1>
                <h2>Login</h2>
            </div>
            <div class="input-fields">
                <img src="../usjr_app new/graphics/user-icon.png" alt="">
                <input type="text" name="username" id="username" placeholder="Username">
            </div>
            <div class="input-fields">
            <img src="../usjr_app new/graphics/lock-icon.png" alt="">
                <input type="password" name="password" id="password" placeholder="Password">
            </div>
            <div class="buttons">
                <button name="login-btn" id="login-btn">Login</button>
            </div>
            <div class="register">
                <p>Don't have an account?</p>
                <a href="reguser.php" id="signup-btn">Sign-up here!</a>
            </div>
        </form>
    </div>
</body>
</html>