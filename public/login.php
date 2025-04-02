<?php
// Start session securely
if (session_status() === PHP_SESSION_NONE) {
    session_start([
        'cookie_secure' => true,    // Requires HTTPS
        'cookie_httponly' => true,  // Prevents JavaScript access
        'use_strict_mode' => true   // Prevents session fixation
    ]);
}

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../src/controllers/AuthController.php';

// Initialize variables
$error = null;

// Process login if POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Basic input sanitization
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $password = $_POST['password']; // Password will be verified directly
        
        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format");
        }

        // Authenticate user
        $authController = new AuthController();
        $user = $authController->login($email, $password);
        
        if ($user) {
            // Regenerate session ID to prevent fixation
            session_regenerate_id(true);
            
            // Store minimal user data in session
            $_SESSION['user'] = [
                'id' => $user['id'],
                'username' => $user['username'], //wanting display the user in dashboard
                'email' => $user['email'],
                'role' => $user['role']
            ];
            
            // Redirect based on role
            $redirect = match($user['role']) {
                'admin' => 'admin_dashboard.php',
                'staff' => 'staff_dashboard.php',
                'guest' => 'guest_dashboard.php',
                default => 'index.php'
            };
            
            header("Location: $redirect");
            exit();
        } else {
            // Generic error message (don't reveal which was wrong)
            throw new Exception("Invalid credentials");
        }
    } catch (Exception $e) {
        error_log("Login error: " . $e->getMessage()); // Log for debugging
        $error = "Login failed. Please try again.";    // User-friendly message
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Airport Hotel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-container {
            max-width: 500px;
            margin-top: 100px;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            background: white;
        }
        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 login-container">
                <h2 class="text-center mb-4">Airport Hotel Login</h2>
                
                <?php if ($error): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= htmlspecialchars($error) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                
                <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" 
                               required autocomplete="email" autofocus
                               value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" 
                               required autocomplete="current-password">
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">Login</button>
                    </div>
                </form>
                
                <!-- Uncomment when ready -->
                <!-- <div class="text-center mt-3">
                    <a href="forgot_password.php" class="text-decoration-none">Forgot password?</a>
                </div> -->
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>