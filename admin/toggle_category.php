<?php
session_start();
include('inc/conn.php');

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = intval($_GET['id']);
    $status_raw = trim($_GET['status']); // incoming value (e.g. "active" or "inactive" or "Active")

    // Normalize to exact DB enum values 'Active' / 'Inactive'
    if (strcasecmp($status_raw, 'active') === 0) {
        $new_status = 'Active';
    } else {
        $new_status = 'Inactive';
    }

    // Use prepared statement to be safe
    if ($stmt = $conn->prepare("UPDATE categories SET c_status = ? WHERE c_id = ?")) {
        $stmt->bind_param("si", $new_status, $id);
        $stmt->execute();
        $stmt->close();
    } else {
        // Log error for debugging (you can remove this in production)
        error_log("Prepare failed: " . $conn->error);
    }
}

header("Location: category_list.php");
exit;
?>
