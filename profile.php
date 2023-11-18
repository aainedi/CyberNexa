<?php
require 'db_connection.php';
session_start();

if (isset($_SESSION['username'])) {
    // Retrieve the username from the session
    $username = $_SESSION['username'];

    // Query the database to retrieve user information
    $query = "SELECT studName, password, username, nickname, courseName, profile, session FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $studName = $row['studName'];
        $icNumber = $row['password']; // Assuming IC number is stored in the 'password' column
        $idNumber = $row['username']; // Assuming ID number is stored in the 'username' column
		$nickname = $row['nickname'];
        $courseName = $row['courseName'];
		$profile = $row['profile'];
		$session = $row['session'];
		if (!$row) {
			die("User not found.");
		}
    }
} else {
    // Redirect the user to the login page if they are not logged in
    header("Location: login.php");
    exit;
}
?>


<!doctype html>
<html>

<head>
    <title>Profile</title>

<style>
    h2,td {
        color: black;
        text-align: center;
    }

    img {
        width: 80%;
        height: auto;
        margin: 10px 1px 10px 5px;
    }

    body {
        align-content: center;
        vertical-align: middle;
        resize: 100%;
        background-repeat: no-repeat;
        background-size: 100%;
		background-color:#ADB1FF;
    }

    table {
        width: 70%;
        height: 70%;
        border: 3px solid #000000;
        border-collapse: collapse;
    }

    /* Style for the button container at the bottom */
    .button-container {
        display: flex;
        justify-content: space-between;
        padding: 20px ;
    }

    .button {
        background-color: rebeccapurple;
        color: white;
        padding: 10px 25px; /* Increase the padding for larger buttons */
        border: none;
        cursor: pointer;
        border-radius: 5px;
        font-size: 16px; /* Increase the font size for larger buttons */
		margin: 0px 20px;
    }

    /* Style for the button container at the bottom */
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
</style>
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
</head>

<body background="background.png">
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
<p>&nbsp;</p>
<h2>Welcome back, <?php echo $nickname; ?>! </h2> <br><br>
<table width="729" height="286" border="3" align="center">
  <tbody>
            <tr>
            <td width="158" rowspan="5"><img src="display_image.php" width="129.5" height="181.5">
			</td>
            <td width="467" height="37"><strong>NAME: <?php echo $studName; ?></strong></td>
        </tr>
        <tr>
            <td height="38"><strong>IC NUMBER: <?php echo $icNumber; ?></strong></td>
        </tr>
        <tr>
            <td height="43"><strong>ID NUMBER: <?php echo $idNumber; ?></strong></td>
        </tr>
        <tr>
            <td height="41"><strong>COURSE: <?php echo $courseName; ?></strong></td>
        </tr>
        <tr>
            <td height="41"><strong>SESSION: <?php echo $session; ?></strong></td>
        </tr>
  </tbody>
    </table>

    <p>&nbsp;</p>
    <p>
      <!-- Button container at the bottom -->
    </p>
	<div class="circle-button" onclick="window.location.href = 'main_page.php'">
	<i class="fa fa-arrow-left"></i>
	</div>

	
	<div class="footer">
			<p>@2023 All right reserved</p>
		</div>
</body>

</html>
