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
    <!-- Add your CSS and other head elements here -->
    <link rel="stylesheet" href="css/admin.css">

    <title>Admin Page - Tour Guide Bookings</title>
</head>

<body>
    <h2>Tour Guide Booking Details</h2>
    <div>
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
                <th>Responose</th>
            </tr>
            </thead>
            <tbody>
                <?php
                require_once "conn.php";
                $sql = "SELECT * FROM users";
                $query = $con->query($sql);
                while($row = $query->fetch_assoc()){

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
                        echo "Accept";
                    } if ($row['status']==3) {
                        echo "Decline";
                    }?>
                    <td>
                        <?php
                        if ($row['status']==1) {
                            echo "Pending";
                        } if ($row['status']==2) {
                            echo "Accept";
                        } if ($row['status']==3) {
                            echo "Decline";
                        }
                        ?>
                    </td>
                    <td>
                    <select onchange="status_update(this.options[this.selectedIndex].value,'<?php echo $row['id'] ?>')">  
                                <option value="">Update Status</option>  
                                <option value="1">Pending</option>  
                                <option value="2">Accept</option>  
                                <option value="3">Reject</option>  
                           </select>
                </td>
                </tr>

                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <script type="text/javascript">
        function status_update(value,id) {
            let url = "http://localhost/adminpagetest.php";
            window.location.replace= url+"id="+id+"&status="+value;
        }
        </script>

</body>
</html>