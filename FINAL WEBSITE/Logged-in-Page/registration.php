<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registration Form</title>
    <link rel="stylesheet" type="text/css" href="css/new-style.css" />
    <link rel="shortcut icon" type="image/x-icon" href="image/ELT.png" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
  </head>
  <body>
    <img class="wave" src="image/wave.png" />
    <div class="container">
      <div class="img">
        <img src="image/ELT.png" />
      </div>
      <div class="login-content">
        <form action="process-signup.php" method="post" id="signup" onsubmit="return validateForm()">
          <img src="image/avatar.svg" />
          <h2 class="title">Sign Up</h2>
          <div class="input-div one">
            <div class="i">
              <i class="fas fa-user"></i>
            </div>
            <div class="div">
              <h5>Full Name</h5>
              <input type="text" class="input" name="full_name" />
              <div class="error" id="nameError"></div>
            </div>
          </div>

          <div class="input-div one">
            <div class="i">
              <i class="fas fa-envelope"></i>
            </div>
            <div class="div">
              <h5>Email Address</h5>
              <input type="email" class="input" name="email"/>
              <div class="error" id="emailError"></div>
            </div>
          </div>

          <div class="input-div pass">
            <div class="i">
              <i class="fas fa-lock"></i>
            </div>
            <div class="div">
              <h5>Password</h5>
              <input type="password" class="input" name="password"/>
              <div class="error" id="passwordError"></div>
            </div>
          </div>

          <div class="input-div pass">
            <div class="i">
              <i class="fas fa-lock"></i>
            </div>
            <div class="div">
              <h5>Confirm Password</h5>
              <input type="password" class="input" name="repeat_password"/>
              <div class="error" id="confirmPasswordError"></div>
            </div>
          </div>

          <a href="LIP-login.php">Already Registered? Login Here</a>

          <div class="form-btn">
            <input
              type="submit"
              class="btn btn-primary"
              value="Register"
              name="submit"
            />
          </div>
        </form>
      </div>
    </div>
    <script type="text/javascript" src="js/main.js"></script>
  </body>
</html>
