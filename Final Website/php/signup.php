<?php
    session_start();
    include_once "config.php";
    
    // Get first name and last name from POST data
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    
    if(!empty($fname) && !empty($lname)){
        // Check if the first and last name together already exist
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE fname = '{$fname}' AND lname = '{$lname}'");
        if(mysqli_num_rows($sql) > 0){
            echo "{$fname} {$lname} - This name combination already exists!";
        }else{
            if(isset($_FILES['image'])){
                $img_name = $_FILES['image']['name'];
                $img_type = $_FILES['image']['type'];
                $tmp_name = $_FILES['image']['tmp_name'];
                
                $img_explode = explode('.',$img_name);
                $img_ext = end($img_explode);

                $extensions = ["jpeg", "png", "jpg"];
                if(in_array($img_ext, $extensions) === true){
                    $types = ["image/jpeg", "image/jpg", "image/png"];
                    if(in_array($img_type, $types) === true){
                        $time = time();
                        $new_img_name = $time.$img_name;
                        if(move_uploaded_file($tmp_name,"images/".$new_img_name)){
                            $ran_id = rand(time(), 100000000);
                            $status = "Active now";
                            // Insert fname and lname separately
                            $insert_query = mysqli_query($conn, "INSERT INTO users (unique_id, fname, lname, img, status)
                            VALUES ({$ran_id}, '{$fname}', '{$lname}', '{$new_img_name}', '{$status}')");
                            if($insert_query){
                                $select_sql2 = mysqli_query($conn, "SELECT * FROM users WHERE fname = '{$fname}' AND lname = '{$lname}'");
                                if(mysqli_num_rows($select_sql2) > 0){
                                    $result = mysqli_fetch_assoc($select_sql2);
                                    $_SESSION['unique_id'] = $result['unique_id'];
                                    echo "success";
                                }else{
                                    echo "This name combination does not exist!";
                                }
                            }else{
                                echo "Something went wrong. Please try again!";
                            }
                        }
                    }else{
                        echo "Please upload an image file - jpeg, png, jpg";
                    }
                }else{
                    echo "Please upload an image file - jpeg, png, jpg";
                }
            }
        }
    }else{
        echo "All input fields are required!";
    }
?>
