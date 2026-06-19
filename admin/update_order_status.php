<?php
include('inc/conn.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_id = intval($_POST['order_id']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    $allowed_status = ['pending','confirmed','processed','completed'];

    if (in_array(strtolower($status), $allowed_status)) {
        $update_sql = "UPDATE orders SET status='$status' WHERE order_id=$order_id";
        if (mysqli_query($conn, $update_sql)) {
            echo "<script>alert('Order status updated successfully'); window.location='orders.php';</script>";
        } else {
            echo "<script>alert('Error: Could not update status'); window.location='orders.php';</script>";
        }
    } else {
        echo "<script>alert('Invalid status selected'); window.location='orders.php';</script>";
    }
} else {
    header("Location: orders.php");
    exit;
}
?>
