<?php
require 'db_connection.php';
session_start();

$response = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
		isset($_POST['studName']) &&
        isset($_POST['courseCode']) &&
        isset($_POST['subjectCode']) &&
        isset($_POST['subjectName']) &&
        isset($_POST['creditHour']) &&
        isset($_POST['sem'])
    ) {
		$studName = $_POST['studName'];
        $courseCode = $_POST['courseCode'];
        $subjectCode = $_POST['subjectCode'];
        $subjectName = $_POST['subjectName'];
        $creditHour = $_POST['creditHour'];
        $sem = $_POST['sem'];

        // Get the logged-in user's username
		$username = $_SESSION['username'];

		// Check if the subject already exists for the user
		$checkQuery = "SELECT * FROM register WHERE studName = '$studName' AND courseCode = '$courseCode' AND subjectCode = '$subjectCode'";
		$checkResult = mysqli_query($conn, $checkQuery);

		if ($checkResult && mysqli_num_rows($checkResult) > 0) {
			echo "Subject $subjectCode already exists for this student.";
		} else {
			// Insert the subject into the "register" table with the logged-in user's studName
			$insertQuery = "INSERT INTO register (studName, courseCode, subjectCode, subjectName, creditHour, sem) VALUES ('$studName', '$courseCode', '$subjectCode', '$subjectName', '$creditHour', '$sem')";
			if (mysqli_query($conn, $insertQuery)) {
				echo "Subject $subjectName added successfully.";
			} else {
				echo "Error: " . mysqli_error($conn);
			}
		}
    }
}
?>
