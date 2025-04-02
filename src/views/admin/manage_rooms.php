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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Rooms</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .container { margin-top: 50px; }
        .table { background-color: white; border-radius: 8px; overflow: hidden; }
        .table th { background-color: #343a40; color: white; }
        .availability-yes { color: green; font-weight: bold; }
        .availability-no { color: red; font-weight: bold; }
    </style>
</head>
<body>
<div class="container">
    <h2 class="text-center mb-4">Manage Rooms</h2>
    <div class="card p-4 shadow-sm">
        <h4>Add a New Room</h4>
        <form method="POST" class="row g-3">
            <div class="col-md-3">
                <input type="text" name="room_number" class="form-control" placeholder="Room Number" required>
            </div>
            <div class="col-md-3">
                <input type="text" name="room_type" class="form-control" placeholder="Room Type" required>
            </div>
            <div class="col-md-2">
                <input type="number" step="0.01" name="price" class="form-control" placeholder="Price" required>
            </div>
            <div class="col-md-2">
                <select name="availability" class="form-select">
                    <option value="1">Available</option>
                    <option value="0">Not Available</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" name="create" class="btn btn-primary w-100">Create Room</button>
            </div>
        </form>
    </div>
    
    <h3 class="mt-5">Existing Rooms</h3>
    <div class="table-responsive">
        <table class="table table-bordered text-center mt-3">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Room Number</th>
                    <th>Room Type</th>
                    <th>Price ($)</th>
                    <th>Availability</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rooms as $room): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($room['id']); ?></td>
                        <td><?php echo htmlspecialchars($room['room_number']); ?></td>
                        <td><?php echo htmlspecialchars($room['room_type']); ?></td>
                        <td>$<?php echo number_format($room['price'], 2); ?></td>
                        <td class="<?php echo $room['availability'] ? 'availability-yes' : 'availability-no'; ?>">
                            <?php echo $room['availability'] ? 'Available' : 'Booked'; ?>
                        </td>
                        <td>
                            <form method="POST" class="d-inline-block me-1">
                                <input type="hidden" name="id" value="<?php echo $room['id']; ?>">
                                <button type="submit" name="delete" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                            <button class="btn btn-warning btn-sm" onclick="editRoom(<?php echo htmlspecialchars(json_encode($room)); ?>)">Edit</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    function editRoom(room) {
        document.querySelector('[name=id]').value = room.id;
        document.querySelector('[name=room_number]').value = room.room_number;
        document.querySelector('[name=room_type]').value = room.room_type;
        document.querySelector('[name=price]').value = room.price;
        document.querySelector('[name=availability]').value = room.availability;
        document.querySelector('[name=create]').setAttribute('name', 'update');
        document.querySelector('[name=update]').textContent = 'Update Room';
    }
</script>

<div class="text-center mt-3">
        <a href="http://localhost/AirportHotel/public/admin_dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
    </div>

</body>
</html>
