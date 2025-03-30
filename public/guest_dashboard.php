<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'guest') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Guest Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Guest Dashboard</h1>
    <p>Welcome, Guest!</p>
    <nav>
        <ul>
            <li><a href="../src/views/guest/view_rooms.php">View Available Rooms</a></li>
            <li><a href="../src/views/guest/book_room.php">Book a Room</a></li>
            <li><a href="../src/views/guest/view_bookings.php">View Your Bookings</a></li>
        </ul>
    </nav>
    <form method="POST" action="logout.php">
        <button type="submit">Logout</button>
    </form>
</body>
</html>