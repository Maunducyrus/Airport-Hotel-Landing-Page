<?php

class BookingController {
    private $conn;

    public function __construct() {
        // Include database connection
        require_once(__DIR__ . '/../../controllers/BookingController.php');

        $this->conn = $conn;
    }

    public function bookRoom($userId, $roomId, $checkInDate, $checkOutDate) {
        // Check room availability
        $stmt = $this->conn->prepare("SELECT availability FROM rooms WHERE id = ?");
        $stmt->bind_param("i", $roomId);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 0) {
            return "Invalid room ID.";
        }

        $room = $result->fetch_assoc();
        if (!$room['availability']) {
            return "Room is not available.";
        }

        // Create booking
        $stmt = $this->conn->prepare("INSERT INTO bookings (user_id, room_id, check_in_date, check_out_date) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiss", $userId, $roomId, $checkInDate, $checkOutDate);
        if ($stmt->execute()) {
            // Mark room as unavailable
            $stmt = $this->conn->prepare("UPDATE rooms SET availability = 0 WHERE id = ?");
            $stmt->bind_param("i", $roomId);
            $stmt->execute();
            return "Room booked successfully!";
        } else {
            return "Failed to book room. Please try again.";
        }
    }

    public function getUserBookings($userId) {
        $stmt = $this->conn->prepare("SELECT bookings.id, rooms.room_number, rooms.room_type, bookings.check_in_date, bookings.check_out_date FROM bookings JOIN rooms ON bookings.room_id = rooms.id WHERE bookings.user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $bookings = [];
        while ($row = $result->fetch_assoc()) {
            $bookings[] = $row;
        }
        return $bookings;
    }

    public function cancelBooking($bookingId, $userId) {
        // Get the room ID for the booking
        $stmt = $this->conn->prepare("SELECT room_id FROM bookings WHERE id = ? AND user_id = ?");
        $stmt->bind_param("ii", $bookingId, $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 0) {
            return "Booking not found.";
        }

        $booking = $result->fetch_assoc();
        $roomId = $booking['room_id'];

        // Delete the booking
        $stmt = $this->conn->prepare("DELETE FROM bookings WHERE id = ?");
        $stmt->bind_param("i", $bookingId);
        if ($stmt->execute()) {
            // Mark room as available
            $stmt = $this->conn->prepare("UPDATE rooms SET availability = 1 WHERE id = ?");
            $stmt->bind_param("i", $roomId);
            $stmt->execute();
            return "Booking cancelled successfully!";
        } else {
            return "Failed to cancel booking. Please try again.";
        }
    }
}
?>