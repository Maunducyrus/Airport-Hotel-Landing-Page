<?php
// require_once '../config/database.php';
require_once(__DIR__ . "/../../config/database.php");

class UserController {
    public function createUser($username, $email, $password, $role) {
        global $conn;
    
        // Validate inputs
        if (empty($username) || empty($email) || empty($password)) {
            die("Error: All fields are required.");
        }
    
        // Hash the password before storing it
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
        $sql = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
    
        if (!$stmt) {
            die("SQL error: " . $conn->error);
        }
    
        $stmt->bind_param("ssss", $username, $email, $hashedPassword, $role);
        
        if ($stmt->execute()) {
            return "User created successfully.";
        } else {
            return "Error: " . $stmt->error;
        }
    }
    

    public function readUsers() {
        global $conn;
        $result = $conn->query("SELECT * FROM users");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function updateUser($id, $username, $email, $role) {
        global $conn;
        $stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, role = ? WHERE id = ?");
        $stmt->bind_param("sssi", $username, $email, $role, $id);
        if ($stmt->execute()) {
            return "User updated successfully!";
        } else {
            return "Error: " . $stmt->error;
        }
    }

    public function deleteUser($id) {
        global $conn;
        $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            return "User deleted successfully!";
        } else {
            return "Error: " . $stmt->error;
        }
    }
}
?>