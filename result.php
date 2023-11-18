<?php
require 'db_connection.php';

// Function to retrieve all student data with usernames
function getAllStudentsWithUsernames() {
    global $conn;
    
    // Assuming the relationship between the 'register' and 'users' tables is based on the studName column
    $sql = "SELECT r.*, u.username 
            FROM register r 
            JOIN users u ON r.studName = u.studName";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return array(); // Return an empty array if no students found
    }
}


// Function to update student information
function editStudent($studName, $username, $courseCode, $subjectCode, $subjectName, $creditHour, $sem, $grade, $status) {
    global $conn;

    // Assuming your primary key is "studName"
    $sql = "UPDATE register SET grade=?, status=? WHERE studName=? AND subjectCode=? AND subjectName=? AND creditHour=? AND sem=?";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("sssssss", $grade, $status, $studName, $subjectCode, $subjectName, $creditHour, $sem);

    return $stmt->execute();
}


?>