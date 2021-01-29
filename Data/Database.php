<?php

class Database
{
    private $host;
    private $user;
    private $pwd;
    private $dbName;
    private $charset;

    private static $instance;

    private function __construct(){
        $this->connect();
    }

    public static function getInstance(){
        if(self::$instance == null){
            self::$instance = new Database();
        }

        return self::$instance;
    }
    public function connect(){
        $this->host = "localhost";
        $this->user = "root";
        $this->pwd = "";
        $this->dbName = "universitydb";

        $mysqli = new mysqli($this->host,$this->user,$this->pwd,$this->dbName);

        if ($mysqli -> connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
            exit();
        }

        return $mysqli;
    }
}

