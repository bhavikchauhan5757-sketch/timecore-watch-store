<?php
include('inc/conn.php');

if(isset($_GET['id'])){
    $id = intval($_GET['id']);

    // Get the slider image path
    $res = mysqli_query($conn, "SELECT image FROM sliders WHERE id=$id");
    if($res && mysqli_num_rows($res) > 0){
        $row = mysqli_fetch_assoc($res);
        if(file_exists($row['image'])){
            unlink($row['image']); // Delete the image file
        }
    }

    // Delete the slider record from database
    $delete = "DELETE FROM sliders WHERE id=$id";
    if(mysqli_query($conn, $delete)){
        header("Location: slider_list.php"); // Redirect back to slider list
        exit;
    } else {
        echo "<script>alert('Error deleting slider!');window.location='slider_list.php';</script>";
    }
} else {
    header("Location: slider_list.php");
    exit;
}
?>
