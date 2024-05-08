<?php
$con = mysqli_connect('localhost', 'root', '', 'login_db');
$sql = mysqli_query($con, "select * from user");

if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = $_GET['id'];
    $status = $_GET['status'];
    mysqli_query($con, "update user set status='$status' where id='$id'");
    header("location: adminpagetest.php");
    die();
}

if (isset($_GET['id']) && isset($_GET['new_status'])) {
    $id = $_GET['id'];
    $new_status = $_GET['new_status'];
    $tourguide_status = ($new_status == 2) ? 2 : 3;
    mysqli_query($con, "update user set new_status='$new_status', tourguide_status='$tourguide_status' where id='$id'");
    header("location: adminpagetest.php");
    die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Add your CSS and other head elements here -->
    <link rel="stylesheet" href="css/admin.css">

    <title>Tourguide Page - Tour Guide Bookings</title>
</head>

<body>
    <h2>Tour Guide Booking Details</h2>
    <div>
        <table class="table">
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Number of People</th>
                <th>Starting Date</th>
                <th>Ending Date</th>
                <th>Additional Information</th>
                <th>Chosen Package</th>
                <th>Booking Status</th>
                <th>Tourguide Status</th>
            </tr>
            <?php
            if (mysqli_num_rows($sql)>0) {
                while ($row=mysqli_fetch_assoc($sql)) { ?>
                <tr>
                    <td><?php echo $row['first_name'];?></td>
                    <td><?php echo $row['last_name'];?></td>
                    <td><?php echo $row['email'];?></td>
                    <td><?php echo $row['phone_number'];?></td>
                    <td><?php echo $row['number_people'];?></td>
                    <td><?php echo $row['start_date'];?></td>
                    <td><?php echo $row['end_date'];?></td>
                    <td><?php echo $row['any'];?></td>
                    <td><?php echo $row['package'];?></td>
                    <td><?php 
                    if ($row['status']==1) {
                        echo "Pending";
                    } if ($row['status']==2) {
                        echo "Accepted";
                    } if ($row['status']==3) {
                        echo "Declined";
                    }?>
                    <td><?php 
                    if ($row['tourguide_status']==1) {
                        echo "Pending";
                    } if ($row['tourguide_status']==2) {
                        echo "Tourguide 1";
                    } if ($row['tourguide_status']==3) {
                        echo "Tourguide 2";
                    }?>
                </tr>
                <?php }
                }
                ?>
        </table>
    </div>
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