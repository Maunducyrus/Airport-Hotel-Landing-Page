<?php
require_once '../../controllers/RoomController.php';
$roomController = new RoomController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $roomController->updateRoom($_POST['id'], $_POST['room_number'], $_POST['room_type'], $_POST['price'], $_POST['availability']);
}

$rooms = $roomController->readRooms();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Room Availability</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 40px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            background-color: #fff;
        }
        th {
            background-color: #343a40;
            color: #ffffff;
        }
        .btn-update {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
        }
        .btn-update:hover {
            background-color: #0056b3;
        }
        select, input {
            margin-right: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Manage Room Availability</h1>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Room Number</th>
                    <th>Room Type</th>
                    <th>Price</th>
                    <th>Availability</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rooms as $room): ?>
                    <tr>
                        <td><?php echo $room['room_number']; ?></td>
                        <td><?php echo $room['room_type']; ?></td>
                        <td><?php echo $room['price']; ?></td>
                        <td>
                            <span class="badge bg-<?php echo $room['availability'] ? 'success' : 'danger'; ?>">
                                <?php echo $room['availability'] ? 'Available' : 'Not Available'; ?>
                            </span>
                        </td>
                        <td>
                            <form method="POST" class="d-flex">
                                <input type="hidden" name="id" value="<?php echo $room['id']; ?>">
                                <input type="text" class="form-control form-control-sm" name="room_number" value="<?php echo $room['room_number']; ?>" required>
                                <input type="text" class="form-control form-control-sm" name="room_type" value="<?php echo $room['room_type']; ?>" required>
                                <input type="number" step="0.01" class="form-control form-control-sm" name="price" value="<?php echo $room['price']; ?>" required>
                                <select name="availability" class="form-select form-select-sm">
                                    <option value="1" <?php if ($room['availability']) echo 'selected'; ?>>Available</option>
                                    <option value="0" <?php if (!$room['availability']) echo 'selected'; ?>>Not Available</option>
                                </select>
                                <button type="submit" class="btn btn-update btn-sm">Update</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="text-center mt-3">
        <a href="http://localhost/AirportHotel/public/staff_dashboard.php" class="btn btn-secondary">Back to Dashboard</a>
    </div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
