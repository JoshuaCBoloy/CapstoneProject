
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
    <link rel="stylesheet" href="css/sign-up-booking.css">

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
</nav>

<div class="icons">
    <div id="menu-btn" class="ri-menu-line"></div>
    <div id="search-btn" class="ri-search-line"></div>
    <div id="cart-btn" class="ri-shopping-cart-line"></div>
    <div id="login-btn" class="ri-user-line"></div>
</div>

<style>
    .header {
        text-decoration: none;
    }
    </style>

</header>
<!-- header section ends -->

<section class="sign-up" id="sign-up">
            <div class="heading">
                <span>Tour Guide Booking 1</span>
                <h3>Sign up</h3>
            </div>

            <?php
            if (isset($_POST["submit"])) {
                $firstName = $_POST["first_name"];
                $lastName = $_POST["last_name"];
                $email = $_POST["email"];
                $phoneNumber = $_POST["phone_number"];
                $numberPeople = $_POST["number_people"];
                $tourDays = $_POST["tour_days"];
                $any = $_POST["any"];

                $errors = array();

                if (empty($firstName) OR empty($lastName) OR empty($email) OR empty($phoneNumber) OR empty($numberPeople) OR empty($tourDays) OR empty($any)) {
                    array_push($errors, "All fields are required");
                }
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    array_push($errors, "Email is not valid");
                }
                if (!is_numeric($phoneNumber)) {
                    array_push($errors);
                }
                if (!is_numeric($numberPeople)) {
                    array_push($errors);
                }
                if (!is_numeric($tourDays)) {
                    array_push($errors);
                }

                if (count($errors)>0) {
                    foreach($errors as $error) {
                        echo "<div class='alert alert-danger'>$error</div>";
                    }
                }else {
                    require_once "booking-database.php";
                    $sql = "INSERT INTO users (first_name, last_name, email, phone_number, number_people, tour_days, any) VALUES ( ?, ?, ?, ?, ?, ?, ? )";
                    $stmt = mysqli_stmt_init($conn);
                    $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
                    if ($prepareStmt) {
                        mysqli_stmt_bind_param($stmt, "sssiiis", $firstName, $lastName, $email, $phoneNumber, $numberPeople, $tourDays, $any);
                        mysqli_stmt_execute($stmt);
                        echo "<div class='alert alert-success'>Your tour guide booking is sent successfully. Wait for any response.</div>";
                    }else {
                        die("Something went wrong");
                    }
                }

            }
            ?>


            <form action="sign-up-booking1.php" method="post">
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
                        <span>Email:</span>
                        <input type="email" class="form-control" name="email" placeholder="Your Email:">
                    </div>
                    <div class="inputBox">
                        <span>Phone Number:</span>
                        <input type="tel" class="form-control" name="phone_number" pattern="[0-9]{11}" placeholder="Your Number:">
                    </div>
                </div>

                <br>
    
                <div class="flex">
                    <div class="inputBox">
                        <span>How many people are in your group?</span>
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
            <?php
            if (isset($_GET['id']) && isset($_GET['status'])) {
                $id = $_GET['id'];
                $status = $_GET['status'];
                mysqli_query($con, "update sign-up-booking1 set status='$status' where id='id'");
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
           window.location.href= url+"?id="+id+"&status="+value;  
      }  
 </script>
        
</body>
</html>