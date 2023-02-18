<?php

session_start();

require_once __DIR__ . "./../database/database/queries/login_queries/login_queries.php";
require_once __DIR__ . "/objects/login_data.php";
require_once __DIR__ . "/chain/chain.php";
require_once __DIR__ . "/validation/validation.php";
require_once __DIR__ . "/validation/login_validation.php";
require_once __DIR__ . "/verifier/password_verifier.php";
require_once __DIR__ . "/common/common.php";

function handleLogin() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if (json_last_error() === JSON_ERROR_NONE) {
            $loginData = LoginData::constructOutOfJson($data);
            $valid = Chain::apply(new LoginValidation($loginData));

            if(!$valid) {
                return "Unprocessable entity. Please check the documentation.";
            }

            $loginQueries = new LoginQueries();

            $passwordHash = $loginQueries->extractPasswordHash($loginData);

            if ($passwordHash == null) {
                return "Unauthorized.";
            }

            $areCredentialsCorrect = PasswordVerifier::verify($loginData->getPassword(), $passwordHash);
 
            if ($areCredentialsCorrect) {
                $uuid = $loginQueries->extractUuid($loginData);
                $expiration = time() + (1000);
                setcookie('web-cookie', $uuid, $expiration, '/');

                $role = $loginQueries->extractRole($loginData);

                if($role == '1') {
                    $_SESSION['role'] = "admin";
                } else {
                    $_SESSION['role'] = "regular";
                }

                return "Success";
            } else {
                return "Unauthorized.";
            }
        } else {
            return "Format not json.";
        }
    } else {
        return "Method not allowed.";
    }
}

$result = handleLogin();

switch($result) {
    case 'Method not allowed.': handleMethodNotAllowed($result); break;
    case 'Format not json.': handleFormatNotJson($result); break;
    case 'Success': handleSuccess(); break;
    case 'Unauthorized.': handleUnauthorized($result); break;
    case 'Unprocessable entity. Please check the documentation.': handleUnprocessable($result); break;
    default: handleSuccess(); break;
}