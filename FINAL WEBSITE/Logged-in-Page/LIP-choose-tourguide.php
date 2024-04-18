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

        <a href="LIP-index.html" class="logo"> <i class="ri-map-pin-fill"></i> Everything La Trinidad </a>

        <nav class="navbar">
            <a href="LIP-index.html">home</a>
            <a href="LIP-index.html#about">about</a>
            <a href="./LIP-choose-tourguide.php">booking</a>
            <a href="LIP-services.html">services</a>
            <a href="LIP-news.html">news</a>
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
                        <h3>Package 1</h3>
                        <br>
                        <span> Tourist Spot 1: </span>
                        <span class="info"> <a href="./LIP-t2-strawberry-farm-touristspot.html">Strawberry Farm</a></span>
                        <br>
                        <span> Tourist Spot 2: </span>
                        <span class="info"> <a href="./LIP-t1-bell-church-touristspot.html"> Bell Church</a></span>
                        <br>
                        <span> Tourist Spot 3: </span>
                        <span class="info"> <a href="./LIP-t6-kalugong-touristspot.html">Mt. Kalugong</a"></a></span>
                        <br>
                        <span> Tourist Spot 4: </span>
                        <span class="info"> <a href="./LIP-t5-sunflower-farm-touristspot.html">Sunflower Farm</a></span>
                        <br>

                    </div>
                    <button class="card-btn1"><a href="LIP-sign-up-booking.php">Book Now</a></button>
                </div>

                <div class="box" alt="Image Button">
                    <img src="image/icon-female.png">
                    <div class="content">
                        <h3>Package 2</h3>
                        <br>
                        <span> Tourist Spot 1: </span>
                        <span class="info"> <a href="./LIP-t2-strawberry-farm-touristspot.html">Strawberry Farm</a></span>
                        <br>
                        <span> Tourist Spot 2: </span>
                        <span class="info"> Living Gifts Nursery</span>
                        <br>
                        <span> Tourist Spot 3: </span>
                        <span class="info"> <a href="./LIP-t1-bell-church-touristspot.html"> Bell Church</a></span>
                        <br>
                        <span> Tourist Spot 4: </span>
                        <span class="info"> <a href="./LIP-t6-kalugong-touristspot.html">Mt. Kalugong</a"></a></span>
                    </div>
                    <button class="card-btn1"><a href="LIP-sign-up-booking.php">Book Now</a></button>
                </div>
            </div>
        </div>
    
    <!-- tour guide booking section ends -->

</body>
</html>