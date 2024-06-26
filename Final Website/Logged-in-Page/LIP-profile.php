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
    echo "User ID not set in session.";
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = mysqli_query($con, "SELECT * FROM user WHERE id = $user_id");
if(mysqli_num_rows($sql) === 0) {
    echo "No data found for this user.";
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
    <link rel="stylesheet" href="css/profile.css">

    <title>Everything La Trinidad</title>
</head>

<body>

   
    <!-- header section starts  -->

    <header class="header">
      <a href="#" class="logo"
        ><i class="ri-map-pin-fill"></i><span>Everything La Trinidad</span></a
      >

      <ul class="navbar">
        <li><a href="LIP-index.html" class="active">Home</a></li>
        <li><a href="LIP-index.html#about">About</a></li>
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
          href="https://www.google.com/maps/place/La+Trinidad,+Benguet/@16.4787946,120.5665467,12300m/data=!3m1!1e3!4m6!3m5!1s0x3391a3aef768cde3:0x58d076983f455a79!8m2!3d16.4774284!4d120.5854674!16zL20vMDZtZnI3?entry=ttu"
          class="map"
          ><span><i class="ri-map-pin-line"></i></span><span>Map</span></a
        >
        <div class="bx bx-menu" id="menu-icon"></div>
      </div>
    </header>

    <!-- header section ends  -->

        <!-- about section starts  -->
        <br>
        <br>
        <br>

        <section class="about" id="about">      
            <div class="content">
                <div class="cafe" id="cafe">
                    <div class="heading">
                        <h3>Booking Status</h3>
                    </div>
                </div>
            <div>
            <table class="table">
            <thead>
            <tr>
                <th><h2>First Name</h2></th>
                <th><h2>Last Name</h2></th>
                <th><h2>Email</h2></th>
                <th><h2>Phone Number</h2></th>
                <th><h2>Number of People</h2></th>
                <th><h2>Starting Date</h2></th>
                <th><h2>End Date</h2></th>
                <th><h2>Additional Information</h2></th>
                <th><h2>Chosen Package</h2></th>
                <th><h2>Booking Status</h2></th>
                <th><h2>Tourguide Status</h2></th>
            </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($sql)>0) {
                    while ($row=mysqli_fetch_assoc($sql)) { ?> 
                <tr>
                    <td><h3><?php echo $row['first_name'];?></h3></td>
                    <td><h3><?php echo $row['last_name'];?></h3></td>
                    <td><h3><?php echo $row['email'];?></h3></td>
                    <td><h3><?php echo $row['phone_number'];?></h3></td>
                    <td><h3><?php echo $row['number_people'];?></h3></td>
                    <td><h3><?php echo $row['start_date'];?></h3></td>
                    <td><h3><?php echo $row['end_date'];?><h3></td>
                    <td><h3><?php echo $row['any'];?><h3></td>
                    <td><h3><?php echo $row['package'];?></h3></td>
                    <td><h3><?php 
                    if ($row['status']==1) {
                        echo "Pending";
                    } if ($row['status']==2) {
                        echo "Accepted";
                    } if ($row['status']==3) {
                        echo "Declined";
                    }?><h3></td>
                    <td><h3><?php 
                    if ($row['tourguide_status']==1) {
                        echo "Pending";
                    } if ($row['tourguide_status']==2) {
                        echo "Tourguide 1";
                    } if ($row['tourguide_status']==3) {
                        echo "Tourguide 2";
                    }?><h3></td>
                </tr>
                <?php }
                }
                ?>
            </tbody>
        </table>
    </div>
    </div>
    </section>
    
    <script type="text/javascript">  
        function updateBookingStatus(value, id) {
            let url = "adminpagetest.php?id=" + id + "&status=" + value;
            window.location.href = url;
        }

        function updateTourGuideStatus(value, id) {
            let url = "adminpagetest.php?id=" + id + "&new_status=" + value;
            window.location.href = url;
        }
    </script>

</body>
</html>