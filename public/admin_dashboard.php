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

<style>
/* General Styles */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    color: #333;
    text-align: center;
    margin: 0;
    padding: 0;
}

/* Container */
.container {
    width: 90%;
    max-width: 600px;
    margin: 50px auto;
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

/* Header */
header h1 {
    margin: 0;
    font-size: 28px;
    color: #2c3e50;
}

/* Navigation Bar */
nav ul {
    list-style: none;
    padding: 0;
}

nav ul li {
    margin: 10px 0;
}

nav ul li a {
    display: block;
    text-decoration: none;
    padding: 12px;
    background: #2c3e50;
    color: white;
    border-radius: 5px;
    transition: 0.3s;
}

nav ul li a:hover {
    background: #1a252f;
}

/* Logout Button */
.logout-btn {
    background: #e74c3c;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: 0.3s;
}

.logout-btn:hover {
    background: #c0392b;
}

/* Responsive Design */
@media (max-width: 600px) {
    .container {
        width: 95%;
    }
}

    </style>
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

