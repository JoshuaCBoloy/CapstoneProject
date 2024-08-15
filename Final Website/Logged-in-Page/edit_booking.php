<?php
include 'db.php';

$booking_id = $_POST['booking_id'];
$number_people = $_POST['number_people'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$additional_info = $_POST['any'];

$stmt = $conn->prepare('UPDATE bookings SET number_people = ?, start_date = ?, end_date = ?, any = ? WHERE id = ?');
$stmt->bind_param('isssi', $number_people, $start_date, $end_date, $additional_info, $booking_id);

if ($stmt->execute()) {
    echo "Booking updated successfully.";
} else {
    echo "Error updating booking.";
}

$stmt->close();
$conn->close();
?>
