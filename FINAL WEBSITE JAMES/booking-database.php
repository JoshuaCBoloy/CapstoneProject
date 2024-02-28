<?php

$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "tour_guide_booking";
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
if (!$conn) {
    die("Something went wrong;");
}

?>