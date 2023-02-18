<?php

require_once(__DIR__ . '/../../connection.php');

class RegisterQueries {
    private $conn;

    public function __construct() {
        $connObj = new DatabaseConnection();
        $this->conn = $connObj->getConnection();
    }

    public function registerUser($user, $uuid) {
        $regularUser = 2;
        $username = $user->getUsername();
        $password = $user->getPassword();
        $firstName = $user->getFirstName();
        $lastName = $user->getLastName();
        $email = $user->getEmail();

        $sql = "INSERT INTO db.users VALUES ('$username', '$password', '$firstName', '$lastName', '$email', '$uuid', $regularUser);";

        return $this->conn->query($sql);
    }

    public function isThereCollision($user) {
        return $this->isThereUsernameCollision($user->getUsername()) || $this->isThereEmailCollision($user->getEmail());
    }

    private function isThereUsernameCollision($username) {
        return $this->isCollision("username", $username);
    }

    private function isThereEmailCollision($email) {
        return $this->isCollision("email", $email);
    }

    private function isCollision($columnName, $argToCheck) {
        $sql = "SELECT $columnName FROM db.users";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if ($row[$columnName] == $argToCheck) {
                    return true;
                }
            }
        }

        return false;
    }
}