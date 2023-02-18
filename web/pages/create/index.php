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
    <title>Create</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="main">
        <div class="main-upper">
            <button class="back-button" type="button" onclick="location.href = '../middle/index.php';">Back</button>
            <button class="logout-button" id="logout-btn">Log out</button>
        </div>

        <div class="main-lower">
            <input class="name" type="text" id="name" placeholder="Event name">
            <input class="beneficier" type="text" id="beneficier" placeholder="Beneficier(email)">
            <input class="iban" type="text" id="iban" placeholder="IBAN">
            <input class="description" type="text" id="description" placeholder="Description">
            <button class="create-button" id="create-btn">Create</button>
        </div>
        
        <script defer src="script.js"></script>
        <script defer src="../utils/popUp.js"></script>
    </div>
</body>
</html>