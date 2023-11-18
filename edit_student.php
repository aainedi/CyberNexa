<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student Information</title>
    <style>
        form {
            margin-bottom: 20px;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 50%;
            top: 46%;
            transform: translate(-50%, -50%);
            max-width: 100%;
            height: auto;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
            height: 110vh;
            width: 100vw;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #888;
            width: 40%;
            box-sizing: border-box; 
        }

        .modal-content:label {
            text-align: center;
        }

        /* Style for close button */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

<?php
require 'db_connection.php';

// Check if the username is provided in the query string
if (isset($_GET['username'])) {
    $username = $_GET['username'];

    // Retrieve existing student information
    $sql = "SELECT * FROM users WHERE username = '$username' AND title = 'STUDENT'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $student = $result->fetch_assoc();
    } else {
        echo "Student not found.";
        exit();
    }
} else {
    echo "Username not provided.";
    exit();
}
?>

<h2>Edit Student Information</h2>

<form action="update_student.php" method="post">
    <label for="username">ID Number:</label>
    <input type="text" placeholder="AM**********" name="username" value="<?php echo $student['username']; ?>" required><br><br>

    <label for="password">IC Number:</label>
    <input type="password" placeholder="12-digit IC number" name="password" value="<?php echo $student['password']; ?>" required><br><br>

    <label for="studName">Student Name:</label>
    <input type="text" placeholder="FULL NAME" name="studName" value="<?php echo $student['studName']; ?>" required><br><br>

    <label for="nickname">Nickname:</label>
    <input type="text" placeholder="ONE WORD ONLY" name="nickname" value="<?php echo $student['nickname']; ?>" required><br><br>

    <label for="courseCode">Course Code:</label>
    <input type="text" placeholder="CC101/AA101/BE101" name="courseCode" value="<?php echo $student['courseCode']; ?>" required><br><br>

    <label for="courseName">Course Name:</label>
    <input type="text" placeholder="DIPLOMA/DEGREE/MASTER/PHD IN ***" name="courseName" value="<?php echo $student['courseName']; ?>" required><br><br>

    <label for="session">Session:</label>
    <select name="session" required>
        <option value="JULY 2023 - NOVEMBER 2023" <?php echo ($student['session'] == 'JULY 2023 - NOVEMBER 2023') ? 'selected' : ''; ?>>JULY 2023 - NOVEMBER 2023</option>
        <option value="NOVEMBER 2023 - APRIL 2024" <?php echo ($student['session'] == 'NOVEMBER 2023 - APRIL 2024') ? 'selected' : ''; ?>>NOVEMBER 2023 - APRIL 2024</option>
        <option value="APRIL 2024 - JULY 2024" <?php echo ($student['session'] == 'APRIL 2024 - JULY 2024') ? 'selected' : ''; ?>>APRIL 2024 - JULY 2024</option>
    </select><br><br>

    <label for="gender">Gender:</label>
    <select name="gender" required>
        <option value="Male" <?php echo ($student['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
        <option value="Female" <?php echo ($student['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
    </select><br><br>

    <label for="semester">Current Semester:</label>
    <select name="semester" required>
        <option value="0722" <?php echo ($student['semester'] == '0722') ? 'selected' : ''; ?>>0722</option>
        <option value="1122" <?php echo ($student['semester'] == '1122') ? 'selected' : ''; ?>>1122</option>
        <option value="0423" <?php echo ($student['semester'] == '0423') ? 'selected' : ''; ?>>0423</option>
        <option value="0723" <?php echo ($student['semester'] == '0723') ? 'selected' : ''; ?>>0723</option>
        <option value="1123" <?php echo ($student['semester'] == '1123') ? 'selected' : ''; ?>>1123</option>
    </select><br><br>

    <label for="years">Years of Completion:</label>
    <select name="years" required>
        <option value="1 YEARS" <?php echo ($student['years'] == '1 YEARS') ? 'selected' : ''; ?>>1 YEARS</option>
        <option value="2 YEARS" <?php echo ($student['years'] == '2 YEARS') ? 'selected' : ''; ?>>2 YEARS</option>
        <option value="3 YEARS" <?php echo ($student['years'] == '3 YEARS') ? 'selected' : ''; ?>>3 YEARS</option>
        <option value="4 YEARS" <?php echo ($student['years'] == '4 YEARS') ? 'selected' : ''; ?>>4 YEARS</option>
        <option value="5 YEARS" <?php echo ($student['years'] == '5 YEARS') ? 'selected' : ''; ?>>5 YEARS</option>
        <option value="6 YEARS" <?php echo ($student['years'] == '6 YEARS') ? 'selected' : ''; ?>>6 YEARS</option>
    </select><br><br>

    <label for="sem">Semester:</label>
    <select name="sem" required>
        <option value="1" <?php echo ($student['sem'] == '1') ? 'selected' : ''; ?>>1</option>
        <option value="2" <?php echo ($student['sem'] == '2') ? 'selected' : ''; ?>>2</option>
        <option value="3" <?php echo ($student['sem'] == '3') ? 'selected' : ''; ?>>3</option>
        <option value="4" <?php echo ($student['sem'] == '4') ? 'selected' : ''; ?>>4</option>
        <option value="5" <?php echo ($student['sem'] == '5') ? 'selected' : ''; ?>>5</option>
        <option value="6" <?php echo ($student['sem'] == '6') ? 'selected' : ''; ?>>6</option>
        <option value="7" <?php echo ($student['sem'] == '7') ? 'selected' : ''; ?>>7</option>
        <option value="8" <?php echo ($student['sem'] == '8') ? 'selected' : ''; ?>>8</option>
    </select><br><br>

    <label for="admission">Admission:</label>
    <select name="admission" required>
        <option value="JULY 22" <?php echo ($student['admission'] == 'JULY 22') ? 'selected' : ''; ?>>JULY 22</option>
        <option value="NOVEMBER 22" <?php echo ($student['admission'] == 'NOVEMBER 22') ? 'selected' : ''; ?>>NOVEMBER 22</option>
        <option value="APRIL 23" <?php echo ($student['admission'] == 'APRIL 23') ? 'selected' : ''; ?>>APRIL 23</option>
        <option value="JULY 23" <?php echo ($student['admission'] == 'JULY 23') ? 'selected' : ''; ?>>JULY 23</option>
        <option value="NOVEMBER 23" <?php echo ($student['admission'] == 'NOVEMBER 23') ? 'selected' : ''; ?>>NOVEMBER 23</option>
    </select><br><br>

    <input type="submit" value="Update Student">
	<button type="button" onclick="window.location.href='admin_profile.php'">Cancel</button>
</form>
	
	

</body>
</html>
