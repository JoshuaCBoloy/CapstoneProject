<?php
session_start();

$servername = "localhost";
$dbname = "login_db";
$username = "root";
$password = "";

$con = mysqli_connect($servername, $username, $password, $dbname);
if ($con->connect_error) {
    die("Something went wrong" . $con->connect_error);
}

if (!isset($_SESSION['user_id'])) {
    header("Location: Logged-in-Page/LIP-login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$select = mysqli_query($con, "SELECT * FROM user ");
if (mysqli_num_rows($select) > 0) {
    $id = 1;
    $n = $id + 1;
    while ($row = mysqli_fetch_array($select)) {
        // Processing rows if needed
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
        <a href="#" class="logo"><i class="ri-map-pin-fill"></i><span>Everything La Trinidad</span></a>
        <ul class="navbar">
            <li><a href="LIP-index.php" class="active">Home</a></li>
            <li><a href="LIP-index.php#about">About</a></li>
            <li><a href="LIP-choose-tourguide.php">Booking</a></li>
            <li><a href="LIP-services.html">Services</a></li>
            <li><a href="LIP-news.html">News</a></li>
            <li><a href="LIP-login.php" class="btn-warning">Logout</a></li>
        </ul>
        <div class="icons">
            <a href="../chatapplogin.php" class="chat"><span><i class="ri-chat-3-line" aria-hidden="true"></i></span><span>Chat</span></a>
            <a href="LIP-profile.php" class="login"><span><i class="ri-user-line"></i></span><span>Profile</span></a>
            <a href="LIP-maps.html" class="map"><span><i class="ri-map-pin-line"></i></span><span>Map</span></a>
            <a href="./LIP-notification.html" class="notification"><span><i class="ri-notification-line"></i></span><span>Notif</span></a>
            <div class="bx bx-menu" id="menu-icon"></div>
        </div>
    </header>
    <!-- header section ends  -->

    <section class="sign-up" id="sign-up">
        <div class="heading">
            <span>Tour Guide Booking Form</span>
            <h3>Fill Up</h3>
        </div>

        <?php
        if (isset($_POST["submit"])) {
            $numberPeople = $_POST["number_people"];
            $startDate = $_POST["start_date"];
            $endDate = $_POST["end_date"];
            $package = $_POST["package"];
            $any = $_POST["any"];

            $errors = array();

            if (empty($numberPeople) || empty($startDate) || empty($endDate)) {
                array_push($errors, "<div class='required'><h2>All fields are required</h2></div>");
            }

            // Calculate the number of days
            $startDateTime = new DateTime($startDate);
            $endDateTime = new DateTime($endDate);

            if ($startDateTime > $endDateTime) {
                array_push($errors, "<div class='required'><h2>End date must be after the starting date</h2></div>");
            }

            if (count($errors) > 0) {
                foreach ($errors as $error) {
                    echo "<div class='alert alert-danger'>$error</div>";
                }
            } else {
                $interval = $startDateTime->diff($endDateTime);
                $days = $interval->days + 1; // Include the start date in the count

                require_once "LIP-booking-database.php";
                $sql = "UPDATE `user` SET `number_people` = ?, `start_date` = ?, `end_date` = ?, `any` = ?, `package` = ?, `days` = ? WHERE `id` = ?";
                $stmt = mysqli_stmt_init($con);
                $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
                if ($prepareStmt) {
                    mysqli_stmt_bind_param($stmt, "issssii", $numberPeople, $startDate, $endDate, $any, $package, $days, $user_id);
                    mysqli_stmt_execute($stmt);
                    echo "<div class='success'><h2>Your tour guide booking is sent successfully.</h2></div>";
                } else {
                    die("Something went wrong");
                }
            }
        }
        ?>

        <br>

        <form action="LIP-sign-up-booking-p1.php" method="post">
            <div class="flex">
                <div class="inputBox">
                    <span>How many people are in your group?</span>
                    <input type="number" class="form-control" name="number_people" placeholder="Number of People:">
                </div>
                <div class="inputBox">
                    <span>Starting date you will be toured.</span>
                    <input type="date" class="form-control" name="start_date" placeholder="Starting Date:" id="start_date">
                </div>
            </div>

            <br>

            <div class="flex">
                <div class="inputBox">
                    <span>Package Chosen</span>
                    <input type="text" class="form-control" name="package" value="Package 2">
                </div>
                <div class="inputBox">
                    <span>End date you will be toured.</span>
                    <input type="date" class="form-control" name="end_date" placeholder="End Date:" id="end_date">
                </div>
            </div>

            <br>

            <div class="flex">
                <div class="inputBox">
                    <span>Price Range</span>
                    <input type="text" class="form-control" name="price" value="₱700 - ₱1,000">
                </div>
            </div>

            <br>

            <div class="flex" hidden>
                <div class="inputBox" hidden>
                    <span hidden>Number of Days</span>
                    <input type="number" class="form-control" name="days" value="" readonly hidden>
                </div>
            </div>

            <br>

            <div class="flex">
                <div class="inputBox">
                    <textarea type="text" class="form-control" name="any" placeholder="Anything else we should know?" cols="30" rows="10"></textarea>
                </div>
                <div class="inputBox">
                    <iframe class="map" src="https://www.google.com/maps/embed/v1/place?q=La+Trinidad,+Benguet,+Philippines&key=AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>

            <br>

            <div>
                <input type="submit" class="btn btn-primary" name="submit" value="Book Now">
            </div>
        </form>
    </section>

    <script>
    // Get today's date in the format YYYY-MM-DD
    var today = new Date().toISOString().split('T')[0];

    // Set the min attribute for the date inputs to block past dates
    document.getElementById('start_date').setAttribute('min', today);
    document.getElementById('end_date').setAttribute('min', today);
    </script>

</body>
</html>

