<?php
require_once '../../controllers/RoomController.php';
$roomController = new RoomController();
$rooms = $roomController->readRooms();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Rooms</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        .table {
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
        }
        .table th {
            background-color: #343a40;
            color: white;
        }
        .table td {
            vertical-align: middle;
        }
        .availability-yes {
            color: green;
            font-weight: bold;
        }
        .availability-no {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center mb-4">View Available Rooms</h2>

    <div class="table-responsive">
        <table class="table table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>Room Number</th>
                    <th>Room Type</th>
                    <th>Price ($)</th>
                    <th>Availability</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rooms as $room): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($room['room_number']); ?></td>
                        <td><?php echo htmlspecialchars($room['room_type']); ?></td>
                        <td>$<?php echo number_format($room['price'], 2); ?></td>
                        <td class="<?php echo $room['availability'] ? 'availability-yes' : 'availability-no'; ?>">
                            <?php echo $room['availability'] ? 'Available' : 'Booked'; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
