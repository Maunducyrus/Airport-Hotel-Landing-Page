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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guest Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .dashboard-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .nav-links {
            list-style: none;
            padding: 0;
        }
        .nav-links li {
            margin: 10px 0;
        }
        .nav-links a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: white;
            background-color: #007bff;
            border-radius: 5px;
            transition: background 0.3s;
        }
        .nav-links a:hover {
            background-color: #0056b3;
        }
        .logout-btn {
            background-color: #dc3545;
            border: none;
        }
        .logout-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h1>Guest Dashboard</h1>
        <p>Welcome, Guest!</p>
        <ul class="nav-links">
            <li><a href="../src/views/guest/view_rooms.php">View Available Rooms</a></li>
            <li><a href="../src/views/guest/book_room.php">Book a Room</a></li>
            <li><a href="../src/views/guest/view_bookings.php">View Your Bookings</a></li>
        </ul>
        <form method="POST" action="logout.php">
            <button type="submit" class="btn logout-btn mt-3">Logout</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
