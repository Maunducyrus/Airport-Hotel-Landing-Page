<?php
require_once '../../controllers/BookingController.php';
$bookingController = new BookingController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = $bookingController->bookRoom($_POST['user_id'], $_POST['room_id'], $_POST['check_in_date'], $_POST['check_out_date']);
    echo "<p class='text-center text-success'>$message</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a Room</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
        }
        .booking-container {
            background: white;
            padding: 60px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }
    </style>
</head>
<body>

<div class="booking-container text-center">
    <h2 class="mb-4">Book a Room</h2>
    <form method="POST">
        <input type="hidden" name="user_id" value="<?php echo $_SESSION['user']['id']; ?>">
        
        <div class="mb-3">
            <input type="number" name="room_id" class="form-control" placeholder="Room ID" required>
        </div>
        <div class="mb-3">
            <input type="date" name="check_in_date" class="form-control" placeholder="Check-in Date" required>
        </div>
        <div class="mb-3">
            <input type="date" name="check_out_date" class="form-control" placeholder="Check-out Date" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Book Room</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
