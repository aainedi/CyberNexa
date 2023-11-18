<?php
require 'db_connection.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

    // Update student information in the database
    $updateQuery = "UPDATE users 
                    SET password = '$password', 
                        studName = '$studName', 
                        nickname = '$nickname', 
                        courseCode = '$courseCode', 
                        courseName = '$courseName', 
                        session = '$session', 
                        gender = '$gender', 
                        semester = '$semester', 
                        years = '$years', 
                        sem = '$sem', 
                        admission = '$admission' 
                    WHERE username = '$username'";

    if (mysqli_query($conn, $updateQuery)) {
        // Set a success message in the session
        session_start();
        $_SESSION['alert'] = "Student information updated successfully!";
    } else {
        // Set an error message in the session
        session_start();
        $_SESSION['alert'] = "Error updating student information: " . mysqli_error($conn);
    }

    // Redirect back to the update_student.php page
    header("Location: update_student.php?username=$username");
    exit();
} else {
    // If the form is not submitted, redirect to some page
    header("Location: admin_profile.php");
    exit();
}
?>
