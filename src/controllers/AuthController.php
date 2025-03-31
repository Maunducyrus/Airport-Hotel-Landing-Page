<?php
class AuthController {
    private $conn;

    public function __construct() {
        require '../config/database.php';
        $this->conn = $conn;
    }

    public function register($username, $email, $password, $role) {
        // Check if the email already exists
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return "Email already exists!";
        }

        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Insert the new user into the database
        $stmt = $this->conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $email, $hashedPassword, $role);

        if ($stmt->execute()) {
            return "Registration successful!";
        } else {
            return "Registration failed. Please try again.";
        }
    }

    public function login($email, $password) {
        // Check if the user exists
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            return "Invalid email or password!";
        }

        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            return "Login successful!";
        } else {
            return "Invalid email or password!";
        }
    }
}