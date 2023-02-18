<?php
    session_start();
    
    if (!isset($_COOKIE['web-cookie'])) {
        header('Location: /web/pages/login/index.php');
        exit;
    }
?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>View-middle</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="main">
        <div class="main-upper">
            <button class="back-button" type="button" onclick="location.href = '../middle/index.php';">Back</button>
            <button class="logout-button" id="logout-btn">Log out</button>
        </div>

        <div class="main-lower">
            <button class="view-my-button" id="view-btn" onclick="location.href = '../view-my/index.php';">View events created by me</button>
            <button class="view-others-button" id="create-btn" onclick="location.href = '../view-others/index.php';">View other events</button>
        </div>

        <script defer src="script.js"></script>
        <script defer src="../utils/popUp.js"></script>
    </div>
</body>
</html>