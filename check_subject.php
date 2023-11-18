<?php
// check_subject_status.php

// Include your database connection script
require 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $studName = $_POST['studName'];

    // Retrieve subject status from the database based on the user
    $statusQuery = "SELECT subjectCode, isRegistered FROM subjects_status WHERE studName = '$studName'";
    $statusResult = mysqli_query($conn, $statusQuery);

    $subjectStatus = array();

    if ($statusResult && mysqli_num_rows($statusResult) > 0) {
        while ($row = mysqli_fetch_assoc($statusResult)) {
            $subjectStatus[] = array(
                'subjectCode' => $row['subjectCode'],
                'isRegistered' => $row['isRegistered'],
            );
        }
    }

    // Return subject status as JSON
    echo json_encode($subjectStatus);
}
?>
