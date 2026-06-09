<?php
class Database{
    private static $instance = null;
    private $conn;

    private function __construct(){
        $host = 'localhost';
        $db = 'vrtic_db';
        $user = 'root';
        $pass = '';

        $this->conn = new mysqli($host, $user, $pass, $db);

        if ($this->conn->connect_error){
            die("Greska sa konekcijom: " . $this->conn->connect_error);
        }

        $this->conn->set_charset("utf8mb4");
    }

    public static function getInstance(){
        if (self::$instance === null){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection(){
        return $this->conn;
    }
}
?>