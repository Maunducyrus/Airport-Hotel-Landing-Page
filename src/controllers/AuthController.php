<?php
require_once '../config/database.php';

class AuthController {
    public function register($username, $email, $password, $role) {
        global $conn;
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $email, $hashedPassword, $role);
        if ($stmt->execute()) {
            return "User registered successfully!";
        } else {
            return "Error: " . $stmt->error;
        }
    }

    public function login($email, $password) {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['user'] = $user;
                return "Login successful!";
            } else {
                return "Invalid password!";
            }
        } else {
            return "No user found with that email!";
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        return "Logged out successfully!";
    }
}
?>