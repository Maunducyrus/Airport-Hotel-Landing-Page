<?php
session_start();
require_once __DIR__ . '/../src/controllers/BookingController.php';
require_once __DIR__ . '/../src/controllers/AuthController.php';

// Verify user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: /AirportHotel/public/login.php");
    exit();
}

// Verify CSRF token
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    die("CSRF token validation failed");
}

// Get booking ID
$booking_id = $_POST['booking_id'] ?? null;
if (!$booking_id) {
    $_SESSION['error'] = "No booking specified";
    header("Location: /AirportHotel/public/view_bookings.php");
    exit();
}

// Process cancellation
$bookingController = new BookingController();
$result = $bookingController->cancelBooking($booking_id, $_SESSION['user']['id']);

if ($result === true) {
    $_SESSION['success'] = "Booking cancelled successfully";
} else {
    $_SESSION['error'] = $result; // Error message from controller
}

header("Location: /AirportHotel/public/view_bookings.php");
exit();
?>