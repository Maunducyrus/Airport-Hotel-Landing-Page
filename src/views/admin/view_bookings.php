<?php
require_once '../../controllers/BookingController.php';
$bookingController = new BookingController();
$bookings = $bookingController->readBookings();
?>

<h1>View All Bookings</h1>
<table>
    <tr>
        <th>ID</th>
        <th>User ID</th>
        <th>Room ID</th>
        <th>Check-in Date</th>
        <th>Check-out Date</th>
        <th>Created At</th>
    </tr>
    <?php foreach ($bookings as $booking): ?>
        <tr>
            <td><?php echo $booking['id']; ?></td>
            <td><?php echo $booking['user_id']; ?></td>
            <td><?php echo $booking['room_id']; ?></td>
            <td><?php echo $booking['check_in_date']; ?></td>
            <td><?php echo $booking['check_out_date']; ?></td>
            <td><?php echo $booking['created_at']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>