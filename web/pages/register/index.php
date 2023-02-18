<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Register</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="main">
        <button class="back-button" type="button" onclick="location.href = '../home/index.php';">Back</button>
        <input class="username" type="text" id="username" placeholder="Username">
        <input class="password" type="password" id="password" placeholder="Password"/>
        <input class="firstName" type="text" id="firstName" placeholder="First name"/>
        <input class="lastName" type="text" id="lastName" placeholder="Last name"/>
        <input class="email" type="email" id="email" placeholder="Email"/>
        <button class="register-button" id="register-btn">Register</button>
        <script defer src="script.js"></script>
        <script defer src="../utils/popUp.js"></script>
    </div>
</body>
</html>