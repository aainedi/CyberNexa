<?php
// Database connection details
$hostname = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "cybernexa";

// Create a database connection
$conn = new mysqli($hostname, $dbusername, $dbpassword, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
