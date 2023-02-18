<?php

require_once(__DIR__ . '/../../connection.php');

class EventQueries {
    private $conn;

    public function __construct() {
        $connObj = new DatabaseConnection();
        $this->conn = $connObj->getConnection();
    }

    public function isThereEventNameCollision($event) {
        $sql = "SELECT name FROM db.events;";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if ($row['name'] == $event->getName()) {
                    return true;
                }
            }
        }

        return false;
    }

    public function createEvent($event, $creatorUuid) {
        $name = $event->getName();
        $beneficier = $event->getBeneficier();
        $iban = $event->getIban();
        $description = $event->getDescription();

        $sqlEvent = "INSERT INTO db.events(name, iban, description) VALUES ('$name', '$iban', '$description');";
        $this->conn->query($sqlEvent);

        $eventId = $this->getEventId($name);
        $email = $this->getEmailByUuid($creatorUuid);

        $sqlCreatorParticipant = "INSERT INTO db.participants(userEmail, eventId, eventRoleId) VALUES ('$email', $eventId, 3);";
        $this->conn->query($sqlCreatorParticipant);

        $sqlBeneficierParticipant = "INSERT INTO db.participants(userEmail, eventId, eventRoleId) VALUES ('$beneficier', $eventId, 1);";
        $this->conn->query($sqlBeneficierParticipant);
    }

    private function getEventId($eventName) {
        $sql = "SELECT id FROM db.events where name = '$eventName';";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row["id"];
        }

        return null;
    }

    private function getEmailByUuid($uuid) {
        $sql = "SELECT email FROM db.users where uuid = '$uuid';";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row["email"];
        }

        return null;
    }
}