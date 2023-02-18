<?php

session_start();

require_once __DIR__ . "./../database/database/queries/manage_admin_queries/manage_admin_queries.php";
require_once __DIR__ . "./../database/database/queries/user_queries/user_queries.php";
require_once __DIR__ . "/chain/chain.php";
require_once __DIR__ . "/validation/validation.php";
require_once __DIR__ . "/validation/email_validation.php";
require_once __DIR__ . "/objects/event.php";
require_once __DIR__ . "/common/common.php";

function handleManageAdmin() {
    if ($_SERVER["REQUEST_METHOD"] == "PUT") {
        if (isset($_COOKIE['web-cookie'])) {
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);

            if (json_last_error() === JSON_ERROR_NONE) {
                $uuid = $_COOKIE['web-cookie'];
                $email = $data['email'];
                $valid = Chain::apply(new EmailValidation($email));

                if(!$valid) {
                    return "Unprocessable entity. Please check the documentation";
                }

                $manageAdminQueries = new ManageAdminQueries();

                if(!$manageAdminQueries->isAdmin($uuid)) {
                    return "Unauthorized.";
                }

                $userQueries = new UserQueries();
                $doesUserExist = $userQueries->isRegistered($email);

                if(!$doesUserExist) {
                    return "The user does not exist.";
                }

                $manageAdminQueries->makeAdmin($email);

               return "Success";
            } else {
                return "Format not json.";
            }
        } else {
            return "Unauthorized.";
        }
    } else if ($_SERVER["REQUEST_METHOD"] == "DELETE"){
        if (isset($_COOKIE['web-cookie'])) {
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);

            if (json_last_error() === JSON_ERROR_NONE) {
                $uuid = $_COOKIE['web-cookie'];
                $email = $data['email'];
                $valid = Chain::apply(new EmailValidation($email));

                if(!$valid) {
                    return "Unprocessable entity. Please check the documentation";
                }

                $manageAdminQueries = new ManageAdminQueries();

                if(!$manageAdminQueries->isAdmin($uuid)) {
                    return "Unauthorized.";
                }

                $userQueries = new UserQueries();
                $doesUserExist = $userQueries->isRegistered($email);

                if(!$doesUserExist) {
                    return "The user does not exist.";
                }

                $manageAdminQueries->removeAdminRights($email);

               return "Success";
            } else {
                return "Format not json.";
            }
        } else {
            return "Unauthorized.";
        }
    } else {
        return "Method not allowed.";
    }
}

$result = handleManageAdmin();

switch($result) {
    case 'Method not allowed.': handleMethodNotAllowed($result); break;
    case 'Format not json.': handleFormatNotJson($result); break;
    case 'Success': handleSuccess(); break;
    case 'Unauthorized.': handleUnauthorized($result); break;
    case 'Unprocessable entity. Please check the documentation': handleUnprocessable($result); break;
    case 'The user does not exist.': handleDoesNotExist($result); break;
    default: handleSuccess(); break;
}