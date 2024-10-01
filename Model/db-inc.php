<?php

class DataBase
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "c71beadcasino";
    private $conn;

    public function dbSelect($sql)
    {
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            // print_r($result);
            return $result;
        } else {
            return NULL;
        }

    }

    public function prepare($sql)
    {
        return $this->conn->prepare($sql);
    }

    function __construct()
    {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $this->conn = $conn;
        //$GLOBALS['prefix'] = "";
    }
}

?>