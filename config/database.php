<?php
class Database {
    private $host = "localhost";
    private $db_name = "hotel_booking";
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
            if ($this->conn->connect_error) {
                die("Connection failed: " . $this->conn->connect_error);
            }
        } catch (Exception $exception) {
            die("Database connection error: " . $exception->getMessage());
        }

        return $this->conn;
    }
}
?>


