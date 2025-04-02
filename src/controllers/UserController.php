<?php
require_once(__DIR__ . "/../../config/database.php");

class UserController {
    private $conn; // Store the database connection

    public function __construct() {
        $database = new Database(); // Create a Database instance
        $this->conn = $database->getConnection(); // Get the connection
    }

    public function createUser($username, $email, $password, $role) {
        // Remove global $conn and use $this->conn
        if (empty($username) || empty($email) || empty($password)) {
            die("Error: All fields are required.");
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql); // Use $this->conn

        if (!$stmt) {
            die("SQL error: " . $this->conn->error);
        }

        $stmt->bind_param("ssss", $username, $email, $hashedPassword, $role);
        
        if ($stmt->execute()) {
            return "User created successfully.";
        } else {
            return "Error: " . $stmt->error;
        }
    }

    public function readUsers() {
        $result = $this->conn->query("SELECT * FROM users"); // Use $this->conn
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function updateUser($id, $username, $email, $role) {
        $stmt = $this->conn->prepare("UPDATE users SET username = ?, email = ?, role = ? WHERE id = ?");
        $stmt->bind_param("sssi", $username, $email, $role, $id);
        if ($stmt->execute()) {
            return "User updated successfully!";
        } else {
            return "Error: " . $stmt->error;
        }
    }

    public function deleteUser($id) {
        $stmt = $this->conn->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            return "User deleted successfully!";
        } else {
            return "Error: " . $stmt->error;
        }
    }
}

?>