<?php
session_start();
if (isset($_SESSION["user"])) {
    header("Location: index.html");
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Animated Login Form</title>
	
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/new-style.css">
</head>
<body>
	<img class="wave" src="image/wave.png">
	<div class="container">
		<div class="img">
			<img src="image/bg.svg">
		</div>
		<div class="login-content">
			<form action="index.html">
				<img src="image/avatar.svg">
				<h2 class="title">Log In</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Email Address</h5>
           		   		<input type="email" class="input">
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Password</h5>
           		    	<input type="password" class="input">
            	   </div>
            	</div>
            	<a href="registration.php">Don't have an account yet? Register Now</a>
            	<input type="submit" class="btn" value="Login">
            </form>
        </div>
    </div>
    <script type="text/javascript" src="js/main.js"></script>
</body>
</html>
