<?php
require 'db_connection.php';

// Function to retrieve all student data
function getAllStudents() {
    global $conn;
    $sql = "SELECT * FROM users WHERE title = 'STUDENT'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return array(); // Return an empty array if no students found
    }
}

// Function to update student information
function editStudent($userId, $newData) {
    global $conn;
    $sql = "UPDATE users SET studName=?, nickname=?, courseCode=?, courseName=?, session=?, gender=?, semester=?, years=?, sem=?, admission=? WHERE username=?";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("sssssssssss", $newData['studName'], $newData['nickname'], $newData['courseCode'], $newData['courseName'], $newData['session'], $newData['gender'], $newData['semester'], $newData['years'], $newData['sem'], $newData['admission'], $userId);

    return $stmt->execute();
}

// Function to add a new student
function addStudent($userData) {
    global $conn;
    $sql = "INSERT INTO users (username, password, studName, nickname, courseCode, courseName, session, gender, semester, years, sem, admission, title) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("ssssssssssss", $userData['username'], $userData['password'], $userData['studName'], $userData['nickname'], $userData['courseCode'], $userData['courseName'], $userData['session'], $userData['gender'], $userData['semester'], $userData['years'], $userData['sem'], $userData['admission'], 'STUDENT');

    return $stmt->execute();
}
?>
