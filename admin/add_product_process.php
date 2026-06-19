<?php
session_start();
include('inc/conn.php');

// Redirect to login if admin session is not set
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

if (!empty($_POST)) {

    extract($_POST); // now you have $name, $short_description, $description, $price, $stock, $category_id, $b_id, $average_rating, $review_count, $status

    $error = array();

    // Validation
    if (empty($name)) 
    {
        $error[] = "Please enter product name";
    }

    if (empty($price)) 
    {
        $error[] = "Please enter product price";
    }

    if (empty($stock)) 
    {
        $error[] = "Please enter stock quantity";
    }
    
    if (empty($category_id)) 
    {
        $error[] = "Please select category";
    }

    if (empty($b_id)) 
    {
        $error[] = "Please select brand";
    }

    // File upload handling
    $main_image = "";
    if (!empty($_FILES['main_image']['name'])) {
        $targetDir = "uploads/products/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        $main_image = time() . "_" . basename($_FILES['main_image']['name']);
        move_uploaded_file($_FILES['main_image']['tmp_name'], $targetDir . $main_image);
    }

    $gallery_images = array();
    if (!empty($_FILES['gallery_images']['name'][0])) {
        $targetDir = "uploads/products/";
        foreach ($_FILES['gallery_images']['name'] as $key => $val) {
            $fileName = time() . "_" . basename($val);
            if (move_uploaded_file($_FILES['gallery_images']['tmp_name'][$key], $targetDir . $fileName)) {
                $gallery_images[] = $fileName;
            }
        }
    }
    $gallery_json = !empty($gallery_images) ? json_encode($gallery_images) : null;

    // If errors, show them
    if (!empty($error)) {
        foreach ($error as $er) {
            echo $er . "<br>";
        }
    } else {
        // Insert query
        $q = "INSERT INTO products 
              (name, short_description, description, price, stock, main_image, gallery_images, category_id, brand_id, average_rating, review_count, status) 
              VALUES 
              ('$name', '$short_description', '$description', '$price', '$stock', '$main_image', " . ($gallery_json ? "'$gallery_json'" : "NULL") . ", '$category_id', '$b_id', '$average_rating', '$review_count', '$status')";

        mysqli_query($conn, $q);

        $_SESSION['success']['product'] = "Product added successfully!";

        header("location:add_products.php");
    }
} else {
    header("location:add_products.php");
}
?>
