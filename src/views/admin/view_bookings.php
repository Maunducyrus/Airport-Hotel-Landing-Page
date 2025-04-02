<?php
require_once '../../controllers/BookingController.php';

$bookingController = new BookingController();
$bookings = $bookingController->readBookings();

// Debugging: Check if $bookings has data
echo "<pre>";
print_r($bookings);
echo "</pre>";

if (empty($bookings)) {
    echo "<p class='text-danger text-center'>No bookings found</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View All Bookings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center mb-4">View All Bookings</h1>
        <div class="card shadow p-4">
            <?php if (empty($bookings)): ?>
                <p class="text-danger text-center">No bookings found</p>
            <?php else: ?>
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Room Number</th>
                            <th>Room Type</th>
                            <th>Check-in Date</th>
                            <th>Check-out Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($bookings as $booking): ?>
                            <tr>
                                <td><?= htmlspecialchars($booking['id']) ?></td>
                                <td><?= htmlspecialchars($booking['username']) ?></td>
                                <td><?= htmlspecialchars($booking['room_number']) ?></td>
                                <td><?= htmlspecialchars($booking['room_type']) ?></td>
                                <td><?= htmlspecialchars($booking['check_in_date']) ?></td>
                                <td><?= htmlspecialchars($booking['check_out_date']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>

    <div class="text-center mt-3">
        <a href="http://localhost/AirportHotel/public/admin_dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>