<?php
session_start();
require_once '../../controllers/BookingController.php';

// Check if user is logged in
if (!isset($_SESSION['user']['id'])) {
    header("Location: ../../public/login.php");
    exit();
}

$bookingController = new BookingController();
$user_id = $_SESSION['user']['id'];

// Generate CSRF token if not exists
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Fetch user bookings
$bookings = $bookingController->readUserBookings($user_id);

// Display success/error messages if they exist
$alert = '';
if (isset($_SESSION['booking_message'])) {
    $alert_type = $_SESSION['booking_message']['success'] ? 'success' : 'danger';
    $alert = '<div class="alert alert-'.$alert_type.'">'.$_SESSION['booking_message']['text'].'</div>';
    unset($_SESSION['booking_message']);
}
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
            padding-top: 20px;
        }
        .booking-table {
            background: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .status-confirmed {
            color: #28a745;
            font-weight: bold;
        }
        .status-cancelled {
            color: #dc3545;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h2 class="text-center mb-4">Your Bookings</h2>
                
                <?php echo $alert; ?>
                
                <?php if (empty($bookings)): ?>
                    <div class="alert alert-info text-center">You have no bookings yet.</div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-bordered booking-table">
                            <thead class="table-dark">
                                <tr>
                                    <th>Booking ID</th>
                                    <th>Room</th>
                                    <th>Check-in</th>
                                    <th>Check-out</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($bookings as $booking): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($booking['id']) ?></td>
                                        <td>Room #<?= htmlspecialchars($booking['room_id']) ?></td>
                                        <td><?= htmlspecialchars($booking['check_in_date']) ?></td>
                                        <td><?= htmlspecialchars($booking['check_out_date']) ?></td>
                                        <td class="status-<?= htmlspecialchars($booking['status'] ?? 'confirmed') ?>">
                                            <?= ucfirst(htmlspecialchars($booking['status'] ?? 'confirmed')) ?>
                                        </td>
                                        <td>
                                            <?php if ($booking['status'] === 'confirmed'): ?>
                                                <form method="POST" action="/AirportHotel/src/views/guest/cancel_booking.php" class="d-inline">
                                                    <input type="hidden" name="id" value="<?= $booking['id'] ?>">
                                                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                                    <button type="submit" class="btn btn-sm btn-danger" 
                                                            onclick="return confirm('Are you sure you want to cancel this booking?')">
                                                        Cancel
                                                    </button>
                                                </form>
                                            <?php else: ?>
                                                <span class="text-muted">N/A</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
                
                <div class="text-center mt-3">
                    <a href="http://localhost/AirportHotel/public/guest_dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>