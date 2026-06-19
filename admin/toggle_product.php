<?php
include('inc/conn.php');

if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = intval($_GET['id']);
    $status = ($_GET['status'] === 'Active') ? 'Active' : 'Inactive';

    $sql = "UPDATE products SET status='$status' WHERE id=$id";
    mysqli_query($conn, $sql);

    header("Location: product_list.php");
    exit;
}
?>
