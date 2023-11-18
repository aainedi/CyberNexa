<?php
// Include the database connection file
include 'db_connection.php';

// Start the session
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    $studName = $_POST['studName'];
    $nickname = $_POST['nickname'];
    $courseCode = $_POST['courseCode'];
    $courseName = $_POST['courseName'];
    $session = $_POST['session'];
    $gender = $_POST['gender'];
    $semester = $_POST['semester'];
    $years = $_POST['years'];
    $sem = $_POST['sem'];
    $admission = $_POST['admission'];

    // SQL query to check if ID number already exists
    $checkQuery = "SELECT username FROM users WHERE username = '$username'";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        // ID number already exists, set alert message in session
        $_SESSION['alert'] = "ID number already exists. Student information cannot added.";
    } else {
        // ID number does not exist, proceed to add the student
        $sql = "INSERT INTO users (username, password, studName, nickname, courseCode, courseName, session, gender, semester, years, sem, admission, title) 
                VALUES ('$username', '$password', '$studName', '$nickname', '$courseCode', '$courseName', '$session', '$gender', '$semester', '$years', '$sem', '$admission', 'STUDENT')";

        // Check if the query was successful
        if ($conn->query($sql) === TRUE) {
            $_SESSION['alert'] = "New student added successfully!";
        } else {
            $_SESSION['alert'] = "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Redirect back to the admin_profile.php page
    header("Location: admin_profile.php");
    exit();
}

// Close the database connection
$conn->close();
?>
