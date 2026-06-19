<?php
include('inc/conn.php');

// Check if ID is provided
if(!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<script>alert('Invalid Brand ID'); window.location='brand_list.php';</script>";
    exit;
}

$brand_id = intval($_GET['id']);

// Fetch current status
$query = mysqli_query($conn, "SELECT status FROM brands WHERE b_id = $brand_id");
if(mysqli_num_rows($query) == 0) {
    echo "<script>alert('Brand not found'); window.location='brand_list.php';</script>";
    exit;
}

$row = mysqli_fetch_assoc($query);
$current_status = $row['status'];

// Toggle status
$new_status = $current_status == 1 ? 0 : 1;

$update = mysqli_query($conn, "UPDATE brands SET status = $new_status WHERE b_id = $brand_id");

if($update) {
    $msg = $new_status == 1 ? "Brand Activated" : "Brand Deactivated";
    echo "<script>alert('$msg'); window.location='brand_list.php';</script>";
} else {
    echo "<script>alert('Error updating status'); window.location='brand_list.php';</script>";
}
?>
