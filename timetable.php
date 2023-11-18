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
$subjectsQuery = "SELECT no, courseCode, subjectCode, subjectName, creditHour, sem FROM subjects";
$subjectsResult = mysqli_query($conn, $subjectsQuery);

if ($subjectsResult && mysqli_num_rows($subjectsResult) > 0) {
        $row = mysqli_fetch_assoc($subjectsResult);
        $no = $row['no'];
        $courseCode = $row['courseCode'];
        $subjectCode = $row['subjectCode'];
        $subjectName = $row['subjectName'];
        $creditHour = $row['creditHour'];
		$sem = $row['sem'];
    }

$subjects = [];
if ($subjectsResult) {
    while ($subjectRow = mysqli_fetch_assoc($subjectsResult)) {
        $subjects[] = $subjectRow;
    }
}

$registerQuery = "SELECT * FROM register WHERE studName = '$studName'";
$registerResult = $conn->query($registerQuery);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class Timetable</title>
    <style>
        body {
            text-align: center;
            color: black;
            margin-top: 150px;
            margin-bottom: 50px;
            background-repeat: no-repeat;
            background-size: 100%;
			background-color:#ADB1FF;
        }

        .info {
            text-align: left;
			margin-left: 100px;
        }

        .class {
            text-align: left;
			margin-left: 100px ;
        }

        .footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: white;
            color: black;
            text-align: center;
            font-family: Segoe UI;
            font-size: 70%;
            line-height: 3px;
        }

        .circle-button {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            width: 50px;
            height: 50px;
            background-color: rebeccapurple;
            color: white;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            opacity: 0.5;
        }

        .circle-button i {
            font-size: 20px;
        }

        .circle-button:hover {
            opacity: 1.0;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body style="background-image: url('background.png');">

<h2 align="center">CLASS TIMETABLE</h2>
<div class="info">
  <p><strong>Course Code&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><?php echo $courseCode; ?></p>
  <p><strong>Course Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><?php echo $courseName?></p>
  <p><strong>Semester&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><?php echo $sem; ?></p>
</div>
<br>

<div class="class">
    <label for="timetable"><strong>Choose your class:</strong></label>

    <select id="classes" onchange="changeTimetableImage()">
        <?php
        // Display options based on the user's courseName
        if ($courseName === 'DIPLOMA IN COMPUTER SCIENCE') {
            echo '<option value=""></option>';
            echo '<option value="SECTION 1">SECTION 1</option>';
            echo '<option value="SECTION 2">SECTION 2</option>';
            echo '<option value="SECTION 3">SECTION 3</option>';
            echo '<option value="SECTION 4">SECTION 4</option>';
        } elseif ($courseName === 'DIPLOMA OF ACCOUNTANCY') {
            echo '<option value=""></option>';
            echo '<option value="SECTION 1">SECTION 1</option>';
            echo '<option value="SECTION 2">SECTION 2</option>';
        }
        ?>
    </select>
</div>
<br><br>
<img id="timetableImage" class="timetable-image" src="">


<div class="circle-button" onclick="window.location.href = 'main_page.php'">
	<i class="fa fa-arrow-left"></i>
</div>

<div class="footer">
    <p>@2023 All right reserved</p>
</div>
<script>
    function changeTimetableImage() {
        var selectedClass = document.getElementById("classes").value;
        var timetableImage = document.getElementById("timetableImage");
        timetableImage.src = getTimetableImageUrl(selectedClass);
    }

    function getTimetableImageUrl(selectedClass) {
        // Define the mapping of class to timetable image URL
        var timetableImages = {
            "DIPLOMA IN COMPUTER SCIENCE": {
                "SECTION 1": "ccsection1.png",
                "SECTION 2": "ccsection2.png",
                "SECTION 3": "ccsection3.png",
                "SECTION 4": "ccsection4.png",
            },
            "DIPLOMA OF ACCOUNTANCY": {
                "SECTION 1": "aasection01.png",
                "SECTION 2": "aasection02.png",
            },
        };

        // Retrieve the user's courseName
        var courseName = "<?php echo $courseName; ?>";

        // Return the corresponding image URL based on courseName and selectedClass
        return timetableImages[courseName] ? timetableImages[courseName][selectedClass] || "" : "";
    }
</script>

</body>
</html>
