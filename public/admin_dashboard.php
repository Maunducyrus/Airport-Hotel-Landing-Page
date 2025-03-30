<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Admin Dashboard</h1>
    <p>Welcome, Admin!</p>
    <nav>
        <ul>
            <li><a href="../src/views/admin/manage_users.php">Manage Users</a></li>
            <li><a href="../src/views/admin/manage_rooms.php">Manage Rooms</a></li>
            <li><a href="../src/views/admin/view_bookings.php">View All Bookings</a></li>
        </ul>
    </nav>
    <form method="POST" action="logout.php">
        <button type="submit">Logout</button>
    </form>
</body>
</html>