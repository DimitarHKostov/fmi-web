<?php

require_once(__DIR__ . '/../../connection.php');

class AdminDeleteQueries {
    private $conn;

    public function __construct() {
        $connObj = new DatabaseConnection();
        $this->conn = $connObj->getConnection();
    }

    public function deleteUser($email) {
        $sql = "DELETE FROM db.users WHERE email = '$email'";
        $this->conn->query($sql);
    }
}