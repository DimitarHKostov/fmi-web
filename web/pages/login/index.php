<?php
    session_start();

    if (isset($_COOKIE['web-cookie'])) {
        header('Location: /web/pages/middle/index.php');
        exit;
    }
?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="main">
        <button class="back-button" type="button" onclick="location.href = '../home/index.php';">Back</button>
        <input class="username" type="text" id="username" placeholder="Username">
        <input class="password" type="password" id="password" placeholder="Password"/>
        <button class="login-button" id="login-btn">Log in</button>
        <script defer src="script.js"></script>
        <script defer src="../utils/popUp.js"></script>
    </div>
</body>
</html>