<?php

require_once __DIR__ . "./../database/database/queries/register_queries/register_queries.php";
require_once __DIR__ . "/objects/user.php";
require_once __DIR__ . "/chain/chain.php";
require_once __DIR__ . "/validation/validation.php";
require_once __DIR__ . "/validation/register_validation.php";
require_once __DIR__ . "/uuid/uuid_generator.php";
require_once __DIR__ . "/common/common.php";

function handleRegister() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if (json_last_error() === JSON_ERROR_NONE) {
            $user = User::constructOutOfJson($data);
            $valid = Chain::apply(new RegisterValidation($user));

            if(!$valid) {
                return "Unprocessable entity. Please check the documentation";
            }

            $user->hashPassword();
            $registerQueries = new RegisterQueries();
            $collisionDetected = $registerQueries->isThereCollision($user);

            if($collisionDetected) {
                return "Another user with the same username or email already exists.";
            }

            $uuid = UuidGenerator::generate();
            $registered = $registerQueries->registerUser($user, $uuid);

            return "Success";
        } else {
            return "Format not json.";
        }
    } else {
        return "Method not allowed.";
    }
}

$result = handleRegister();

switch($result) {
    case 'Method not allowed.': handleMethodNotAllowed($result); break;
    case 'Format not json.': handleFormatNotJson($result); break;
    case "Another user with the same username or email already exists.": handleCollision($result); break;
    case 'Success': handleSuccess(); break;
    case 'Unprocessable entity. Please check the documentation': handleUnprocessable($result); break;
    default: handleSuccess(); break;
}