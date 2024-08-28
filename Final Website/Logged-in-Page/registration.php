<?php
// Process the signup form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];

    if (empty($_POST["first_name"])) {
        $errors[] = "First Name is required";
    }

    if (empty($_POST["last_name"])) {
        $errors[] = "Last Name is required";
    }

    if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Valid email is required";
    }

    if (empty($_POST["phone"])) {
        $errors[] = "Phone number is required";
    } elseif (!preg_match("/^\d{10,11}$/", $_POST["phone"])) {
        $errors[] = "Phone number must be 10 or 11 digits";
    }

    if (strlen($_POST["password"]) < 8) {
        $errors[] = "Password must be at least 8 characters";
    }

    if (!preg_match("/[a-z]/i", $_POST["password"])) {
        $errors[] = "Password must contain at least one letter";
    }

    if (!preg_match("/[0-9]/", $_POST["password"])) {
        $errors[] = "Password must contain at least one number";
    }

    if ($_POST["password"] !== $_POST["repeat_password"]) {
        $errors[] = "Passwords must match";
    }

    if (empty($errors)) {
        $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $activation_token = bin2hex(random_bytes(16));
        $activation_token_hash = hash("sha256", $activation_token);

        $mysqli = require __DIR__ . "/LIP-database.php";

        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $email = $_POST["email"];
        $phone_number = $_POST["phone"];

        $sql = "INSERT INTO user (first_name, last_name, email, phone_number, password_hash, account_activation_hash)
                VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $mysqli->stmt_init();

        if (!$stmt->prepare($sql)) {
            die("SQL error: " . $mysqli->error);
        }

        $stmt->bind_param("ssssss",
            $first_name,
            $last_name,
            $email,
            $phone_number,
            $password_hash,
            $activation_token_hash);

        if ($stmt->execute()) {
            $mail = require __DIR__ . "/LIP-mailer.php";

            $mail->setFrom("noreply@example.com");
            $mail->addAddress($email);
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
                die("Email already taken");
            } else {
                die($mysqli->error . " " . $mysqli->errno);
            }
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Form</title>
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
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 0 2rem;
}

.img {
    display: flex;
    justify-content: flex-end;
    align-items: center;
}

.login-content {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    padding: 40px;
    width: 60%;
    max-width: 900px;
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
    display: flex;
    justify-content: center;
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
    width: 48%;
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
            margin-top: 5px;
        }

.error-message {
            color: red;
            font-size: 14px;
            margin-top: 10px;
            text-align: center;
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

.password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 1.2rem;
            color: #999;
        }
        .password-toggle:hover {
            color: #38d39f;
        }

.signup-text a:hover {
    color: #38d39f;
}

@media screen and (max-width: 1050px) {
    .container {
        flex-direction: column;
    }
    .login-content {
        width: 90%;
    }
}

@media screen and (max-width: 1000px) {
    form {
        width: 100%;
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
        flex-direction: column;
    }

    .img {
        display: none;
    }

    .wave {
        display: none;
    }

    .login-content {
        width: 90%;
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
        <form id="signupForm" action="" method="post" onsubmit="return validateForm()">
            <img src="image/avatar.svg">
            <h2 class="title">Sign Up</h2>
            <div class="row">
                <div class="col">
                    <div class="input-div one">
                        <div class="i">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="div">
                            <h5>First Name</h5>
                            <input type="text" class="input" id="first_name" name="first_name" required>
                            <span class="error" id="first_name_error"></span>
                        </div>
                    </div>
                    <div class="input-div one">
                        <div class="i">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="div">
                            <h5>Last Name</h5>
                            <input type="text" class="input" id="last_name" name="last_name" required>
                            <span class="error" id="last_name_error"></span>
                        </div>
                    </div>
                    <div class="input-div one">
                        <div class="i">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="div">
                            <h5>Email</h5>
                            <input type="email" class="input" id="email" name="email" required>
                            <span class="error" id="email_error"></span>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="input-div one">
                        <div class="i">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="div">
                            <h5>Phone Number</h5>
                            <input type="tel" class="input" id="phone" name="phone" maxlength="11" required>
                            <span class="error" id="phone_error"></span>
                        </div>
                    </div>
                    <div class="input-div pass">
                        <div class="i">
                            <i class="fas fa-lock"></i>
                        </div>
                        <div class="div">
                            <h5>Password</h5>
                            <input type="password" class="input" id="password" name="password" required>
                            <span class="password-toggle">
                                <i class="fa fa-eye" id="togglePassword"></i>
                            </span>
                            <span class="error" id="password_error"></span>
                        </div>
                    </div>
                    <div class="input-div pass">
                        <div class="i">
                            <i class="fas fa-lock"></i>
                        </div>
                        <div class="div">
                            <h5>Repeat Password</h5>
                            <input type="password" class="input" id="repeat_password" name="repeat_password" required>
                            <span class="password-toggle">
                                <i class="fa fa-eye" id="toggleRepeatPassword"></i>
                            </span>
                            <span class="error" id="repeat_password_error"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <input type="submit" class="btn" value="Sign Up">
                </div>
            </div>
            <a href="LIP-login.php" style="text-align: center;">Already have an account? Login</a>
            <div class="error-message" id="form_error"></div>
        </form>
    </div>
</div>
<script src="js/main.js"></script>
<script>
    // JavaScript to toggle password visibility
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');

    togglePassword.addEventListener('click', function (e) {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
    });

    const toggleRepeatPassword = document.querySelector('#toggleRepeatPassword');
    const repeatPassword = document.querySelector('#repeat_password');

    toggleRepeatPassword.addEventListener('click', function (e) {
        const type = repeatPassword.getAttribute('type') === 'password' ? 'text' : 'password';
        repeatPassword.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
    });

    function validateForm() {
        let isValid = true;
        let errors = [];

        if (!document.getElementById('first_name').value) {
            errors.push("First Name is required");
            isValid = false;
        }

        if (!document.getElementById('last_name').value) {
            errors.push("Last Name is required");
            isValid = false;
        }

        if (!document.getElementById('email').value) {
            errors.push("Email is required");
            isValid = false;
        }

        if (!document.getElementById('phone').value) {
            errors.push("Phone number is required");
            isValid = false;
        }

        if (!document.getElementById('password').value) {
            errors.push("Password is required");
            isValid = false;
        }

        if (document.getElementById('password').value !== document.getElementById('repeat_password').value) {
            errors.push("Passwords do not match");
            isValid = false;
        }

        if (!isValid) {
            document.getElementById('form_error').innerText = errors.join(", ");
        }

        return isValid;
    }
</script>
</body>
</html>