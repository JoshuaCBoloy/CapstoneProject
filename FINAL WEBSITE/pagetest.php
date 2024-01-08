<?php
$con=mysqli_connect('localhost', 'root', '', 'pagetest');
$sql=mysqli_query($con, "select * from users");
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
                <th>No.</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Booking Status</th>
                <th>Response</th>
            </tr>
                <?php
                $i=1;
                if (mysqli_num_rows($sql)>0) {
                    while ($row=mysqli_fetch_assoc($sql)) { ?>
                    <tr>
                        <td><?php echo $i++ ?></td>
                        <td><?php echo $row['first_name']?></td>
                        <td><?php echo $row['last_name']?></td>
                        <td><?php 
                        if ($row['status']==1) {
                            echo "Pending";
                        } if ($row['status']==2) {
                            echo "Accept";
                        } if ($row['status']==3) {
                            echo "Decline";
                        } ?>
                        </td>
                        <td>
                            <select onchange="status_update(this.options[this.selectedIndex].value)">
                                <option value="1">Pending</option>
                                <option value="1">Accept</option>
                                <option value="1">Decline</option>
                        </td>
                    </tr>
                <?php }
                }
                ?>
        </table>
    </div>

    <script type="text/javascript">
        function status_update(value){
            alert(value);
        }

    </script>

</body>
</html>