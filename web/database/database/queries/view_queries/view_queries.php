<?php

require_once(__DIR__ . '/../../connection.php');

class ViewQueries {
    private $conn;

    public function __construct() {
        $connObj = new DatabaseConnection();
        $this->conn = $connObj->getConnection();
    }

    public function getMyEvents($uuid) {
        $sql = "SELECT e.id, e.name, e.description, e.iban, p.userEmail as beneficier FROM db.events e inner join db.participants p on p.eventId = e.id WHERE p.eventRoleId = 1 and e.id in (SELECT eventId FROM db.participants WHERE userEmail = (SELECT email FROM db.users WHERE uuid = '$uuid') and eventRoleId = 3);";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            $items = array();
            
            while ($row = $result->fetch_assoc()) {
                $items[] = $row;
            }

            return $items;
        }

        $empty_array = array();
        return $empty_array;
    }

    public function getOtherEvents($uuid) {
        $sql = "SELECT e.id, e.name, e.description, e.iban, p.userEmail as beneficier FROM db.events e inner join db.participants p on p.eventId = e.id WHERE p.eventRoleId = 1 and e.id in (SELECT eventId FROM db.participants WHERE userEmail = (SELECT email FROM db.users WHERE uuid = '$uuid') and eventRoleId = 2);";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            $items = array();
            
            while ($row = $result->fetch_assoc()) {
                $items[] = $row;
            }

            return $items;
        }

        $empty_array = array();
        return $empty_array;
    }

    public function getParticipants($eventId) {
        $sql = "SELECT userEmail from db.participants where eventRoleId = 2 and eventId = $eventId";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            $items = array();
            
            while ($row = $result->fetch_assoc()) {
                $items[] = $row;
            }

            return $items;
        }

        $empty_array = array();
        return $empty_array;
    }
}