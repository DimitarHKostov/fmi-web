<?php

session_start();

require_once __DIR__ . "./../database/database/queries/event_queries/event_queries.php";
require_once __DIR__ . "./../database/database/queries/user_queries/user_queries.php";
require_once __DIR__ . "/chain/chain.php";
require_once __DIR__ . "/validation/validation.php";
require_once __DIR__ . "/validation/event_validation.php";
require_once __DIR__ . "/objects/event.php";
require_once __DIR__ . "/common/common.php";

function handleCreate() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_COOKIE['web-cookie'])) {
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);

            if (json_last_error() === JSON_ERROR_NONE) {
                $event = Event::constructOutOfJson($data);
                $valid = Chain::apply(new EventValidation($event));

                if(!$valid) {
                    return "Unprocessable entity. Please check the documentation";
                }

                $eventQueries = new EventQueries();
                $creatorUuid = $_COOKIE['web-cookie'];

                $collision = $eventQueries->isThereEventNameCollision($event);

                if($collision) {
                    return "Another event with the same name already exists.";
                }

                $userQueries = new UserQueries();
                $doesUserExist = $userQueries->isRegistered($event->getBeneficier());

                if(!$doesUserExist) {
                    return "The user does not exist.";
                }

                $eventQueries->createEvent($event, $creatorUuid);

               return "Success";
            } else {
                return "Format not json.";
            }
        } else {
           return "Session is invalid.";
        }
    } else if ($_SERVER["REQUEST_METHOD"] != "OPTIONS"){
        return "Method not allowed.";
    }
}

$result = handleCreate();

switch($result) {
    case 'Method not allowed.': handleMethodNotAllowed($result); break;
    case 'Format not json.': handleFormatNotJson($result); break;
    case 'Success': handleSuccess(); break;
    case 'Session is invalid.': handleInvalidSession($result); break;
    case 'Another event with the same name already exists.': handleCollision($result); break;
    case 'Unprocessable entity. Please check the documentation': handleUnprocessable($result); break;
    case 'The user does not exist.': handleDoesNotExist($result); break;
    default: handleSuccess();
}