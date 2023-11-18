<?php
require 'db_connection.php';
session_start();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $query = "SELECT studName, password, username, courseName, gender, semester, admission FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $studName = $row['studName'];
        $icNumber = $row['password'];
        $idNumber = $row['username'];
        $courseName = $row['courseName'];
        $gender = $row['gender'];
        $semester = $row['semester'];
		$admission = $row['admission'];
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
<title>Account Statement</title>
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
	
	p{
		margin-left: 150px;
		margin-bottom: 20px;
		padding: 2px;
		line-height: 1px;
	}
	
	button{
		margin-left: 150px;
		margin-bottom: 50px;
		opacity: 1.0;
	}
	
	button:hover{
		opacity: 0.7;
	}
	
	.footer{
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
	
	<h2 align="center">STUDENT ACCOUNT STATEMENT</h2>
<p><strong>Student Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><?php echo $studName; ?></p>
<p><strong>ID Number&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><?php echo $username?></p>
<p><strong>Mykad Number&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><?php echo $icNumber; ?></p>
<p><strong>Course &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><?php echo $courseName?></p>
<p><strong>Admission &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><?php echo $admission?></p>
	
	<table width="100%" border="1" style="width: 80%; margin-top: 20px; margin-bottom: 15px; align-content: center;">
	<thead>
        <tr>
            <th width="13%" bgcolor="#9900FF">DATE</th>
            <th width="35%" bgcolor="#9900FF">DETAILS OF FEES</th>
            <th width="18%" bgcolor="#9900FF">REFERENCES</th>
            <th width="12%" bgcolor="#9900FF">DEBIT (RM)</th>
            <th width="11%" bgcolor="#9900FF">CREDIT (RM)</th>
            <th width="13%" bgcolor="#9900FF">BALANCE (RM)</th>
        </tr>
    </thead>
	<tbody>
            <tr>
                <td height="25" style="text-align: center;">&nbsp;</td>
                <td height="25" style="text-align: left">&nbsp;</td>
                <td height="25" style="text-align: center;">&nbsp;</td>

                <td style="text-align: right">&nbsp;</td>
                <td style="text-align: right">&nbsp;</td>
                <td style="text-align: right">&nbsp;</td>
      		</tr>
            <tr>
              <td height="22" style="text-align: center;">18/08/2022</td>
              <td height="22" style="text-align: left">INVOICE</td>
              <td height="22" style="text-align: center;">KL06411/2022</td>
              <td style="text-align: right">4,660.00</td>
              <td style="text-align: right">&nbsp;</td>
              <td style="text-align: right">4,660.00</td>
            </tr>
            <tr>
              <td height="22" style="text-align: center;">24/08/2022</td>
              <td height="22" style="text-align: left">PAYMENT</td>
              <td height="22" style="text-align: center;">F0019341</td>
              <td style="text-align: right">&nbsp;</td>
              <td style="text-align: right">100.00</td>
              <td style="text-align: right">4,560.00</td>
            </tr>
            <tr>
              <td height="22" style="text-align: center;">09/09/2022</td>
              <td height="22" style="text-align: left">PAYMENT</td>
              <td height="22" style="text-align: center;">F0019405</td>
              <td style="text-align: right">&nbsp;</td>
              <td style="text-align: right">100.00</td>
              <td style="text-align: right">4,460.00</td>
            </tr>
            <tr>
              <td height="22" style="text-align: center;">22/09/2022</td>
              <td height="22" style="text-align: left">PAYMENT</td>
              <td height="22" style="text-align: center;">F0019426</td>
              <td style="text-align: right">&nbsp;</td>
              <td style="text-align: right">200.00</td>
              <td style="text-align: right">4,260.00</td>
            </tr>
            <tr>
              <td height="22" style="text-align: center;">28/09/2022</td>
              <td height="22" style="text-align: left">ADJUSTMENT: FPX HQ - 07/07/2022</td>
              <td height="22" style="text-align: center;">JV094/2022</td>
              <td style="text-align: right">&nbsp;</td>
              <td style="text-align: right">250.00</td>
              <td style="text-align: right">4,010.00</td>
            </tr>
            <tr>
              <td height="22" style="text-align: center;">17/10/2022</td>
              <td height="22" style="text-align: left">PAYMENT</td>
              <td height="22" style="text-align: center;">F0019552</td>
              <td style="text-align: right">&nbsp;</td>
              <td style="text-align: right">205.00</td>
              <td style="text-align: right">3,805.00</td>
            </tr>
            <tr>
              <td height="22" style="text-align: center;">17/10/2022</td>
              <td height="22" style="text-align: left">PAYMENT</td>
              <td height="22" style="text-align: center;">F0019555</td>
              <td style="text-align: right">&nbsp;</td>
              <td style="text-align: right">400.00</td>
              <td style="text-align: right">3,405.00</td>
            </tr>
            <tr>
              <td height="22" style="text-align: center;">17/10/2022</td>
              <td height="22" style="text-align: left">PAYMENT</td>
              <td height="22" style="text-align: center;">F0019551</td>
              <td style="text-align: right">&nbsp;</td>
              <td style="text-align: right">205.00</td>
              <td style="text-align: right">3,200.00</td>
            </tr>
            <tr>
              <td height="22" style="text-align: center;">14/12/2022</td>
              <td height="22" style="text-align: left">ADJUSTMENT: CG DECEMBER 2022 PAYMENT</td>
              <td height="22" style="text-align: center;">JV139/2022</td>
              <td style="text-align: right">&nbsp;</td>
              <td style="text-align: right">4,000.00</td>
              <td style="text-align: right">(800.00)</td>
            </tr>
            <tr>
              <td height="22" style="text-align: center;">19/12/2022</td>
              <td height="22" style="text-align: left">PAYMENT</td>
              <td height="22" style="text-align: center;">F0021017</td>
              <td style="text-align: right">&nbsp;</td>
              <td style="text-align: right">205.00</td>
              <td style="text-align: right">(1,005.00)</td>
            </tr>
            <tr>
              <td height="22" style="text-align: center;">17/01/2023</td>
              <td height="22" style="text-align: left">INVOICE</td>
              <td height="22" style="text-align: center;">KL01081/2023</td>
              <td style="text-align: right">4,205.00</td>
              <td style="text-align: right">&nbsp;</td>
              <td style="text-align: right">3,200.00</td>
            </tr>
            <tr>
              <td height="22" style="text-align: center;">10/03/2023</td>
              <td height="22" style="text-align: left">ADJUSTMENT:REDUCTION OF DORMITORY FEES SESSION 1122</td>
              <td height="22" style="text-align: center;">JV042/2023</td>
              <td style="text-align: right">&nbsp;</td>
              <td style="text-align: right">400.00</td>
              <td style="text-align: right">2,800.00</td>
            </tr>
            <tr>
              <td height="22" style="text-align: center;">30/03/2023</td>
              <td height="22" style="text-align: left">PAYMENT</td>
              <td height="22" style="text-align: center;">F0024317</td>
              <td style="text-align: right">&nbsp;</td>
              <td style="text-align: right">400.00</td>
              <td style="text-align: right">2,400.00</td>
            </tr>
            <tr>
              <td height="22" style="text-align: center;">07/06/2023</td>
              <td height="22" style="text-align: left">INVOICE</td>
              <td height="22" style="text-align: center;">F0022741</td>
              <td style="text-align: right">3,390.00</td>
              <td style="text-align: right">&nbsp;</td>
              <td style="text-align: right">5,790.00</td>
            </tr>
            <tr>
              <td height="22" style="text-align: center;">21/06/2023</td>
              <td height="22" style="text-align: left">PAYMENT</td>
              <td height="22" style="text-align: center;">F0024317</td>
              <td style="text-align: right">&nbsp;</td>
              <td style="text-align: right">190.00</td>
              <td style="text-align: right">5,600.00</td>
            </tr>
            <tr>
              <td height="22" style="text-align: center;">14/08/2023</td>
              <td height="22" style="text-align: left">CREDIT NOTE</td>
              <td height="22" style="text-align: center;">01463/2023</td>
              <td style="text-align: right">&nbsp;</td>
              <td style="text-align: right">4,000.00</td>
              <td style="text-align: right">1,600.00</td>
            </tr>
            <tr>
              <td height="22" style="text-align: center;">07/09/2023</td>
              <td height="22" style="text-align: left">INVOICE</td>
              <td height="22" style="text-align: center;">KL20676/2023</td>
              <td style="text-align: right">3,510.00</td>
              <td style="text-align: right">&nbsp;</td>
              <td style="text-align: right">5,110.00</td>
            </tr>
            <tr>
              <td height="22" style="text-align: center;">10/10/2023</td>
              <td height="22" style="text-align: left">ADJUSTMENT: MARA SESSION 0723 PAYMENT</td>
              <td height="22" style="text-align: center;">JV132/2023</td>
              <td style="text-align: right">&nbsp;</td>
              <td style="text-align: right">4,000.00</td>
              <td style="text-align: right">1,100.00</td>
            </tr>
            <tr>
              <td height="22" style="text-align: center;">&nbsp;</td>
              <td height="22" style="text-align: left">&nbsp;</td>
              <td height="22" style="text-align: center;">&nbsp;</td>
              <td style="text-align: right">&nbsp;</td>
              <td style="text-align: right">&nbsp;</td>
              <td style="text-align: right">&nbsp;</td>
            </tr>
            <tr>
              <td height="22" colspan="3" bgcolor="#9F00FF" style="text-align: center;"><strong>REMAINING FEES</strong></td>
              <td bgcolor="#9F00FF" style="text-align: right"><strong>15,765.00</strong></td>
              <td bgcolor="#9F00FF" style="text-align: right"><strong>14,655.00</strong></td>
              <td bgcolor="#9F00FF" style="text-align: right"><strong>1,110.00</strong></td>
            </tr>
    </tbody>
	</table>
	
	<button onclick="window.location.href = 'remaining.php'">Remaining Fees Details</button>
		
	<div class="circle-button" onclick="window.location.href = 'main_page.php'">
	<i class="fa fa-arrow-left"></i>
	</div>

<div class="footer">
		<p>@2023 All right reserved</p>
	</div>
</body>
</html>