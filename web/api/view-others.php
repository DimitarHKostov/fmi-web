<?php

require_once __DIR__ . "./../database/database/queries/view_queries/view_queries.php";
require_once __DIR__ . "/common/common.php";

function handleViewOthers() {
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        if (isset($_COOKIE['web-cookie'])) {
            $uuid = $_COOKIE['web-cookie'];
            $viewQueries = new ViewQueries();
            $events = $viewQueries->getOtherEvents($uuid);

            $json = json_encode($events);

            return $json;
        } else {
            return "Unauthorized.";
        }
    } else {
        return "Method not allowed.";
    }
}

$events = handleViewOthers();

switch($result) {
    case 'Method not allowed.': handleMethodNotAllowed($result); break;
    case 'Unauthorized.': handleUnauthorized($result); break;
    default: handleSuccessEvents($events);
}