<?php
require 'db_connection.php';

// Check if the username is provided in the query string
if (isset($_GET['username'])) {
    $username = $_GET['username'];

    // Delete the student record from the database
    $sql = "DELETE FROM users WHERE username = '$username' AND title = 'STUDENT'";
    $result = $conn->query($sql);

    if ($result) {
        // Set a session alert for success
        session_start();
        $_SESSION['alert'] = 'Student record deleted successfully.';
    } else {
        // Set a session alert for failure
        session_start();
        $_SESSION['alert'] = 'Error deleting student record.';
    }

    // Redirect back to the admin profile page
    header("Location: admin_profile.php");
    exit();
} else {
    // If the username is not provided, redirect to the admin profile page
    header("Location: admin_profile.php");
    exit();
}
?>
