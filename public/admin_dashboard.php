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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #2c5b8e;
            --dark-blue: #1a3a5a;
            --light-blue: #e6f0fa;
            --text-color: #333;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--light-blue);
            color: var(--text-color);
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }
        
        .dashboard-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 2rem;
        }
        
        .dashboard-header {
            text-align: center;
            margin-bottom: 2.5rem;
            padding: 1.5rem 0;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }
        
        .dashboard-header h1 {
            color: var(--primary-blue);
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        
        .dashboard-header p {
            color: var(--dark-blue);
            font-size: 1.1rem;
        }
        
        .dashboard-nav {
            background-color: white;
            border-radius: 8px;
            padding: 1.5rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            margin-bottom: 2rem;
        }
        
        .nav-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }
        
        .nav-item a {
            display: block;
            text-decoration: none;
            padding: 1rem;
            background-color: var(--primary-blue);
            color: white;
            border-radius: 6px;
            transition: all 0.3s ease;
            text-align: center;
            font-weight: 500;
        }
        
        .nav-item a:hover {
            background-color: var(--dark-blue);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .logout-section {
            text-align: center;
            margin-top: 2rem;
        }
        
        .logout-btn {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 0.8rem 1.8rem;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .logout-btn:hover {
            background-color: #bb2d3b;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        @media (max-width: 768px) {
            .dashboard-container {
                padding: 1rem;
            }
            
            .nav-list {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <header class="dashboard-header">
            <h1>Admin Dashboard</h1>
            <p>Welcome, Admin!</p>
        </header>
        
        <nav class="dashboard-nav">
            <ul class="nav-list">
                <li class="nav-item"><a href="../src/views/admin/manage_users.php">Manage Users</a></li>
                <li class="nav-item"><a href="../src/views/admin/manage_rooms.php">Manage Rooms</a></li>
                <li class="nav-item"><a href="../src/views/admin/view_bookings.php">View All Bookings</a></li>
            </ul>
        </nav>
        
        <div class="logout-section">
            <form method="POST" action="logout.php">
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

