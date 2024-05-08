<?php
session_start();
if (isset($_SESSION["user"])) {
   header("Location: tourguidepage.php");
   exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour Guide Login Form</title>
    <link rel="stylesheet" type="text/css" href="css/new-style.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
</head>
<body>
    <img class="wave" src="image/wave.png">
    <div class="container">
        
        <div class="img">
            <img src="image/ELT.png">
        </div>
        <div class="login-content">
            <form action="tourguidevalidate.php" method="post"> <!-- Ensure the form submits to the correct validation script -->
                <img src="image/avatar.svg">
                <h2 class="title">Tour Guide Log In</h2>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="div">
                        <h5>Username</h5>
                        <input type="text" class="input" name="username">
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

                <div class="form-btn">
                    <input type="submit" class="btn btn-primary" value="Login" name="login">
                </div>
            </form>
        </div>

    <script type="text/javascript" src="js/main.js"></script>

</body>
</html>
