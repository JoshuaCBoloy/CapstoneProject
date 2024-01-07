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
	<?php
		if (isset($_POST["submit"])) {
			$fullName = $_POST["fullname"];
			$email = $_POST["email"];
			$password = $_POST["password"];
			$passwordRepeat = $_POST["repeat_password"];

			$passwordHash = password_hash($password, PASSWORD_DEFAULT);

			$errors = array();

			if (empty($fullName) OR empty($email) OR empty($password) OR empty($passwordRepeat)) {
				array_push($errors, "All fields are required");
			}
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				array_push($errors, "Email is not valid");
			}
			if (strlen($password)<8) {
				array_push($errors, "Password must be at least 8 characters long");
			}
			if ($password!==$passwordRepeat) {
				array_push($erros, "Password does not match");
			}

			require_once "new-database.php";
			$sql = "SELECT * FROM users WHERE email = '$email'";
			$result = mysqli_query($conn, $sql);
			$rowCount = mysqli_num_rows($result);
			if ($rowCount>0) {
				array_push($errors, "Email already exists!");
			}
			if (count($errors)>0) {
				foreach ($errors as $error) {
					echo "<div class='alert alert-danger'>$error</div>";
				}
			}else{
				$sql = "INSERT INTO users (full_name, email, password) VALUES ( ?, ?, ? )";
				$stmt = mysqli_stmt_init($conn);
				$prepareStmt = mysqli_stmt_prepare($stmt,$sql);
				if ($prepareStmt) {
					mysqli_stmt_bind_param($stmt, "sss", $fullName, $email, $passwordHash);
					mysqli_stmt_execute($stmt);
					echo "<div class='alert alert-success'>You are registered successfully.</div>";
				}else{
					die("Something went wrong");
				}
			}
		}
		?>

		<div class="img">
			<img src="image/bg.svg">
		</div>
		<div class="login-content">
			<form action="new-login.php">
				<img src="image/avatar.svg">
				<h2 class="title">Register Now!</h2>

           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Full Name</h5>
           		   		<input type="text" class="input" name="fullname">
           		   </div>
           		</div>

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

              <div class="input-div pass">
                <div class="i"> 
                   <i class="fas fa-lock"></i>
                </div>
                <div class="div">
                   <h5>Confirm Password</h5>
                   <input type="password" class="input" name="repeat_password">
               </div>
            </div>

            	<input type="submit" class="btn btn-primary" value="Register" name="submit">

            </form>
        </div>
    </div>
    <script type="text/javascript" src="js/main.js"></script>
</body>
</html>
