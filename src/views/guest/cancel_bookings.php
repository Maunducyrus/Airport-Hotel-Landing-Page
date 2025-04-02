<?php
session_start();
require_once '../../controllers/BookingController.php';

// Verify user is logged in
if (!isset($_SESSION['user']['id'])) {
    header("Location: ../../public/login.php");
    exit();
}

// Verify booking ID was provided
if (!isset($_POST['id'])) {
    $_SESSION['error'] = "No booking specified";
    header("Location: view_bookings.php");
    exit();
}

$booking_id = $_POST['id'];
$user_id = $_SESSION['user']['id'];

$bookingController = new BookingController();
$result = $bookingController->cancelBooking($booking_id, $user_id);

if ($result === true) {
    $_SESSION['success'] = "Booking cancelled successfully";
} else {
    $_SESSION['error'] = $result;
}

header("Location: view_bookings.php");
exit();
?>