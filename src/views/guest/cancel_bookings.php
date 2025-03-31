<?php
session_start();
require_once '../../controllers/BookingController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $bookingController = new BookingController();
    $booking_id = $_POST['id'];
    $bookingController->cancelBooking($booking_id);
    header("Location: view_bookings.php"); // Redirect back after canceling
    exit();
} else {
    die("Invalid request.");
}
?>
