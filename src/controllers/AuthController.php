<?php
class AuthController {
    private $conn;

    public function __construct() {
        try {
            $database = new Database();
            $this->conn = $database->getConnection();
            
            if ($this->conn === null) {
                throw new Exception("Database connection not established");
            }
        } catch (Exception $e) {
            error_log("AuthController error: " . $e->getMessage());
            throw $e; // Let calling code handle this
        }
    }

    public function register($username, $email, $password, $role) {
        try {
            // Validate inputs
            $username = $this->sanitizeInput($username);
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
            
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return "Invalid email format";
            }

            // Check email existence
            $stmt = $this->conn->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            
            if ($stmt->get_result()->num_rows > 0) {
                return "Email already exists";
            }

            // Hash password and insert
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $this->conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $username, $email, $hashedPassword, $role);

            return $stmt->execute() 
                ? "Registration successful" 
                : "Registration failed: " . $stmt->error;
                
        } catch (Exception $e) {
            error_log("Registration error: " . $e->getMessage());
            return "Registration failed. Please try again.";
        }
    }

    public function login($email, $password) {
        try {
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return ['success' => false, 'message' => 'Invalid email format'];
            }
    
            $stmt = $this->conn->prepare("SELECT id, username, email, password, role FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            
            $result = $stmt->get_result();
            if ($result->num_rows === 0) {
                return ['success' => false, 'message' => 'Invalid credentials'];
            }
    
            $user = $result->fetch_assoc();
            
            if (password_verify($password, $user['password'])) {
                return [
                    'success' => true,
                    'user' => [
                        'id' => $user['id'],
                        'username' => $user['username'],
                        'email' => $user['email'],
                        'role' => $user['role']
                    ]
                ];
            }
            
            return ['success' => false, 'message' => 'Invalid credentials'];
            
        } catch (Exception $e) {
            error_log("Login error: " . $e->getMessage());
            return ['success' => false, 'message' => 'Login failed. Please try again.'];
        }
    }

    private function sanitizeInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
?>