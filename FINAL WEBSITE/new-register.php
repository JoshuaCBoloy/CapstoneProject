<?php 
session_start();
if (isset($_SESSION["user"])) {
    header("Location: new-login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Animated Login Form</title>
	<link rel="stylesheet" type="text/css" href="css/new-style.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<img class="wave" src="image/wave.png">
	<div class="container">
		<div class="img">
			<img src="image/bg.svg">
		</div>
		<div class="login-content">
			<form action="index.php">
				<img src="image/avatar.svg">
				<h2 class="title">Register Now!</h2>

           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Full Name</h5>
           		   		<input type="text" class="input">
           		   </div>
           		</div>

               <div class="input-div one">
                <div class="i">
                    <i class="fas fa-envelope"></i>
                </div>
                <div class="div">
                    <h5>Email Address</h5>
                    <input type="email" class="input">
                </div>
             </div>


             <div class="input-div one">
              <div class="i">
                  <i class="fas fa-phone"></i>
              </div>
              <div class="div">
                  <h5>Contact No.</h5>
                  <input type="tel" class="input">
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

              <div class="input-div pass">
                <div class="i"> 
                   <i class="fas fa-lock"></i>
                </div>
                <div class="div">
                   <h5>Confirm Password</h5>
                   <input type="password" class="input">
               </div>
            </div>

            	<input type="submit" class="btn" value="Register">

            </form>
        </div>
    </div>
    <script type="text/javascript" src="js/main.js"></script>
</body>
</html>
