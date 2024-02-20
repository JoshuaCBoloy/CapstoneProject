<?php
$con = mysqli_connect('localhost', 'root', '', 'tour_guide_booking');
$sql = mysqli_query($con, "select * from users");

if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = $_GET['id'];
    $status = $_GET['status'];
    mysqli_query($con, "update users set status='$status' where id='$id'");
    header("location: LIP-adminpagetest.php");
    die();
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

        <a href="index.html" class="logo"> <i class="ri-map-pin-fill"></i> Everything La Trinidad </a>

        <nav class="navbar">
            <a href="LIP-index.html">Home</a>
            <a href="LIP-index.html#about">About</a>
            <a href="LIP-choose-tourguide.php">Booking</a>
            <a href="LIP-services.html">Services</a>
            <a href="LIP-news.html">News</a>
            <a href="LIP-maps.html">Maps</a>
            <a href="LIP-logout.php" class="btn-warning">Logout</a>
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

        <!-- about section starts  -->

        <section class="about" id="about">
            <div class="content">
            <div>
        <table class="table">
            <thead>
            <tr>
                <th><h2>First Name</h2></th>
                <th><h2>Last Name</h2></th>
                <th><h2>Email</h2></th>
                <th><h2>Phone Number</h2></th>
                <th><h2>Number of People</h2></th>
                <th><h2>Days of Tour</h2></th>
                <th><h2>Additional Information</h2></th>
                <th><h2>Booking Status</h2></th>
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
                    <td><h3><?php echo $row['tour_days'];?><h3></td>
                    <td><h3><?php echo $row['any'];?><h3></td>
                    <td><h3><?php 
                    if ($row['status']==1) {
                        echo "Pending";
                    } if ($row['status']==2) {
                        echo "Accepted";
                    } if ($row['status']==3) {
                        echo "Declined";
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
    function status_update(value,id){  
        //alert(id);  
        let url = "http://localhost:8081/CapstoneProject/FINAL%20WEBSITE/adminpagetest.php";  
        window.location.href= url+"?id="+id+"&status="+value;
        }
    </script>

</div>
</section>

<!-- about section ends -->

</body>
</html>