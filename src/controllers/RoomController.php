<?php
require_once(__DIR__ . "/../../config/database.php");

class RoomController {
    private $conn;

    public function __construct() {
        $db = new Database(); //  Create Database instance
        $this->conn = $db->getConnection(); //  Assign the connection
    }

    public function createRoom($room_number, $room_type, $price, $availability) {
        $stmt = $this->conn->prepare("INSERT INTO rooms (room_number, room_type, price, availability) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssdi", $room_number, $room_type, $price, $availability);
        if ($stmt->execute()) {
            return "Room created successfully!";
        } else {
            return "Error: " . $stmt->error;
        }
    }

    public function readRooms() {
        $result = $this->conn->query("SELECT * FROM rooms");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function updateRoom($id, $room_number, $room_type, $price, $availability) {
        $stmt = $this->conn->prepare("UPDATE rooms SET room_number = ?, room_type = ?, price = ?, availability = ? WHERE id = ?");
        $stmt->bind_param("ssdii", $room_number, $room_type, $price, $availability, $id);
        if ($stmt->execute()) {
            return "Room updated successfully!";
        } else {
            return "Error: " . $stmt->error;
        }
    }

    // public function deleteRoom($id) {
    //     $stmt = $this->conn->prepare("DELETE FROM rooms WHERE id = ?");
    //     $stmt->bind_param("i", $id);
    //     if ($stmt->execute()) {
    //         return "Room deleted successfully!";
    //     } else {
    //         return "Error: " . $stmt->error;
    //     }
    // }
    public function deleteRoom($room_id) {
        try {
            // Start transaction
            $this->conn->begin_transaction();
            
            // First cancel all bookings for this room
            $stmt = $this->conn->prepare("
                UPDATE bookings 
                SET status = 'cancelled', cancelled_at = NOW() 
                WHERE room_id = ? AND status = 'confirmed'
            ");
            $stmt->bind_param("i", $room_id);
            $stmt->execute();
            
            // Then delete the room
            $stmt = $this->conn->prepare("DELETE FROM rooms WHERE id = ?");
            $stmt->bind_param("i", $room_id);
            $stmt->execute();
            
            $this->conn->commit();
            return true;
            
        } catch (Exception $e) {
            $this->conn->rollback();
            error_log("Delete room error: " . $e->getMessage());
            return "Error deleting room: " . $e->getMessage();
        }
    }
}
?>
