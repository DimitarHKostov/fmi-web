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
    <title>Login</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="main">
        <button class="logout-button" id="logout-btn">Log out</button>
        <button class="view-button" id="view-btn">View</button>
        <button class="create-button" id="create-btn">Create</button>
        <script defer src="script.js"></script>
        <script defer src="../utils/popUp.js"></script>
        <?php if ($_SESSION['role'] == 'admin') { ?>
            <button class="adminui-button" id="adminui-btn">Admin UI</button>
        <?php } ?>
    </div>
</body>
</html>