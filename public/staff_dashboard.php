<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'staff') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .dashboard-container {
            max-width: 500px;
            margin: 100px auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            background: white;
            text-align: center;
        }
        .dashboard-container h1 {
            color: #007bff;
            margin-bottom: 20px;
        }
        .btn-primary, .btn-danger {
            width: 100%;
            margin-top: 10px;
        }
        nav ul {
            list-style-type: none;
            padding: 0;
        }
        nav ul li {
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="dashboard-container">
            <h1>Staff Dashboard</h1>
            <p>Welcome, Staff!</p>

            <nav>
                <ul>
                    <li>
                        <a href="../src/views/staff/manage_availability.php" class="btn btn-primary">Manage Room Availability</a>
                    </li>
                </ul>
            </nav>

            <form method="POST" action="logout.php">
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
