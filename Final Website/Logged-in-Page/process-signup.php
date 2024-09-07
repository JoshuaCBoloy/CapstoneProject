<?php

$errors = [];

if (empty($_POST["first_name"])) {
    die("First Name is required");
}

if (empty($_POST["last_name"])) {
    die("Last Name is required");
}

if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    die("Valid email is required");
}

if (strlen($_POST["password"]) < 8) {
    die("Password must be at least 8 characters");
}

if (!preg_match("/[a-z]/i", $_POST["password"])) {
    die("Password must contain at least one letter");
}

if (!preg_match("/[0-9]/", $_POST["password"])) {
    die("Password must contain at least one number");
}

if ($_POST["password"] !== $_POST["repeat_password"]) {
    die("Passwords must match");
}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$activation_token = bin2hex(random_bytes(16));

$activation_token_hash = hash("sha256", $activation_token);

$mysqli = require __DIR__ . "/LIP-database.php";

$first_name = $_POST["first_name"];
$last_name = $_POST["last_name"];
$email = $_POST["email"];
$phone_number = $_POST["phone"];

$sql = "INSERT INTO user (first_name, last_name, email, phone_number, password_hash, account_activation_hash)
        VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $mysqli->stmt_init();

if (!$stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("ssssss",
    $first_name,
    $last_name,
    $email,
    $phone_number,
    $password_hash,
    $activation_token_hash);

if ($stmt->execute()) {

    $mail = require __DIR__ . "/LIP-mailer.php";

    // Ensure the mailer object is properly initialized
    if (!$mail) {
        die("Mailer initialization failed");
    }

    $mail->setFrom("noreply@example.com");
    $mail->addAddress($email);
    $mail->Subject = "Account Activation";
    $mail->Body = <<<END
Click <a href="http://localhost/CapstoneProject/FINAL%20WEBSITE/Logged-in-Page/LIP-activate-account.php?token=$activation_token">here</a> 
to ACTIVATE YOUR ACCOUNT.
END;

    try {
        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";
        exit;
    }

    header("Location: signup-success.html");
    exit;

} else {
    if ($mysqli->errno === 1062) {
        die("Email already taken");
    } else {
        die($mysqli->error . " " . $mysqli->errno);
    }
}
