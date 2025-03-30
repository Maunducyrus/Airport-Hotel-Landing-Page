<?php
require_once '../../controllers/BookingController.php';
$bookingController = new BookingController();
$user_id = $_SESSION['user']['id'];
$bookings = $bookingController->readUserBookings($user_id);
?>

<h1>View Your Bookings</h1>
<table>
    <tr>
        <th>ID</th>
        <th>Room ID</th>
        <th>Check-in Date</th>
        <th>Check-out Date</th>
        <th>Created At</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($bookings as $booking): ?>
        <tr>
            <td><?php echo $booking['id']; ?></td>
            <td><?php echo $booking['room_id']; ?></td>
            <td><?php echo $booking['check_in_date']; ?></td>
            <td><?php echo $booking['check_out_date']; ?></td>
            <td><?php echo $booking['created_at']; ?></td>
            <td>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?php echo $booking['id']; ?>">
                    <button type="submit" name="cancel">Cancel Booking</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>