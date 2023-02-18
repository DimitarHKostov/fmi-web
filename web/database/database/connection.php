<?php

class DatabaseConnection {
    private $host;
    private $port;
    private $dbname;
    private $username;
    private $password;
    private $conn;

    public function __construct() {
        $this->host = "localhost";
        $this->port = 3306;
        $this->dbname = "db";
        $this->username = "root";
        $this->password = "";
    }

    public function getConnection() {
        $this->conn = mysqli_connect($this->host  , $this->username, $this->password, $this->dbname, $this->port);
        return $this->conn;
    }
}