<?php
//connection variables
$dbhost = 'localhost';
$dbname = 'imslp';
$dbuser = 'root';
$dbpass = '';

//connection variable
($conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname)) or
    die(mysqli_connect_error());
?>
