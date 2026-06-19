<?php
// Include database connection
include('inc/conn.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Extract POST data into variables
    extract($_POST);

    // Sanitize data
    $name = trim($name ?? '');
    $email = trim($email ?? '');
    $subject = trim($subject ?? '');
    $message = trim($message ?? '');

    if (!empty($name) && !empty($email) && !empty($message)) {
        // Prepared statement to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $subject, $message);

        if ($stmt->execute()) {
            $success = "Your message has been sent successfully!";
        } else {
            $error = "Something went wrong. Please try again!";
        }

        $stmt->close();
    } else {
        $error = "Please fill in all required fields.";
    }

    // Redirect back to contact page with messages
    header("Location: contact.php?success=" . urlencode($success ?? '') . "&error=" . urlencode($error ?? ''));
    exit;
} else {
    header("Location: contact.php");
    exit;
}
?>
