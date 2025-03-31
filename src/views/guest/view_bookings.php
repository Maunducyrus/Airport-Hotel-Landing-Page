<?php
session_start(); // Start the session to access $_SESSION variables
require_once '../../controllers/BookingController.php';

$bookingController = new BookingController();

// Check if user is logged in
if (!isset($_SESSION['user']['id'])) {
    die("Error: User not logged in.");
}

$user_id = $_SESSION['user']['id'];

// Fetch user bookings
$bookings = $bookingController->readUserBookings($user_id);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        table {
            background: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-4">View Your Bookings</h2>

        <?php if (empty($bookings)): ?>
            <p class="text-center text-danger">No bookings found.</p>
        <?php else: ?>
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Room ID</th>
                        <th>Check-in Date</th>
                        <th>Check-out Date</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($bookings as $booking): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($booking['id']); ?></td>
                            <td><?php echo htmlspecialchars($booking['room_id']); ?></td>
                            <td><?php echo htmlspecialchars($booking['check_in_date']); ?></td>
                            <td><?php echo htmlspecialchars($booking['check_out_date']); ?></td>
                            <td><?php echo htmlspecialchars($booking['created_at']); ?></td>
                            <td>
                                <form method="POST" action="cancel_booking.php" style="display:inline;">
                                    <input type="hidden" name="id" value="<?php echo $booking['id']; ?>">
                                    <button type="submit" name="cancel" class="btn btn-danger btn-sm">Cancel</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

    </div>
</body>
</html>
