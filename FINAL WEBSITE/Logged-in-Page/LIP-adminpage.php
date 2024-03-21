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
                <th>Date of Tour</th>
                <th>Additional Information</th>
                <th>Response</th>
            </tr>
            </thead>
            <tbody>
                <?php
                require_once "LIP-conn.php";
                $sql = "SELECT * FROM users";
                $query = $conn->query($sql);
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
                    <td>
                        <a href="#" class="accept">Accept</a>
                        <a href="#" class="decline">Decline</a>
                </td>
                </tr>

                <?php
                }
                ?>
            </tbody>
        </table>
    </div>

</body>
</html>