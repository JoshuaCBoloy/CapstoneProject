<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- remix icon cdn link  -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/sign-up-booking.css">

    <title>Everything La Trinidad</title>
</head>

<body>

   
    <!-- header section starts  -->

    <header class="header">

        <a href="index.html" class="logo"> <i class="ri-map-pin-fill"></i> Everything La Trinidad </a>

        <nav class="navbar">
            <a href="LIP-index.html">home</a>
            <a href="LIP-index.html#about">about</a>
            <a href="LIP-sign-up-booking.php">booking</a>
            <a href="LIP-services.html">services</a>
            <a href="LIP-news.html">news</a>
            <a href="LIP-maps.html">maps</a>
            <a href="http://localhost:8081/CapstoneProject/WEBSITE/chatapplogin.php">chat</a>
            <a href="LIP-logout.php" class="btn-warning">Logout</a>
        </nav>

        <div class="icons">
            <div id="search-btn" class="ri-search-line"></div>
            <div id="login-btn" class="ri-user-line"></div>
            <script>
                document.querySelector('#login-btn').onclick = () => {
                    window.location.href = 'LIP-profile.php';
                }
            </script>
            <div id="notif-btn" class="ri-notification-2-line"></i>
        </div>

    </header>

    <!-- header section ends  -->


<section class="sign-up" id="sign-up">
            <div class="heading">
                <span>Tour Guide Booking</span>
                <h3>Sign up</h3>
            </div>

            <?php
            if (isset($_POST["submit"])) {
                $firstName = $_POST["first_name"];
                $lastName = $_POST["last_name"];
                $email = $_POST["email"];
                $phoneNumber = $_POST["phone_number"];
                $numberPeople = $_POST["number_people"];
                $tourDays = $_POST["tour_days"];
                $any = $_POST["any"];

                $errors = array();

                if (empty($firstName) OR empty($lastName) OR empty($email) OR empty($phoneNumber) OR empty($numberPeople) OR empty($tourDays) OR empty($any)) {
                    array_push($errors, "<div class='required'><h2>All fields are required</h2></div>");
                }
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    array_push($errors, "<div class='valid'><h2>Email is not valid</h2></div>");
                }
                if (!is_numeric($phoneNumber)) {
                    array_push($errors);
                }
                if (!is_numeric($numberPeople)) {
                    array_push($errors);
                }
                if (!is_numeric($tourDays)) {
                    array_push($errors);
                }

                if (count($errors)>0) {
                    foreach($errors as $error) {
                        echo "<div class='alert alert-danger'>$error</div>";
                    }
                }else {
                    require_once "LIP-booking-database.php";
                    $sql = "INSERT INTO users (first_name, last_name, email, phone_number, number_people, tour_days, any) VALUES ( ?, ?, ?, ?, ?, ?, ? )";
                    $stmt = mysqli_stmt_init($conn);
                    $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
                    if ($prepareStmt) {
                        mysqli_stmt_bind_param($stmt, "sssiiis", $firstName, $lastName, $email, $phoneNumber, $numberPeople, $tourDays, $any);
                        mysqli_stmt_execute($stmt);
                        echo "<div class='success'><h2>Your tour guide booking is sent successfully.</h2></div>";
                    }else {
                        die("Something went wrong");
                    }
                }

            }
            ?>

            <br>

            <form action="LIP-sign-up-booking.php" method="post">
                <div class="flex">
                    <div class="inputBox">
                        <span>First Name:</span>
                        <input type="text" class="form-control" name="first_name" placeholder="First Name:">
                    </div>
                    <div class="inputBox">
                        <span>Last Name:</span>
                        <input type="text" class="form-control" name="last_name" placeholder="Last Name:">
                    </div>
                </div>

                <br>
    
                <div class="flex">
                    <div class="inputBox">
                        <span>Email:</span>
                        <input type="email" class="form-control" name="email" placeholder="Your Email:">
                    </div>
                    <div class="inputBox">
                        <span>Phone Number:</span>
                        <input type="tel" class="form-control" name="phone_number" pattern="[0-9]{11}" placeholder="Your Number:">
                    </div>
                </div>

                <br>
    
                <div class="flex">
                    <div class="inputBox">
                        <span>How many people are in your group?</span>
                        <input type="number" class="form-control" name="number_people" placeholder="Number of People:">
                    </div>
                    <div class="inputBox">
                        <span>How long will you be toured?</span>
                        <input type="number" class="form-control" name="tour_days" placeholder="Days of Tour:">
                    </div>
                </div>

                <br>
     
                <div class="flex">
                    <div class="inputBox">
                        <textarea type="text" class="form-control" name="any" placeholder="Anything else we should know?" cols="30" rows="10"></textarea>
                    </div>
                    <div class="inputBox">
                        <iframe class="map"
                            src="https://www.google.com/maps/embed/v1/place?q=La+Trinidad,+Benguet,+Philippines&key=AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8"
                            allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>

                <br>

                <div>
                    <input type="submit" class="btn btn-primary" name="submit" value="Book Now">
                </div>
            </form>
 
</body>
</html>