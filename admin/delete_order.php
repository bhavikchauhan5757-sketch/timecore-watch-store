<?php
session_start();
include('inc/conn.php');

// Check admin login
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

// Make sure order ID is provided
if (!isset($_GET['id'])) {
    header("Location: order_list.php");
    exit;
}

$order_id = intval($_GET['id']);

// Delete order items first
mysqli_query($conn, "DELETE FROM order_items WHERE order_id=$order_id");

// Delete the order
mysqli_query($conn, "DELETE FROM orders WHERE order_id=$order_id");

// Redirect back with success message
header("Location: orders.php?msg=deleted");
exit;
?>
