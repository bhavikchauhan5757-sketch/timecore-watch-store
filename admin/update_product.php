<?php
session_start();
include('inc/conn.php');

// Allow only admin
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = intval($_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = floatval($_POST['price']);
    $stock = intval($_POST['stock']);

    $sql = "UPDATE products 
            SET name='$name', price=$price, stock=$stock 
            WHERE id=$id";
    mysqli_query($conn, $sql);

    header("Location: product_list.php");
    exit;
}
?>
