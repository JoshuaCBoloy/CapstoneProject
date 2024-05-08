<?php
$con = mysqli_connect('localhost', 'root', '', 'tour_guide_booking');
$sql = mysqli_query($con, "select * from users");

if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = $_GET['id'];
    $status = $_GET['status'];
    mysqli_query($con, "update users set status='$status' where id='$id'");
    header("location: adminpagetest.php");
    die();
}  

if (isset($_GET['id']) && isset($_GET['new_status'])) {
    $id = $_GET['id'];
    $status = $_GET['new_status'];
    mysqli_query($con, "update users set new_status='$new_status' where id='$id'");
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

    <title>Admin Page - Tour Guide Bookings</title>
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
                <th>Days of Tour</th>
                <th>Starting Date</th>
                <th>End Date</th>
                <th>Additional Information</th>
                <th>Booking Status</th>
                <th>Response</th>
                <th>Tourguide Status</th>
                <th>Tourguide</th>
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
                    <td><?php echo $row['tour_days'];?></td>
                    <td><?php echo $row['start_date'];?></td>
                    <td><?php echo $row['end_date'];?></td>
                    <td><?php echo $row['any'];?></td>
                    <td><?php 
                    if ($row['status']==1) {
                        echo "Pending";
                    } if ($row['status']==2) {
                        echo "Accepted";
                    } if ($row['status']==3) {
                        echo "Declined";
                    }?>
                    <td>
                    <select onchange="status_update(this.options[this.selectedIndex].value,'<?php echo $row['id'] ?>')">    
                                <option value="1">Update Status</option>  
                                <option value="2">Accept</option>  
                                <option value="3">Decline</option>  
                           </select>
                    </td>
                    <td><?php 
                    if ($row['new_status']==1) {
                        echo "Pending";
                    } if ($row['new_status']==2) {
                        echo "Tourguide 1";
                    } if ($row['new_status']==3) {
                        echo "Tourguide 2";
                    }?>
                    <td>
                    <select onchange="status_update(this.options[this.selectedIndex].value,'<?php echo $row['id'] ?>')">    
                                <option value="1">Update Status</option>  
                                <option value="2">Tourguide 1</option>  
                                <option value="3">Tourguide 2</option>  
                           </select>
                    </td>
                </tr>
                <?php }
                }
                ?>
        </table>
    </div>
    <script type="text/javascript">
        function status_update(value,id) {
            let url = "http://localhost:8081/CapstoneProject/FINAL%20WEBSITE/adminpagetest.php";
            window.location.href= url+"?id="+id+"&status="+value;
        }

        function status_update(value,id) {
            let url = "http://localhost:8081/CapstoneProject/FINAL%20WEBSITE/adminpagetest.php";
            window.location.href= url+"?id="+id+"&new_status="+value;
        }
        </script>

</body>
</html>
