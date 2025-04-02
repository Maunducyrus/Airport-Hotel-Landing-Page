<?php
require_once(__DIR__ . "/../../config/database.php");

class AuthController {
    private $conn;

    public function __construct() {
        try {
            $database = new Database();
            $this->conn = $database->getConnection();
            
            if ($this->conn->connect_error) {
                throw new Exception("Database connection failed: " . $this->conn->connect_error);
            }
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }
    }

    /**
     * Authenticate user login
     * @param string $email User's email
     * @param string $password User's password
     * @return array|false Returns user data if successful, false otherwise
     */
    public function login($email, $password) {
        // Validate inputs
        $email = $this->sanitizeInput($email);
        $password = trim($password);
        
        if (empty($email) || empty($password)) {
            return false;
        }

        try {
            // Prepare SQL statement
            $stmt = $this->conn->prepare("SELECT id, username, email, password, role FROM users WHERE email = ?");
            if (!$stmt) {
                throw new Exception("Prepare failed: " . $this->conn->error);
            }

            // Bind parameters and execute
            $stmt->bind_param("s", $email);
            if (!$stmt->execute()) {
                throw new Exception("Execute failed: " . $stmt->error);
            }

            // Get result
            $result = $stmt->get_result();
            if ($result->num_rows === 0) {
                return false;
            }

            $user = $result->fetch_assoc();

            // Verify password
            if (password_verify($password, $user['password'])) {
                // Remove password before returning user data
                unset($user['password']);
                return $user;
            }

            return false;
        } catch (Exception $e) {
            error_log("Login error: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Sanitize user input
     * @param string $input User input
     * @return string Sanitized input
     */
    private function sanitizeInput($input) {
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
    }

    /**
     * Close database connection
     */
    public function __destruct() {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}
?>