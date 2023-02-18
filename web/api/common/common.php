<?php

session_start();

function handleDoesNotExist($msg) {
    handle("$msg", 200);
}

function handleSuccess() {
    handle("Success.", 200);
}

function handleSuccessParticipants($participants) {
    echo $participants;
    http_response_code(200);
}

function handleSuccessEvents($events) {
    echo $events;
    http_response_code(200);
}

function handleCollision($msg) {
    handle("$msg", 409);
}

function handleUnprocessable($msg) {
    handle("$msg", 422);
}

function handleInvalidSession($msg) {
    handle("$msg", 401);
}

function handleUnauthorized($msg) {
    handle("$msg", 401);
}

function handleFormatNotJson($msg) {
    handle("$msg", 400);
}

function handleMethodNotAllowed($msg) {
    handle("$msg", 405);
}

function handle($message, $responseCode) {
    echo "$message";
    http_response_code($responseCode);
}