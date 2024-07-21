<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "la_trinidad_locations";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT name, latitude, longitude, type, description FROM la_trinidad_locations";
$result = $conn->query($sql);

$locations = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $locations[] = $row;
    }
} else {
    echo "0 results";
}
$conn->close();

echo json_encode($locations);
?>
