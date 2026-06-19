<?php
// Try to connect to the MySQL server
$conn = mysqli_connect("localhost", "root", "", "watch");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
