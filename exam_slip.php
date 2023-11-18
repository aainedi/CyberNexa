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

// Handle subject registration changes
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_subjects']) && isset($_POST['drop_subjects'])) {
        $addSubjects = $_POST['add_subjects'];
        $dropSubjects = $_POST['drop_subjects'];
        $updateQuery = "UPDATE subjects SET registered = 1 WHERE subject_code IN ('" . implode("','", $addSubjects) . "')";
        mysqli_query($conn, $updateQuery);
        $updateQuery = "UPDATE subjects SET registered = 0 WHERE subject_code IN ('" . implode("','", $dropSubjects) . "')";
        mysqli_query($conn, $updateQuery);
    }
}

// Retrieve the list of subjects from the database
$subjectsQuery = "SELECT * FROM subjects";
$subjectsResult = mysqli_query($conn, $subjectsQuery);

$subjects = [];
if ($subjectsResult) {
    while ($subjectRow = mysqli_fetch_assoc($subjectsResult)) {
        $subjects[] = $subjectRow;
    }
}
?>

<!doctype html>
<html>
<head>
<title>Exam Slip</title>
<style>
	body {
    align-content: center;
    background-repeat: no-repeat;
    background-size: 100%;
	background-color:#ADB1FF;
    color: black;
    margin-top: 200px;
    }

    table{
        margin-left: 150px;
		margin-bottom: 60px;
		color: black;
		background-color: mediumpurple;
        border: 5px solid #FFFFFF;
        border-collapse: collapse;
    }
	
	h2{
		margin-bottom: 40px;
	}
	
	.info{
		margin-left: 150px;
		margin-bottom: 20px;
		padding: 2px;
		line-height: 1px;
	}
	
	button{
		margin-left: 150px;
		opacity: 1.0;
	}
	
	button:hover{
		opacity: 0.5;
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
<meta charset="utf-8">
</head>

<body style="background-image: url('background.png');">
	
	<h2 align="center">FINAL EXAMINATION SESSION 0723</h2>
    <div class="info">
      <p><strong>Student Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><?php echo $studName; ?></p>
      <p><strong>ID Number&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><?php echo $username?></p>
      <p><strong>Mykad Number&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><?php echo $icNumber; ?></p>
    </div>
	
        <?php 
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
        ?>
    </tbody>
	</table>
	
	<div class="circle-button" onclick="window.location.href = 'academic.php'">
	<i class="fa fa-arrow-left"></i>
	</div>
	
	<button onclick="window.print()">Print Exam Slip</button>

	<div class="footer">
		<p>@2023 All right reserved</p>
	</div>
</body>
</html>