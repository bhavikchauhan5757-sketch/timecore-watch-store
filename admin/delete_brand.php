<?php
include('inc/conn.php');

// Check if id is provided
if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    $brand_id = intval($_GET['id']);

    // Optional: Check if brand exists before deleting
    $check = mysqli_query($conn, "SELECT * FROM brands WHERE b_id = $brand_id");
    if(mysqli_num_rows($check) > 0) {

        // Delete the brand
        $delete = mysqli_query($conn, "DELETE FROM brands WHERE b_id = $brand_id");

        if($delete) {
            echo "<script>alert('Brand deleted successfully');window.location='brand_list.php';</script>";
        } else {
            echo "<script>alert('Error: Could not delete brand');window.location='brand_list.php';</script>";
        }

    } else {
        echo "<script>alert('Brand not found');window.location='brand_list.php';</script>";
    }
} else {
    echo "<script>alert('Invalid brand ID');window.location='brand_list.php';</script>";
}
?>
