<?php
require_once '../../controllers/BookingController.php';
$bookingController = new BookingController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = $bookingController->bookRoom($_POST['user_id'], $_POST['room_id'], $_POST['check_in_date'], $_POST['check_out_date']);
    echo "<p>$message</p>";
}
?>

<h1>Book a Room</h1>
<form method="POST">
    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user']['id']; ?>">
    <input type="number" name="room_id" placeholder="Room ID">
    <input type="date" name="check_in_date" placeholder="Check-in Date">
    <input type="date" name="check_out_date" placeholder="Check-out Date">
    <button type="submit">Book Room</button>
</form>