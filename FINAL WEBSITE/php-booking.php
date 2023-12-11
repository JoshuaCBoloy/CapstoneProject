<?php
session_start();
if (isset($_SESSION["user"])) {
   header("Location: php-booking.php");
}
?>

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
    <link rel="stylesheet" href="css/booking.css">

    <title>Everything La Trinidad</title>
</head>

<body>

    <!-- header section starts  -->

    <header class="header">

        <a href="index.html" class="logo"> <i class="ri-store-2-line"></i> Everything La Trinidad </a>

        <nav class="navbar">
            <a href="index.html">home</a>
            <a href="index.html#about">about</a>
            <a href="user-booking.html">booking</a>
            <a href="services.html">services</a>
            <a href="news.html">news</a>
        </nav>

        <div class="icons">
            <div id="menu-btn" class="ri-menu-line"></div>
            <div id="search-btn" class="ri-search-line"></div>
            <div id="cart-btn" class="ri-shopping-cart-line"></div>
            <div id="login-btn" class="ri-user-line"></div>
        </div>

    </header>
    <!-- header section ends -->


    <!-- tour guide booking section starts -->
    <section class="booking" id="booking">
        <section class="sign-up" id="sign-up">
            <div class="heading">
                <span>Tour Guide Booking</span>
                <h3>Sign up</h3>
            </div>

            <?php
            if (isset($_POST["submit"])) {
                $firstName = $_POST["firstname"];
                $lastName = $_POST["lastname"];
                $email = $_POST["email"];
                $phoneNumber = $_POST["phone_number"];
                $numberPeople = $_POST["number_people"];
                $tourDays = $_POST["tour_days"];
                
                $errors = array();

                if (empty($firstName) OR empty($lastName) OR empty($email) OR empty($phoneNumber) OR empty($numberPeople) OR empty($tourDays)) {
                    array_push($errors, "All fields are required");
                }
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    array_push($errors, "Email is not valid");
                }
                if (is_numeric($phoneNumber) OR ($numberPeople) OR ($tourDays)) {
                    array_push($errors, "Input not valid");
                }
                require_once "booking-database.php";
                $sql = "SELECT * FROM users WHERE email = '$email'";
                $result = mysqli_query($conn, $sql);
                $rowCount = mysqli_num_rows($result);
                if ($rowCount>0) {
                    array_push($errors, "Email already used!");
                }
                if (count($errors)>0) {
                    foreach ($errors as $error) {
                        echo "<div class='alert alert-danger'>$error</div>";
                    }
                }else {
                    $sql = "INSERT INTO users (first_name, last_name, email, phone_number, number_people, tour_days) VALUES ( ?, ?, ?, ?, ?, ? )";
                    $stmt = mysqli_stmt_init($conn);
                    $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
                    if ($prepareStmt) {
                        mysqli_stmt_bind_param($stmt, "sssiii", $firstName, $lastName, $email, $phoneNumber, $numberPeople, $tourDays);
                        mysqli_stmt_execute($stmt);
                        echo "<div class='alert alert-success'>Your tour guide book is sent successfully. Wait for response.</div>";
                    }else {
                        die("Something went wrong");
                    }
                }
            }
            ?>


            <form action="sign-up.php" method="post">
                <div class="flex">
                    <div class="inputBox">
                        <span>first name:</span>
                        <input type="text" class="form-control" name="firstname" placeholder="First Name:">
                    </div>
                    <div class="inputBox">
                        <span>last name:</span>
                        <input type="text" class="form-control" name="lastname" placeholder="Last Name:">
                    </div>
                </div>

                <br>
    
                <div class="flex">
                    <div class="inputBox">
                        <span>email:</span>
                        <input type="email" class="form-control" name="email" placeholder="Your Email:">
                    </div>
                    <div class="inputBox">
                        <span>phone number:</span>
                        <input type="number" class="form-control" name="phone_number" placeholder="Your Number:">
                    </div>
                </div>

                <br>
    
                <div class="flex">
                    <div class="inputBox">
                        <span>how many people are in your group?</span>
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
                        <textarea type="text" class="form-control" name="anything" placeholder="Anything else we should know?" cols="30" rows="10"></textarea>
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

        </section>

    </section>

    <!-- tour guide booking section ends -->
    

    <!-- custom js file link  -->
    <script src="js/script.js"></script>

</body>
</html>