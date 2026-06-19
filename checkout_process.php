<?php
session_start();
include('inc/conn.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['place_order'])) {
    $user_id = intval($_POST['user_id']);
    $name    = mysqli_real_escape_string($conn, $_POST['name']);
    $email   = mysqli_real_escape_string($conn, $_POST['email']);
    $mobile  = mysqli_real_escape_string($conn, $_POST['mobile']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $city    = mysqli_real_escape_string($conn, $_POST['city']);
    $pin     = mysqli_real_escape_string($conn, $_POST['pin']);

    // Fetch cart items
    $cart_items = [];
    $subtotal = 0;

    $sql = "SELECT c.id AS cart_id, p.id AS product_id, p.name, p.price, c.quantity
            FROM cart c
            JOIN products p ON c.product_id = p.id
            WHERE c.user_id = $user_id";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        while ($row = mysqli_fetch_assoc($res)) {
            $cart_items[] = $row;
            $subtotal += $row['price'] * $row['quantity'];
        }
    }

    if (empty($cart_items)) {
        $_SESSION['message'] = "<div class='alert alert-danger text-center'>⚠️ Your cart is empty!</div>";
        header("Location: checkout.php");
        exit;
    }

    $shipping = 50;
    $total = $subtotal + $shipping;

    // Insert order
    mysqli_query($conn, "INSERT INTO orders (user_id, name, email, mobile, address, city, pin, subtotal, shipping, total, status)
                         VALUES ($user_id, '$name', '$email', '$mobile', '$address', '$city', '$pin', $subtotal, $shipping, $total, 'pending')");
    $order_id = mysqli_insert_id($conn);

    // Insert order items
    foreach ($cart_items as $item) {
        mysqli_query($conn, "INSERT INTO order_items (order_id, product_id, product_name, price, quantity)
                             VALUES ($order_id, {$item['product_id']}, '{$item['name']}', {$item['price']}, {$item['quantity']})");
    }

    // Clear cart
    mysqli_query($conn, "DELETE FROM cart WHERE user_id=$user_id");

    // Set same SweetAlert success message
    $_SESSION['message'] = "<div class='alert alert-success text-center'>🎉 Order placed successfully! Your Order ID: <strong>$order_id</strong></div>";

    // Redirect back to same checkout page
    header("Location: checkout.php");
    exit;
} else {
    header("Location: checkout.php");
    exit;
}
