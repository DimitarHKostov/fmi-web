<?php

session_start();

require_once __DIR__ . "./../database/database/queries/participant_queries/participant_queries.php";
require_once __DIR__ . "./../database/database/queries/view_queries/view_queries.php";
require_once __DIR__ . "./../database/database/queries/user_queries/user_queries.php";
require_once __DIR__ . "/chain/chain.php";
require_once __DIR__ . "/validation/validation.php";
require_once __DIR__ . "/validation/email_validation.php";
require_once __DIR__ . "/objects/event.php";
require_once __DIR__ . "/common/common.php";

function handleParticipant() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_COOKIE['web-cookie'])) {
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);

            if (json_last_error() === JSON_ERROR_NONE) {
                $uuid = $_COOKIE['web-cookie'];
                $email = $data['email'];
                $eventId = $data['eventId'];
                $valid = Chain::apply(new EmailValidation($email));

                if(!$valid) {
                    return "Unprocessable entity. Please check the documentation";
                }

                $userQueries = new UserQueries();
                $doesUserExist = $userQueries->isRegistered($email);

                if(!$doesUserExist) {
                    return "The user does not exist.";
                }

                $participantQueries = new ParticipantQueries();
                $participantQueries->addParticipant($email, $eventId);

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
                $eventId = $data['eventId'];
                $valid = Chain::apply(new EmailValidation($email));

                if(!$valid) {
                    return "Unprocessable entity. Please check the documentation";
                }

                $userQueries = new UserQueries();
                $doesUserExist = $userQueries->isRegistered($email);

                if(!$doesUserExist) {
                    return "The user does not exist.";
                }

                $participantQueries = new ParticipantQueries();
                $participantQueries->removeParticipant($email, $eventId);

               return "Success";
            } else {
                return "Format not json.";
            }
        } else {
            return "Unauthorized.";
        }
    } else if ($_SERVER["REQUEST_METHOD"] == "GET"){
        if (isset($_COOKIE['web-cookie'])) {

            if (json_last_error() === JSON_ERROR_NONE) {
                $uuid = $_COOKIE['web-cookie'];
                $eventId = $_GET['eventId'];

                $viewQueries = new ViewQueries();
                $participants = $viewQueries->getParticipants($eventId);

                $json = json_encode($participants);

                return $json;
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

$result = handleParticipant();

switch($result) {
    case 'Method not allowed.': handleMethodNotAllowed($result); break;
    case 'Format not json.': handleFormatNotJson($result); break;
    case 'Unauthorized.': handleUnauthorized($result); break;
    case 'Unprocessable entity. Please check the documentation': handleUnprocessable($result); break;
    case 'The user does not exist.': handleDoesNotExist($result); break;
    default: handleSuccessParticipants($result);
}