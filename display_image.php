<?php
// Required
require 'db_connection.php';

// Start session
session_start();

// Check if the user is logged in, if not, redirect to the login page
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Fetch user's information from the database
$username = mysqli_real_escape_string($conn, $_SESSION['username']);
$query = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

if (!$query) {
    die("Database query failed: " . mysqli_error($conn));
}

$row = mysqli_fetch_assoc($query);

if (!$row) {
    die("User not found.");
}

// Set the appropriate content type header
header("Content-type: image/png");

// Output the image data from the database
if (empty($row['profile'])) {
    // Output a default image if the user doesn't have a profile image
    readfile('path/to/default-image.png');
} else {
    echo $row['profile'];
}
?>
