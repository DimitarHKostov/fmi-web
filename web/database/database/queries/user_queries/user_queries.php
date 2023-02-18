<?php

require_once(__DIR__ . '/../../connection.php');

class UserQueries {
    private $conn;

    public function __construct() {
        $connObj = new DatabaseConnection();
        $this->conn = $connObj->getConnection();
    }

    public function isRegistered($email) {
        $sql = "SELECT uuid FROM db.users where email = '$email'";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row["uuid"] != "";
        }

        return false;
    }

    public function isAdmin($email) {

    }
}