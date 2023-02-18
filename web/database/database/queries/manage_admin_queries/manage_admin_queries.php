<?php

require_once(__DIR__ . '/../../connection.php');

class ManageAdminQueries {
    private $conn;

    public function __construct() {
        $connObj = new DatabaseConnection();
        $this->conn = $connObj->getConnection();
    }

    public function makeAdmin($email) {
        $this->updateAdminRightsBasedOnRoleId(1, $email);
    }

    public function removeAdminRights($email) {
        $this->updateAdminRightsBasedOnRoleId(2, $email);
    }

    public function updateAdminRightsBasedOnRoleId($roleId, $email) {
        $sql = "UPDATE db.users set roleId = $roleId where email = '$email';";
        $result = $this->conn->query($sql);
    }

    public function isAdmin($uuid) {
        $sql = "SELECT roleId FROM db.users where uuid = '$uuid'";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row["roleId"] == 1;
        }

        return false;
    }
}