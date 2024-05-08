<?php
    $conn = new mysqli('localhost', 'root', '', 'tour_guide_booking');
    if ($conn->connect_error) {
        die ("Something wen wrong" .$conn->connect_error);
    }
?>