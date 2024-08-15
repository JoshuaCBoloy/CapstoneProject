<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];

$stmt = $conn->prepare('UPDATE user SET first_name = ?, last_name = ?, email = ?, phone_number = ? WHERE id = ?');
$stmt->bind_param('ssssi', $first_name, $last_name, $email, $phone, $user_id);

if ($stmt->execute()) {
    header('Location: LIP-profile.php');
} else {
    echo "Error updating profile.";
}

$stmt->close();
$conn->close();
?>
