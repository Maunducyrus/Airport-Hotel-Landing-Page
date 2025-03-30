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
    <title>Staff Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Staff Dashboard</h1>
    <p>Welcome, Staff!</p>
    <nav>
        <ul>
            <li><a href="../src/views/staff/manage_availability.php">Manage Room Availability</a></li>
        </ul>
    </nav>
    <form method="POST" action="logout.php">
        <button type="submit">Logout</button>
    </form>
</body>
</html>