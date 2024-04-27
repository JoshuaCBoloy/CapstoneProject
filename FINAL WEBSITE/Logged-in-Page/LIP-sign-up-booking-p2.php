<?php
session_start();

$servername = "localhost";
$dbname = "login_db";
$username = "root";
$password = "";

$con = mysqli_connect($servername, $username, $password, $dbname);
if ($con->connect_error){
    die("Something went wrong" . $con->connect_error);
}

if(!isset($_SESSION['user_id'])) {
    header("Location: Logged-in-Page/LIP-login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$select = mysqli_query($con, "SELECT * FROM user ");
if(mysqli_num_rows($select)>0){
    $id=1;
    $n=$id+1;
    while($row=mysqli_fetch_array($select)){
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="image/ELT.png" />

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
            <a href="LIP-index.html">Home</a>
            <a href="LIP-index.html#about">About</a>
            <a href="LIP-choose-tourguide.php">Booking</a>
            <a href="LIP-services.html">Services</a>
            <a href="LIP-news.html">News</a>
            <a href="LIP-logout.php" class="btn-warning">Logout</a>
        </nav>

        <div class="icons">
            <div id="chat-btn" class="ri-chat-3-line"></div>
            <script>
                document.querySelector('#chat-btn').onclick = () => {
                    window.location.href = '../chatapplogin.php';
                }
            </script>
            <div id="login-btn" class="ri-user-line"></div>
            <script>
                document.querySelector('#login-btn').onclick = () => {
                    window.location.href = 'LIP-profile.php';
                }
            </script>
            <div id="map-btn" class="ri-map-pin-line">
            <script>
                document.querySelector('#map-btn').onclick = () => {
                    window.location.href = 'https://www.google.com/maps/place/La+Trinidad,+Benguet/@16.4787946,120.5665467,12300m/data=!3m1!1e3!4m6!3m5!1s0x3391a3aef768cde3:0x58d076983f455a79!8m2!3d16.4774284!4d120.5854674!16zL20vMDZtZnI3?entry=ttu';
                }
                </script>
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
                $phoneNumber = $_POST["phone_number"];
                $numberPeople = $_POST["number_people"];
                $startDate = $_POST["start_date"];
                $endDate = $_POST["end_date"];
                $package = $_POST["package"];
                $any = $_POST["any"];

                $errors = array();

                if (empty($firstName) OR empty($lastName) OR empty($phoneNumber) OR empty($numberPeople) OR empty($startDate) OR empty($endDate)) {
                    array_push($errors, "<div class='required'><h2>All fields are required</h2></div>");
                }
                if (!is_numeric($phoneNumber)) {
                    array_push($errors);
                }
                if (!is_numeric($numberPeople)) {
                    array_push($errors);
                }

                if (count($errors)>0) {
                    foreach($errors as $error) {
                        echo "<div class='alert alert-danger'>$error</div>";
                    }
                }else {
                    require_once "LIP-booking-database.php";
                    $sql = "UPDATE `user` SET `first_name` = ?, `last_name` = ?, `phone_number` = ?, `number_people` = ?, `start_date` = ?, `end_date` = ?, `any` = ?, `package` = ? WHERE `id` = ?";
                    $stmt = mysqli_stmt_init($con);
                    $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
                    if ($prepareStmt) {
                        mysqli_stmt_bind_param($stmt, "sssissssi", $firstName, $lastName, $phoneNumber, $numberPeople, $startDate, $endDate, $any, $package, $user_id);
                        mysqli_stmt_execute($stmt);
                        echo "<div class='success'><h2>Your tour guide booking is sent successfully.</h2></div>";
                    } else {
                        die("Something went wrong");
                    }                    
                }
            }
            ?>

            <br>

            <form action="LIP-sign-up-booking-p2.php" method="post">
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
                        <span>Phone Number:</span>
                        <input type="text" class="form-control" name="phone_number" pattern="[0-9]{11}" placeholder="Your Number:">
                    </div>
                </div>

                <br>
    
                <div class="flex">
                    <div class="inputBox">
                        <span>How many people are in your group?</span>
                        <input type="number" class="form-control" name="number_people" placeholder="Number of People:">
                    </div>
                    <div class="inputBox">
                        <span>Starting date you will be toured.</span>
                        <input type="date" class="form-control" name="start_date" placeholder="Starting Date:">
                    </div>
                </div>

                <br>

                <div class="flex">
                    <div class="inputBox">
                        <span>Package Chosen</span>
                        <input type="text" class="form-control" name="package" value="Package 1"></input>
                    </div>
                    <div class="inputBox">
                        <span>End date you will be toured.</span>
                        <input type="date" class="form-control" name="end_date" placeholder="End Date:">
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