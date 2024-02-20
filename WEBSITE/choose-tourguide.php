<?php
$con = mysqli_connect('localhost', 'root', '', 'tour_guide_booking');
$sql = mysqli_query($con, "select * from users");
$row = mysqli_fetch_assoc($sql);
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
    <link rel="stylesheet" href="css/choose-tourguide.css">

    <title>Everything La Trinidad</title>
</head>

<body>

   
    <!-- header section starts  -->

    <header class="header">

        <a href="index.html" class="logo"> <i class="ri-map-pin-fill"></i> Everything La Trinidad </a>

        <nav class="navbar">
            <a href="index.html">Home</a>
            <a href="index.html#about">About</a>
            <a href="choose-tourguide.php">Booking</a>
            <a href="services.html">Services</a>
            <a href="news.html">News</a>
            <a href="maps.html">Maps</a>
            <a href="logout.php" class="btn-warning">Logout</a>
        </nav>

        <div class="icons">
            <div id="search-btn" class="ri-search-line"></div>
            <div id="login-btn" class="ri-user-line"></div>
            <script>
                document.querySelector('#login-btn').onclick = () => {
                    window.location.href = 'profile.php';
                }
            </script>
            <div id="notif-btn" class="ri-notification-2-line"></i>
        </div>

    </header>

    <!-- header section ends  -->


    <!-- search-form start -->

    <section class="search-form-container">

        <form action="">
            <input type="search" placeholder="search here..." id="search-box">
            <label for="search-box" class="ri-search-line"></label>
        </form>

    </section>

    <!-- tour guide booking section starts -->
    <section class="booking" id="booking">
    <div class="tourguide-booking-container">
        <div class="booking-container">
            <h3 class="title">Tour Guide Booking Packages</h3>
            <div class="tourguide-container">

                <div class="box" alt="Image Button">
                    <img src="image/icon-male.png">
                    <div class="content">
                        <h3>Tour Guide Package 1</h3>
                        <br>
                        <span> Full Name : </span>
                        <span class="info"> Jay Cruz</span>
                        <br>
                        <span> Email : </span>
                        <span class="info"> jay1@gmail.com</span>
                        <br>
                        <span> Phone Number : </span>
                        <span class="info"> 09101550506</span>
                    </div>
                    <button class="card-btn1"><a href="sign-up-booking.php">Book Now</a></button>
                </div>

                <div class="box" alt="Image Button">
                    <img src="image/icon-female.png">
                    <div class="content">
                        <h3>Tour Guide Package 2</h3>
                        <br>
                        <span> Full Name : </span>
                        <span class="info"> Mae Yu</span>
                        <br>
                        <span> Email : </span>
                        <span class="info"> mae2@gmail.com</span>
                        <br>
                        <span> Phone Number : </span>
                        <span class="info"> 09102550506</span>
                    </div>
                    <button class="card-btn1"><a href="sign-up-booking.php">Book Now</a></button>
                </div>
            </div>
        </div>
    
    <!-- tour guide booking section ends -->

</body>
</html>