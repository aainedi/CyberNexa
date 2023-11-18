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
        $updateQuery = "UPDATE register SET registered = 1 WHERE subjectCode IN ('" . implode("','", $addSubjects) . "') AND studName = '$studName'";
        mysqli_query($conn, $updateQuery);
        $updateQuery = "UPDATE register SET registered = 0 WHERE subjectCode IN ('" . implode("','", $dropSubjects) . "') AND studName = '$studName'";
        mysqli_query($conn, $updateQuery);
    }
}

$subjectsQuery = "
    SELECT 
        ROW_NUMBER() OVER () AS row_num, 
        s.subjectCode, 
        s.subjectName, 
        s.creditHour, 
        r.grade, 
        r.status
    FROM subjects s
    JOIN register r ON s.subjectCode = r.subjectCode
    WHERE r.studName = '$studName'
";

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
<title>Result Slip</title>
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
</head>

<body style="background-image: url('background.png');">
	
	<h2 align="center">EXAM RESULTS SESSION 0723</h2>
    <div class="info">
      <p><strong>Student Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><?php echo $studName; ?></p>
      <p><strong>Course &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><?php echo $courseName?></p>
      <p><strong>Mykad Number&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><?php echo $icNumber; ?></p>
    </div>
	
	<table width="82%" border="1" style="width: 80%; margin-top: 20px; margin-bottom: 15px; align-content: center;">
	<thead>
        <tr>
            <th width="6%">No</th>
            <th width="16%">Subject Code</th>
            <th width="44%">Subject Name</th>
            <th width="13%">Credit Hour</th>
            <th width="9%">Grade</th>
            <th width="12%">Status</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($subjects as $subject) { ?>
			<tr>
				<td height="34" style="text-align: center;"><?php echo $subject['row_num']; ?></td>
				<td><?php echo $subject['subjectCode']; ?></td>
				<td><?php echo $subject['subjectName']; ?></td>
				<td style="text-align: center;"><?php echo $subject['creditHour']; ?></td>
				<td style="text-align: center;"><?php echo $subject['grade']; ?></td>
				<td style="text-align: center;"><?php echo $subject['status']; ?></td>
			</tr>
	  <?php } ?>
    </tbody>
	</table>
	
	<table width="82%" border="1" style="width: 80%; margin-top: 20px; margin-bottom: 15px; align-content: center;">
	<thead>
        <tr>
            <th width="28%"></th>
            <th width="26%">Total Grade Value</th>
            <th width="26%">Total Credit Hour</th>
            <th width="20%">Average Grade Value</th>
        </tr>
    </thead>
	<tbody>
            <?php
			$totalGradeValue1 = 0;	//total grade value for current semester
			$totalCreditHour1 = 0;	//total credit hour for current semester
		
			$totalGradeValue2 = 0;	//total grade value for overall results
			$totalCreditHour2 = 0;	//total credit hour for overall results
		
			$gradeMapping = [
				'A+' => 4.00,
				'A'  => 4.00,
				'A-' => 3.67,
				'B+' => 3.33,
				'B'  => 3.00,
				'B-' => 2.67,
				'C+' => 2.33,
				'C'  => 2.00,
				'C-' => 1.67,
				'D'  => 1.00,
				'F'  => 0.00,
			];
						
			foreach ($subjects as $subject) {
				$grade = trim($subject['grade']); // Trim whitespaces

				// Check if the grade exists in the mapping, use 0.00 if not found
				$gradeValue = isset($gradeMapping[$grade]) ? $gradeMapping[$grade] : 0.00;

				// Calculate individual subject total
				$subjectTotal = $gradeValue * $subject['creditHour'];

				// Add individual subject total to the overall total
				$totalGradeValue1 += $subjectTotal;

				// Add credit hour to the overall total
				$totalCreditHour1 += $subject['creditHour'];
			}
		
			$averageGradeValue1 = min($totalGradeValue1 / $totalCreditHour1, 4.00); // average grade value for current semester

			$totalGradeValue2 = $totalGradeValue1 + 169.00; // total grade value for overall results
			$totalCreditHour2 = $totalCreditHour1 + 45; // total creditHour value for overall results
			$averageGradeValue2 = min($totalGradeValue2 / $totalCreditHour2, 4.00); // average grade value for overall results

			?>

			<!-- Insert the calculated values into the table -->
			<tr>
				<td height="25" style="text-align: center;"><strong>Current Semester</strong></td>
				<td height="25" style="text-align: center;"><strong><?php echo number_format($totalGradeValue1, 2); ?></strong></td>
				<td height="25" style="text-align: center;"><strong><?php echo $totalCreditHour1; ?></strong></td>
				<td style="text-align: center;"><strong><?php echo number_format($averageGradeValue1, 2); ?></strong></td>
			</tr>
	  <tr>
		<td height="22" style="text-align: center;"><strong>Overall Results</strong></td>
				<td height="22" style="text-align: center;"><strong><?php echo number_format($totalGradeValue2, 2); ?></strong></td>
				<td height="22" style="text-align: center;"><strong><?php echo $totalCreditHour2; ?></strong></td>
				<td style="text-align: center;"><strong><?php echo number_format($averageGradeValue2, 2); ?></strong></td>
	  </tr>
            <tr>
              <td height="22" style="text-align: center;">&nbsp;</td>
              <td height="22" colspan="3" style="text-align: center;">&nbsp;</td>
            </tr>
            <tr>
              <td height="22" style="text-align: center;"><strong>Status</strong></td>
              <td height="22" colspan="3" style="text-align: center;"><strong>PASS</strong></td>
            </tr>
            <tr>
              <td height="22" style="text-align: center;"><strong>Remark</strong></td>
              <td height="22" colspan="3" style="text-align: center;"><strong>PROCEED</strong></td>
            </tr>
    </tbody>
	</table>
		
	<div class="circle-button" onclick="window.location.href = 'academic.php'">
	<i class="fa fa-arrow-left"></i>
	</div>
	
	<button onclick="window.print()">Print Result Slip</button>

	<div class="footer">
		<p>@2023 All right reserved</p>
	</div>
</body>
</html>