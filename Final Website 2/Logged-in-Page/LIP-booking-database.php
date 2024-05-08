<?php

$hostName = "localhost";
$dbName = "login_db";
$dbUser = "root";
$dbPassword = "";
$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
if (!$conn) {
    die("Something went wrong;");
}

?>