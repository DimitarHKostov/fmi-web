<?php

require_once(__DIR__ . '/../../connection.php');

class LoginQueries {
    private $conn;

    public function __construct() {
        $connObj = new DatabaseConnection();
        $this->conn = $connObj->getConnection();
    }

    public function extractRole($loginData) {
        $username = $loginData->getUsername();

        $sql = "SELECT roleId FROM db.users where username = '$username'";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row["roleId"];
        }

        return null;
    }

    public function extractUuid($loginData) {
        $username = $loginData->getUsername();

        $sql = "SELECT uuid FROM db.users where username = '$username'";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row["uuid"];
        }

        return null;
    }

    public function extractPasswordHash($loginData) {
        $username = $loginData->getUsername();
        $password = $loginData->getPassword();

        $sql = "SELECT password FROM db.users where username = '$username'";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row["password"];
        }

        return null;
    }
}