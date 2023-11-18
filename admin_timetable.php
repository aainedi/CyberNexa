<?php
// Include database connection file
require 'db_connection.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process the form data
    if (isset($_POST['courseCode']) && isset($_FILES['timetableImage'])) {
        $courseCode = $_POST['courseCode'];

        // Process the uploaded image
        $targetDirectory = "projectweb"; // Specify the directory where you want to store timetable images
        $targetFile = $targetDirectory . basename($_FILES['timetableImage']['name']);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if the image file is a actual image or fake image
        $check = getimagesize($_FILES['timetableImage']['tmp_name']);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check if the file already exists
        if (file_exists($targetFile)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES['timetableImage']['size'] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            // If everything is ok, try to upload file
            if (move_uploaded_file($_FILES['timetableImage']['tmp_name'], $targetFile)) {
                // Update the database with the file information
                $updateQuery = "UPDATE users SET timetable_image = '$targetFile' WHERE courseCode = '$courseCode'";
                mysqli_query($conn, $updateQuery);
                echo "The file " . htmlspecialchars(basename($_FILES['timetableImage']['name'])) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
}

// Retrieve the list of distinct course names for the admin to choose
$coursesQuery = "SELECT DISTINCT courseName FROM users";
$coursesResult = mysqli_query($conn, $coursesQuery);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Timetable</title>
	<style>
        body {
            margin: 0;
            overflow: auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: auto;
            background-repeat: no-repeat;
            background-size: 100%;
            background-color: #ADB1FF;
            color: black;
            font-family: Segoe UI;
            margin-top: 100px;
        }
	</style>
</head>
<body background="background.png">

<h2>Admin Timetable</h2>

<form action="admin_timetable.php" method="post" enctype="multipart/form-data">
    <label for="courseCode">Select Course:</label>
    <select name="courseCode">
        <?php
        while ($courseRow = mysqli_fetch_assoc($coursesResult)) {
            echo '<option value="' . $courseRow['courseCode'] . '">' . $courseRow['courseName'] . '</option>';
        }
        ?>
    </select>
    <br>

    <label for="timetableImage">Upload Timetable Image:</label>
    <input type="file" name="timetableImage" id="timetableImage" accept="image/*">
    <br>

    <input type="submit" value="Submit">
</form>

</body>
</html>
