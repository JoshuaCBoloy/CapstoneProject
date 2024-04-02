<?php

$errors = [];


if (empty($_POST["full_name"])) {
  die("Full Name is required");
}

if ( ! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
  die("Valid email is required");
}

if (strlen($_POST["password"]) < 8) {
  die("Password must be at least 8 characters");
}

if ( ! preg_match("/[a-z]/i", $_POST["password"])) {
  die("Password must contain at least one letter");
}

if ( ! preg_match("/[0-9]/", $_POST["password"])) {
  die("Password must contain at least one number");
}

if ($_POST["password"] !== $_POST["repeat_password"]) {
  die("Passwords must match");
}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$activation_token = bin2hex(random_bytes(16));

$activation_token_hash = hash("sha256", $activation_token);

$mysqli = require __DIR__ . "/LIP-database.php";

$sql = "INSERT INTO user (full_name, email, password_hash, account_activation_hash)
        VALUES (?, ?, ?, ?)";
        
$stmt = $mysqli->stmt_init();

if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("ssss",
                  $_POST["full_name"],
                  $_POST["email"],
                  $password_hash,
                  $activation_token_hash);
                  
if ($stmt->execute()) {

  $mail = require __DIR__ . "/LIP-mailer.php";

  $mail->setFrom("noreply@example.com");
  $mail->addAddress($_POST["email"]);
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
        die("email already taken");
    } else {
        die($mysqli->error . " " . $mysqli->errno);
    }
}

