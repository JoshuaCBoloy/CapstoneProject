<?php
session_start();

$is_invalid = false;
$email_error = "";
$password_error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "/LIP-database.php";
    
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    if (empty($email)) {
        $email_error = "Email is required.";
    }
    
    if (empty($password)) {
        $password_error = "Password is required.";
    }
    
    if (empty($email_error) && empty($password_error)) {
        $sql = sprintf("SELECT * FROM user WHERE email = '%s'",
                       $mysqli->real_escape_string($email));
        
        $result = $mysqli->query($sql);
        
        $user = $result->fetch_assoc();
        
        if ($user && $user["account_activation_hash"] == null) {
            
            if (password_verify($password, $user["password_hash"])) {
                
                session_regenerate_id(true); // Regenerate session ID to prevent session fixation attacks
                
                $_SESSION["user_id"] = $user["id"];
                $_SESSION["email"] = $user["email"];
                $_SESSION["loggedin"] = true;
                
                header("Location: LIP-index.html");
                exit;
            } else {
                $password_error = "Invalid password.";
            }
        } else {
            $email_error = "Invalid email or account not activated.";
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <link rel="shortcut icon" type="image/x-icon" href="image/ELT.png" />
    <style>
        * {
  padding: 0;
  margin: 0;
  box-sizing: border-box;
}

body {
  font-family: "Poppins", sans-serif;
  overflow: hidden;
  background-color: #f8f9fa;
}

.wave {
  position: fixed;
  bottom: 0;
  left: 0;
  height: 100%;
  z-index: -1;
}

.container {
  width: 100vw;
  height: 100vh;
  display: grid;
  grid-template-columns: 1fr 1fr;
  grid-gap: 7rem;
  padding: 0 2rem;
  justify-content: center;
  align-items: center;
}

.img {
  display: flex;
  justify-content: flex-end;
  align-items: center;
}

.login-content {
  display: flex;
  justify-content: center;
  align-items: center;
  text-align: center;
  padding: 40px;
}

.img img {
  width: 500px;
}

form {
  width: 100%;
}

.login-content img {
  height: 100px;
}

.login-content h2 {
  margin: 15px 0;
  color: #333;
  text-transform: uppercase;
  font-size: 2.9rem;
}

.row {
  display: flex;
  justify-content: space-between;
  flex-wrap: wrap;
}

.col {
  flex: 0 0 48%;
}

.col-12 {
  flex: 0 0 100%;
}

.input-div {
  position: relative;
  display: grid;
  grid-template-columns: 7% 93%;
  margin: 15px 0;
  padding: 5px 0;
  border-bottom: 2px solid #d9d9d9;
  width: 100%;
}

.i {
  color: #d9d9d9;
  display: flex;
  justify-content: center;
  align-items: center;
}

.i i {
  transition: 0.3s;
}

.input-div > div {
  position: relative;
  height: 45px;
  margin-bottom: 10px;
}

.input-div > div > h5 {
  position: absolute;
  left: 10px;
  top: 50%;
  transform: translateY(-50%);
  color: #999;
  font-size: 18px;
  transition: 0.3s;
}

.input-div > div > input:not(:placeholder-shown) + h5 {
  top: -5px;
  font-size: 15px;
}

.input-div:before,
.input-div:after {
  content: "";
  position: absolute;
  bottom: -2px;
  width: 0%;
  height: 2px;
  background-color: #38d39f;
  transition: 0.4s;
}

.input-div:before {
  right: 50%;
}

.input-div:after {
  left: 50%;
}

.input-div.focus:before,
.input-div.focus:after {
  width: 50%;
}

.input-div.focus > div > h5 {
  top: -5px;
  font-size: 15px;
}

.input-div.focus > .i > i {
  color: #38d39f;
}

.input-div > div > input {
  position: absolute;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  border: none;
  outline: none;
  background: none;
  padding: 0.5rem 0.7rem;
  font-size: 1.2rem;
  color: #555;
  font-family: "Poppins", sans-serif;
}

a {
  display: block;
  text-align: right;
  text-decoration: none;
  color: #999;
  font-size: 0.9rem;
  transition: 0.3s;
}

a:hover {
  color: #38d39f;
}

.btn {
  display: block;
  width: 100%;
  height: 50px;
  border-radius: 25px;
  outline: none;
  border: none;
  background-image: linear-gradient(to right, #32be8f, #38d39f, #32be8f);
  background-size: 200%;
  font-size: 1.2rem;
  color: #fff;
  font-family: "Poppins", sans-serif;
  text-transform: uppercase;
  margin: 1rem 0;
  cursor: pointer;
  transition: 0.5s;
}
.btn:hover {
  background-position: right;
}

.error {
  color: red;
  font-size: 12px;
  margin-top: 1px;
  margin-bottom: 40px;
}

.signup-text {
  text-align: center;
  margin-top: 17rem;
}

.signup-text a {
  text-decoration: none;
  color: #999;
  font-size: 30px;
  font-weight: bold;
  transition: 0.3s;
  text-align: center;
}

.signup-text a:hover {
  color: #38d39f;
}

@media screen and (max-width: 1050px) {
  .container {
      grid-gap: 5rem;
  }
}

@media screen and (max-width: 1000px) {
  form {
      width: 290px;
  }

  .login-content h2 {
      font-size: 2.4rem;
      margin: 8px 0;
  }

  .img img {
      width: 400px;
  }
}

@media screen and (max-width: 900px) {
  .container {
      grid-template-columns: 1fr;
  }

  .img {
      display: none;
  }

  .wave {
      display: none;
  }

  .login-content {
      justify-content: center;
  }

  .col {
      flex: 0 0 100%;
  }
}

</style>
</head>
<body>

<img class="wave" src="image/wave.png">
<div class="container">

    <div class="img">
        <img src="image/ELT.png">
    </div>
    <div class="login-content">
        <form id="loginForm" action="LIP-login.php" method="post" onsubmit="return validateForm()">
            <img src="image/avatar.svg">
            <h2 class="title">Sign In</h2>
            <div class="input-div one">
                <div class="i">
                    <i class="fas fa-envelope"></i>
                </div>
                <div class="div">
                    <h5>Email Address</h5>
                    <input type="email" class="input" id="email" name="email" value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
                </div>
            </div>
            <?php if (!empty($email_error)): ?>
                <div class="error"><?= htmlspecialchars($email_error) ?></div>
            <?php endif; ?>

            <div class="input-div pass">
                <div class="i">
                    <i class="fas fa-lock"></i>
                </div>
                <div class="div">
                    <h5>Password</h5>
                    <input type="password" class="input" id="password" name="password">
                    <i class="fa fa-eye password-toggle" id="togglePassword"></i>
                </div>
            </div>
            <?php if (!empty($password_error)): ?>
                <div class="error"><?= htmlspecialchars($password_error) ?></div>
            <?php endif; ?>

            <a href="LIP-forgot-password.php">Forgot Password?</a>

            <div class="form-btn">
                <input type="submit" class="btn btn-primary" value="Login" name="login">
            </div>

            <a href="registration.php" style="text-align: center;">Don't have an account yet? Register Now</a>
            <a href="../index.html" style="text-align: center;">Go to website</a>
        </form>
    </div>

    <script type="text/javascript" src="js/main.js"></script>
    <script>
        function validateForm() {
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;
            var isValid = true;

            if (!email) {
                document.getElementById('email').nextElementSibling.innerHTML = "Email is required.";
                isValid = false;
            } else {
                document.getElementById('email').nextElementSibling.innerHTML = "";
            }

            if (!password) {
                document.getElementById('password').nextElementSibling.innerHTML = "Password is required.";
                isValid = false;
            } else {
                document.getElementById('password').nextElementSibling.innerHTML = "";
            }

            return isValid;
        }

        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function (e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>
</html>