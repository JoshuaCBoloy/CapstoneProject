<?php
session_start();
if (isset($_SESSION["user"])) {
   header("Location: LIP-index.html");
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
</head>
<body>
    <img  class="wave" src="image/wave.png">
    <div class="container">
        <?php
        if (isset($_POST["login"])) {
           $email = $_POST["email"];
           $password = $_POST["password"];
            require_once "LIP-database.php";
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if ($user) {
                if (password_verify($password, $user["password"])) {
                    session_start();
                    $_SESSION["user"] = "yes";
                    header("Location: LIP-index.html");
                    die();
                }else{
                    echo "<div class='alert alert-danger'>Password does not match</div>";
                }
            }else{
                echo "<div class='alert alert-danger'>Email does not match</div>";
            }
        }
        ?>
        
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
                        <input type="email" class="input" name="email">
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
                
            	<a href="LIP-registration.php">Don't have an account yet? Register Now</a>
                <a href="http://localhost/CapstoneProject/FINAL%20WEBSITE/index.html">Go to website</a>

                <div class="form-btn">
                    <input type="submit" class="btn btn-primary" value="Login" name="login">
                </div>
            </form>
        </div>

    <script type="text/javascript" src="js/main.js"></script>

</body>
</html>