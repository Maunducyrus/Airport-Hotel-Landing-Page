<?php
require_once '../config/database.php';

class RoomController {
    public function createRoom($room_number, $room_type, $price, $availability) {
        global $conn;
        $stmt = $conn->prepare("INSERT INTO rooms (room_number, room_type, price, availability) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssdi", $room_number, $room_type, $price, $availability);
        if ($stmt->execute()) {
            return "Room created successfully!";
        } else {
            return "Error: " . $stmt->error;
        }
    }

    public function readRooms() {
        global $conn;
        $result = $conn->query("SELECT * FROM rooms");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function updateRoom($id, $room_number, $room_type, $price, $availability) {
        global $conn;
        $stmt = $conn->prepare("UPDATE rooms SET room_number = ?, room_type = ?, price = ?, availability = ? WHERE id = ?");
        $stmt->bind_param("ssdii", $room_number, $room_type, $price, $availability, $id);
        if ($stmt->execute()) {
            return "Room updated successfully!";
        } else {
            return "Error: " . $stmt->error;
        }
    }

    public function deleteRoom($id) {
        global $conn;
        $stmt = $conn->prepare("DELETE FROM rooms WHERE id = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            return "Room deleted successfully!";
        } else {
            return "Error: " . $stmt->error;
        }
    }
}
?>