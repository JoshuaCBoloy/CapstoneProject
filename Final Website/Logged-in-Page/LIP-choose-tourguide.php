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


    <link
      rel="stylesheet"
      href="https://unpkg.com/boxicons@latest/css/boxicons.min.css"
    />
    <!-- remix icon cdn link  -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/choose-tourguide.css">

    <title>Everything La Trinidad</title>
</head>

<body>

   
    <!-- header section starts  -->

    <header class="header">
      <a href="./LIP-index.php" class="logo"
        ><i class="ri-map-pin-fill"></i><span>Everything La Trinidad</span></a
      >

      <ul class="navbar">
        <li><a href="LIP-index.php" class="active">Home</a></li>
        <li><a href="LIP-index.php#about">About</a></li>
        <li><a href="LIP-choose-tourguide.php">Booking</a></li>
        <li><a href="LIP-services.html">Services</a></li>
        <li><a href="LIP-news.html">News</a></li>
        <li>
          <a href="LIP-login.php" class="btn-warning">Logout</a>
        </li>
      </ul>

      <div class="icons">
        <a href="../chatapplogin.php" class="chat"
          ><span><i class="ri-chat-3-line" aria-hidden="true"></i></span
          ><span>Chat</span></a
        >
        <a href="LIP-profile.php" class="login"
          ><span><i class="ri-user-line"></i></span><span>Profile</span></a
        >
        <a
          href="LIP-maps.html"
          class="map"
          ><span><i class="ri-map-pin-line"></i></span><span>Map</span></a
        >
        <div class="bx bx-menu" id="menu-icon"></div>
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
                    <button class="card-btn1"><a href="LIP-sign-up-booking-p1.php">Book Now</a></button>
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
                        <span class="info"> <a href="./LIP-t6-kalugong-touristspot.html">Mt. Kalugong</a"></a></span>
                        <br>
                        <span hidden> Tourist Spot 3: </span>
                        <span class="info" hidden> Living Gifts Nursery</span>
                        <br>
                        <span hidden> Tourist Spot 4: </span>
                        <span class="info"> <a href="./LIP-t1-bell-church-touristspot.html" hidden> Bell Church</a></span>
                        <br>
                    </div>
                    <button class="card-btn1"><a href="LIP-sign-up-booking-p2.php">Book Now</a></button>
                </div>
            </div>
        </div>
    
    <!-- tour guide booking section ends -->
    <script src="js/script.js"></script>
</body>
</html>