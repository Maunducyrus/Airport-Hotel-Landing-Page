<?php
require_once '../../controllers/RoomController.php';
$roomController = new RoomController();
$rooms = $roomController->readRooms();
?>

<h1>View Available Rooms</h1>
<table>
    <tr>
        <th>Room Number</th>
        <th>Room Type</th>
        <th>Price</th>
        <th>Availability</th>
    </tr>
    <?php foreach ($rooms as $room): ?>
        <tr>
            <td><?php echo $room['room_number']; ?></td>
            <td><?php echo $room['room_type']; ?></td>
            <td><?php echo $room['price']; ?></td>
            <td><?php echo $room['availability'] ? 'Yes' : 'No'; ?></td>
        </tr>
    <?php endforeach; ?>
</table>