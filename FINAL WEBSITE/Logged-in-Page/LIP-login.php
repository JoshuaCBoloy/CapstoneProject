<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "/LIP-database.php";
    
    $sql = sprintf("SELECT * FROM user
                    WHERE email = '%s'",
                   $mysqli->real_escape_string($_POST["email"]));
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
    
    if ($user && $user["account_activation_hash"] == null) {
        
        if (password_verify($_POST["password"], $user["password_hash"])) {
            
            session_start();
            
            session_regenerate_id();
            
            $_SESSION["user_id"] = $user["id"];
            
            header("Location: LIP-index.html");
            exit;
        }
    }
    
    $is_invalid = true;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login Form</title>
	<link rel="stylesheet" type="text/css" href="css/new-style.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="image/ELT.png" />

</head>
<body>

    <img  class="wave" src="image/wave.png">
    <div class="container">
        
        <div class="img">
            <img src="image/ELT.png">
        </div>
        <div class="login-content">
            <form action="LIP-login.php" method="post">
                <img src="image/avatar.svg">
                <h2  class="title">Log In</h2>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="div">
                        <h5>Email Address</h5>
                        <input type="email" class="input" name="email" value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
                    </div>
                </div>
                
                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Password</h5>
                        <input type="password" class="input" name="password">
                    </div>
                </div>
                
            	<a href="registration.php">Don't have an account yet? Register Now</a>
                <a href="http://localhost/CapstoneProject/FINAL%20WEBSITE/index.html">Go to website</a>

                <a href="LIP-forgot-password.php">Forgot Password?</a>

                <div class="form-btn">
                    <input type="submit" class="btn btn-primary" value="Login" name="login">
                </div>
            </form>
        </div>

    <script type="text/javascript" src="js/main.js"></script>

</body>
</html>