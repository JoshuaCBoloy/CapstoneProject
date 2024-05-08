<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login Form</title>
	<link rel="stylesheet" type="text/css" href="css/forgot-password.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
</head>
<body>
          <img class="wave" src="image/wave.png" />
    <div class="container">
      <div class="img">
        <img src="image/ELT.png" />
      </div>

      <div class="login-content">
        <form action="LIP-send-password-reset.php" method="post">
          <img src="image/avatar.svg" />
          <h1 class="title">Forgot Password</h1>
          <div class="input-div one">
            <div class="i">
              <i class="fas fa-user"></i>
            </div>
            <div class="div">
              <h5>Email</h5>
              <input type="email" class="input" name="email" />
              <div class="error" id="nameError"></div>
            </div>
          </div>
          <div class="form-btn">
                <input type="submit" class="btn btn-primary" value="Send" name="login">
            </div>
        </form>
    </div>
    </form>
    </div>
    <script type="text/javascript" src="js/main.js"></script>
</body>
</html>