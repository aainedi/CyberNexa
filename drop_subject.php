<?php
// drop_subject.php

// Include your database connection script
require 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $studName = $_POST['studName'];  // Assuming you're passing the student's name
    $subjectCode = $_POST['subjectCode'];

    // Check if the subject is registered for the student
    $checkQuery = "SELECT * FROM register WHERE studName = '$studName' AND subjectCode = '$subjectCode'";
    $checkResult = mysqli_query($conn, $checkQuery);

    if ($checkResult && mysqli_num_rows($checkResult) > 0) {
        // Subject is registered, proceed to drop
        $dropQuery = "DELETE FROM register WHERE studName = '$studName' AND subjectCode = '$subjectCode'";
        $dropResult = mysqli_query($conn, $dropQuery);

        if ($dropResult) {
            echo 'Subject dropped successfully.';
        } else {
            echo 'An error occurred while dropping the subject.';
        }
    } else {
        // Subject not registered for the student
        echo 'subject_not_registered';
    }
}
?>
