<?php 
session_start();
include_once "config.php";

// Check if POST data is set
if(isset($_POST['fname']) && isset($_POST['lname'])){
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);

    // Check if both fields are not empty
    if(!empty($fname) && !empty($lname)){
        // Query to select the user based on the first and last name
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE fname = '{$fname}' AND lname = '{$lname}'");
        if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
            $status = "Active now";
            $sql2 = mysqli_query($conn, "UPDATE users SET status = '{$status}' WHERE unique_id = {$row['unique_id']}");
            if($sql2){
                $_SESSION['unique_id'] = $row['unique_id'];
                echo "success";
            }else{
                echo "Something went wrong. Please try again!";
            }
        }else{
            echo "$fname $lname - This user does not exist!";
        }
    }else{
        echo "All input fields are required!";
    }
}else{
    echo "All input fields are required!";
}
?>
