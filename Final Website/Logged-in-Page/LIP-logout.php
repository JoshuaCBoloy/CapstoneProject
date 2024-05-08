<?php
session_start();
session_destroy();
header("Location: LIP-login.php");
?>