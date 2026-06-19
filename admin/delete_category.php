<?php
session_start();
include('inc/conn.php');

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    mysqli_query($conn, "DELETE FROM categories WHERE c_id=$id");
}

header("Location: category_list.php");
exit;
?>
