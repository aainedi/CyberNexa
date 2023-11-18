<?php
require 'db_connection.php';
session_start();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $query = "SELECT studName, password, username, courseName, years, sem FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $studName = $row['studName'];
        $icNumber = $row['password'];
        $idNumber = $row['username'];
        $courseName = $row['courseName'];
        $sem = $row['sem'];
		$years = $row['years'];
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
<title>Remaining Fees Details</title>
<style>
	body {
        align-content: center;
        background-repeat: no-repeat;
        background-size: 100%;
		background-color:#ADB1FF;
        color: black;
		margin-top: 150px;
    }

    table{
        margin-left: 150px;
		margin-bottom: 60px;
		color: black;
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
		line-height: 6px;
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
</head>

<body background="background.png">
	
	<h2 align="center">DETAILS OF REMAINING FEES</h2><br><br>
    <div class="info">
      <p><strong>Student Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><?php echo $studName; ?></p>
      <p><strong>ID Number&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><?php echo $username?></p>
      <p><strong>Course &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><?php echo $courseName?></p>
      <p><strong>Period of Study &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><?php echo $years?></p>
      <p><strong>Semester  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><?php echo $sem?></p><br>
      
  <p><u>STUDENT FEE CLAIMS</u></p>
    </div>
	
	<table width="82%" border="1" style="width: 80%; margin-top: 10px; margin-bottom: 15px; align-content: center;">
		<tr>
            <td bgcolor="#FFFFFF" style="text-align: left; color: black;"><strong>Details</strong></td>
            <td bgcolor="#FFFFFF" style="text-align: right; color: black;"><strong>RM</strong></td>
        </tr>
        <tr>
          <td style="text-align: left">Service Fee</td>
          <td style="text-align: right">240.00</td>
      </tr>
        <tr>
          <td style="text-align: left">Tuition Fee</td>
          <td style="text-align: right">3,200.00</td>
      </tr>
        <tr>
          <td style="text-align: left">Student Activity Fee</td>
          <td style="text-align: right">70.00</td>
      </tr>
        <tr>
          <td style="text-align: left">&nbsp;</td>
          <td style="text-align: right">&nbsp;</td>
      </tr>
		<tr>
          <td bgcolor="#FFFFFF" style="text-align: left; color: black;"><strong>Balance Due</strong></td>
      	  <td bgcolor="#FFFFFF" style="text-align: right; color: black;"><strong>3,510.00</strong></td>
      </tr>
	</table>
	
	<div class="circle-button" onclick="window.location.href = 'finance.php'">
	<i class="fa fa-arrow-left"></i>
	</div>
	
	<div class="footer">
		<p>@2023 All right reserved</p>
	</div>
</body>
</html>