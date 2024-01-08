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
            <h3 class="title">Tour Guide Booking</h3>
            <div class="tourguide-container">

                <div class="box" alt="Image Button">
                    <img src="image/icon-male.png">
                    <div class="content">
                        <h3>Tour Guide Package</h3>
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
                        <h3>Tour Guide Package</h3>
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

        <?php
            if (isset($_GET['id']) && isset($_GET['status'])) {
                $id = $_GET['id'];
                $status = $_GET['status'];
                mysqli_query($con, "update sign-up-booking1 set status='$status' where id='id'");
                header("location: choose-tourguide.php");
                die();
            }
            ?>

                <br>
                <br>
                <br>
            <table class="table">
                <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Number of People</th>
                    <th>Days of Tour</th>
                    <th>Additional Information</th>
                    <th>Booking Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $row['first_name'];?></td>
                    <td><?php echo $row['last_name'];?></td>
                    <td><?php echo $row['email'];?></td>
                    <td><?php echo $row['phone_number'];?></td>
                    <td><?php echo $row['number_people'];?></td>
                    <td><?php echo $row['tour_days'];?></td>
                    <td><?php echo $row['any'];?></td>
                    <td><?php 
                    if ($row['status']==1) {
                        echo "Pending";
                    } if ($row['status']==2) {
                        echo "Accepted";
                    } if ($row['status']==3) {
                        echo "Declined";
                    } ?> </td>
                </tr>

                <?php
                
                ?>
            </tbody>
    </div>
    </section>
    
    <script type="text/javascript">  
    function status_update(value,id){  
        //alert(id);  
        let url = "http://localhost:8081/CapstoneProject/FINAL%20WEBSITE/choose-tourguide.php";  
        window.location.replace= url+"?id="+id+"&status="+value;
        }
    </script>
    

    <!-- tour guide booking section ends -->

</body>
</html>