<?php
include('inc/conn.php'); // your database connection

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Get current status
    $query = "SELECT status FROM sliders WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $newStatus = ($row['status'] == 1) ? 0 : 1; // toggle status

        // Update new status
        $update = "UPDATE sliders SET status = $newStatus WHERE id = $id";
        if (mysqli_query($conn, $update)) {
            header("Location: slider_list.php"); // redirect back to list
            exit();
        } else {
            echo "Error updating status: " . mysqli_error($conn);
        }
    } else {
        echo "Invalid slider ID.";
    }
} else {
    echo "No slider ID provided.";
}
?>
