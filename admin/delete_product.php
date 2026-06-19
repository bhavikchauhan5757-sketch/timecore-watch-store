<?php
session_start();
include('inc/conn.php');

// Allow only admin
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Get product images before delete
    $sql = "SELECT main_image, gallery_images FROM products WHERE id = $id";
    $res = mysqli_query($conn, $sql);
    if ($res && $row = mysqli_fetch_assoc($res)) {
        // Delete main image
        if (!empty($row['main_image']) && file_exists("uploads/products/" . $row['main_image'])) {
            unlink("admin/uploads/products/" . $row['main_image']);
        }
        // Delete gallery images
        if (!empty($row['gallery_images'])) {
            $gallery = json_decode($row['gallery_images'], true);
            if (is_array($gallery)) {
                foreach ($gallery as $img) {
                    if (file_exists("admin/uploads/products/" . $img)) {
                        unlink("uploads/products/" . $img);
                    }
                }
            }
        }
    }

    // Delete product record
    mysqli_query($conn, "DELETE FROM products WHERE id = $id");
}

header("Location: product_list.php");
exit;
?>
