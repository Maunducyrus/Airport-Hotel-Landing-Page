<?php
require_once '../../controllers/RoomController.php';
$roomController = new RoomController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $roomController->updateRoom($_POST['id'], $_POST['room_number'], $_POST['room_type'], $_POST['price'], $_POST['availability']);
}

$rooms = $roomController->readRooms();
?>

<h1>Manage Room Availability</h1>
<table>
    <tr>
        <th>Room Number</th>
        <th>Room Type</th>
        <th>Price</th>
        <th>Availability</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($rooms as $room): ?>
        <tr>
            <td><?php echo $room['room_number']; ?></td>
            <td><?php echo $room['room_type']; ?></td>
            <td><?php echo $room['price']; ?></td>
            <td><?php echo $room['availability'] ? 'Yes' : 'No'; ?></td>
            <td>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?php echo $room['id']; ?>">
                    <input type="text" name="room_number" value="<?php echo $room['room_number']; ?>">
                    <input type="text" name="room_type" value="<?php echo $room['room_type']; ?>">
                    <input type="number" step="0.01" name="price" value="<?php echo $room['price']; ?>">
                    <select name="availability">
                        <option value="1" <?php if ($room['availability']) echo 'selected'; ?>>Available</option>
                        <option value="0" <?php if (!$room['availability']) echo 'selected'; ?>>Not Available</option>
                    </select>
                    <button type="submit">Update</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>