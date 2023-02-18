<?php

require_once __DIR__ . "/common/common.php";

session_start();

function handleLogout() {
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        session_destroy();
        setcookie('web-cookie', "", time() - 3600, "/");
        
        return "Success";
    } else {
        return "Method not allowed.";
    }
}

$result = handleLogout();

switch($result) {
    case 'Method not allowed.': handleMethodNotAllowed($result); break;
    case 'Success': handleSuccess(); break;
    default: handleSuccess(); break;
}