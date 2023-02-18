<?php

require_once(__DIR__ . '/../../connection.php');

class ParticipantQueries {
    private $conn;

    public function __construct() {
        $connObj = new DatabaseConnection();
        $this->conn = $connObj->getConnection();
    }

    public function addParticipant($email, $eventId) {
        $sql = "INSERT into db.participants(userEmail, eventId, eventRoleId) values('$email', $eventId, 2);";
        $result = $this->conn->query($sql);
    }

    public function removeParticipant($email, $eventId) {
        $sql = "DELETE from db.participants where (userEmail = '$email' and eventId = $eventId and eventRoleId = 2);";
        $result = $this->conn->query($sql);
    }
}