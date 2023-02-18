<?php
    session_start();
    
    if (!isset($_COOKIE['web-cookie'])) {
        header('Location: /web/pages/login/index.php');
        exit;
    }

    if ($_SESSION['role'] != 'admin') {
        header('Location: /web/pages/middle/index.php');
        exit;
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Home</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="main">
        <div class="main-upper">
            <button class="back-button" type="button" onclick="location.href = '../adminui-middle/index.php';">Back</button>
            <button class="logout-button" id="logout-btn">Log out</button>
        </div>

        <div class="main-lower">
            <div class="message">
                Enter the email of the user you want to give admin rights to.
            </div>

            <input class="email" type="text" id="email" placeholder="Email">

            <button class="give-button" id="give-btn">Give admin rights</button>
        </div>
        
        <script defer src="script.js"></script>
        <script defer src="../utils/popUp.js"></script>
    </div>
</body>
</html>