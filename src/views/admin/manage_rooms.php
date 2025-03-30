<?php
require_once '../../controllers/RoomController.php';
$roomController = new RoomController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['create'])) {
        $roomController->createRoom($_POST['room_number'], $_POST['room_type'], $_POST['price'], $_POST['availability']);
    } elseif (isset($_POST['update'])) {
        $roomController->updateRoom($_POST['id'], $_POST['room_number'], $_POST['room_type'], $_POST['price'], $_POST['availability']);
    } elseif (isset($_POST['delete'])) {
        $roomController->deleteRoom($_POST['id']);
    }
}

$rooms = $roomController->readRooms();
?>

<h1>Manage Rooms</h1>
<form method="POST">
    <input type="hidden" name="id" value="">
    <input type="text" name="room_number" placeholder="Room Number">
    <input type="text" name="room_type" placeholder="Room Type">
    <input type="number" step="0.01" name="price" placeholder="Price">
    <select name="availability">
        <option value="1">Available</option>
        <option value="0">Not Available</option>
    </select>
    <button type="submit" name="create">Create Room</button>
</form>

<h2>Existing Rooms</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Room Number</th>
        <th>Room Type</th>
        <th>Price</th>
        <th>Availability</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($rooms as $room): ?>
        <tr>
            <td><?php echo $room['id']; ?></td>
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
                    <button type="submit" name="update">Update</button>
                </form>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?php echo $room['id']; ?>">
                    <button type="submit" name="delete">Delete</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>