<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Subject Registration</title>
</head>
<style>
    body {
        align-content: center;
        background-repeat: no-repeat;
        background-size: 100%;
		background-color:#ADB1FF;
        color: black;
        margin-left: 80px;
    }

    table {
        margin-left: 40px;
        margin-top: 100px;
        margin-bottom: 60px;
        color: black;
        background-color: mediumpurple;
        border: 5px solid #FFFFFF;
        border-collapse: collapse;
    }

    button {
        opacity: 1.0;
        padding: 10px 20px;
        background-color: white;
    }

    button:hover {
        opacity: 0.8;
    }

    .footer {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        background-color: lavender;
        color: black;
        text-align: center;
        font-family: Segoe UI;
        font-size: 70%;
        line-height: 3px;
	}

	.circle-button {
			position: absolute;
			left: 20px; /* Adjust the left position as needed */
			top: 50%;
			transform: translateY(-50%);
			width: 50px; /* Adjust the button size */
			height: 50px; /* Adjust the button size */
			background-color: rebeccapurple;
			color: white;
			border-radius: 50%; /* Makes it circular */
			display: flex;
			justify-content: center;
			align-items: center;
			cursor: pointer;
			opacity: 0.5;
		}

	.circle-button i {
		font-size: 20px; /* Adjust the arrow icon size */
	}
		
	.circle-button:hover {
		opacity: 1.0;
	}
    
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<body style="background-image: url('background.png');">

<?php
require 'db_connection.php';
session_start();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $query = "SELECT studName, password, username, courseName, gender, semester FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $studName = $row['studName'];
        $icNumber = $row['password'];
        $idNumber = $row['username'];
        $courseName = $row['courseName'];
        $gender = $row['gender'];
        $semester = $row['semester'];
    }
} else {
    header("Location: login.php");
    exit;
}

echo '<p>&nbsp;</p>
<p>&nbsp;</p>
<div class="table_one">
    <table width="428" border="1">
        <tbody>
            <tr>
                <td colspan="2" bgcolor="#AB00C9"><strong>GRANT SUBJECT FOR STUDENT BELOW</strong></td>
            </tr>
            <tr>
                <td width="132"><strong>NAME</strong></td>
                <td width="280">' . $studName . '</td>
            </tr>
            <tr>
                <td><strong>IC NUMBER</strong></td>
                <td>' . $icNumber . '</td>
            </tr>
            <tr>
                <td><strong>ID NUMBER</strong></td>
                <td>' . $username . '</td>
            </tr>
            <tr>
                <td><strong>GENDER</strong></td>
                <td>' . $gender . '</td>
            </tr>
            <tr>
                <td><strong>COURSE NAME</strong></td>
                <td>' . $courseName . '</td>
            </tr>
            <tr>
                <td><strong>SEMESTER</strong></td>
                <td>' . $semester . '</td>
            </tr>
        </tbody>
    </table>
</div>';

// Display subjects registered by the user
echo '<p style="margin: 0; padding: 0;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;List of subjects that you have been registered for this semester:</p>';

// Fetch and display subject data from register for the specific user
$subjectsQuery = "SELECT * FROM register WHERE studName = '$studName'";
$subjectsResult = $conn->query($subjectsQuery);

if ($subjectsResult->num_rows > 0) {
    echo '<table width="82%" border="1" style="width: 80%; margin-top: 8px; margin-bottom: 15px;">
            <thead>
                <tr>
                    <th bgcolor="#AB00C9">Course Code</th>
                    <th bgcolor="#AB00C9">Subject Code</th>
                    <th bgcolor="#AB00C9">Subject Name</th>
                    <th bgcolor="#AB00C9">Credit Hour</th>
                    <th bgcolor="#AB00C9">Semester</th>
                </tr>
            </thead>
            <tbody>';
	
    while ($subjectRow = $subjectsResult->fetch_assoc()) {
        echo '<tr>
                <td>' . $subjectRow['courseCode'] . '</td>
                <td>' . $subjectRow['subjectCode'] . '</td>
                <td>' . $subjectRow['subjectName'] . '</td>
                <td style="text-align: center">' . $subjectRow['creditHour'] . '</td>
                <td style="text-align: center">' . $subjectRow['sem'] . '</td>
            </tr>';
    }

    echo '</tbody>
    </table>';
} else {
    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>No subjects being registered.</strong>";
}

// Close connection
$conn->close();
?>

<form>
	<br>
    <input type="button" name="printButton" onclick="window.print()" value="Print">
</form>
	
<div class="circle-button" onclick="window.location.href = 'subject_registration.php'">
	<i class="fa fa-arrow-left"></i>
</div>
	
<div class="footer">
    <p>@2023 All right reserved</p>
</div>

</body>
</html>