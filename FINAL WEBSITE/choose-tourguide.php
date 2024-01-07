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

        <a href="index.html" class="logo"> <i class="ri-store-2-line"></i> Everything La Trinidad </a>

        <nav class="navbar">
            <a href="index.html">home</a>
            <a href="index.html#about">about</a>
            <a href="choose-tourguide.html">booking</a>
            <a href="services.html">services</a>
            <a href="news.html">news</a>
            <a href="logout.php" class="btn-warning">Logout</a>
        </nav>

        <div class="icons">
            <div id="menu-btn" class="ri-menu-line"></div>
            <div id="search-btn" class="ri-search-line"></div>
            <div id="cart-btn" class="ri-contacts-book-2-fill"></div>
            <div id="login-btn" class="ri-user-line"></div>
            <div id="notif-btn" class="ri-notification-2-line"></i>
        </div>

    </header>
    <!-- header section ends -->


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
    </div>

    <?php
    if (isset($_GET['id']) && isset($_GET['status'])) {
        $id = $_GET['id'];
        $status = $_GET['status'];
        mysqli_query($con, "update choose-tourguide set status='$status' where id='$id'");
        header("location: adminpagetest.php");
        die();
    ?>

        <br>
        <br>
        <br>
        <form action="adminpagetest.php">
        <p><b><h3>Booking Status:</h3></b><?php  
                   if ($row['status']==1) {  
                        echo "Pending Request";  
                   }if ($row['status']==2) {  
                        echo "Acccepted";  
                   }if ($row['status']==3) {  
                        echo "Denied";  
                   }  
                   ?></p>
        </form>

        ?>
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
        }
        ?>
    </tbody>
</table>
</div>
</form>
    </section>
<script type="text/javascript">  
function status_update(value,id){  
   //alert(id);  
   let url = "http://localhost/CapstoneProject/FINAL%20WEBSITE/adminpagetest.php";  
   window.location.replace= url+"?id="+id+"&status="+value;  
}  
</script>

    

    <!-- tour guide booking section ends -->

</body>
</html>