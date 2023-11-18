<?php
require 'db_connection.php';
include 'result.php';

if (isset($_GET['studName']) && isset($_GET['subjectCode'])) {
    $studName = $_GET['studName'];
    $subjectCode = $_GET['subjectCode'];

    // Modify the SQL query to include the username
    $sql = "SELECT r.*, u.username 
            FROM register r 
            JOIN users u ON r.studName = u.studName
            WHERE r.studName = '$studName' AND u.studName = '$studName'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch records and store them in $records
        $records = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        echo "Record not found.";
        exit();
    }
} else {
    echo "studName or subjectCode not provided.";
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check for the action parameter
    if (isset($_GET['action']) && $_GET['action'] === 'update') {
        // Form submission, process the update
        // Assuming you have form fields for grade and status
        $grade = $_POST['grade'];
        $status = $_POST['status'];

        // Update all records for the given studName
        foreach ($records as $record) {
            $updateResult = editStudent(
                $record['studName'],
				$record['username'],
                $record['courseCode'],
                $record['subjectCode'],
                $record['subjectName'],
                $record['creditHour'],
                $record['sem'],
                $grade,
                $status
            );
		}
            if (!$updateResult) {
                echo "<script>alert('Failed to update student data.');</script>";
                // You can include an error message or handle it as needed
                exit();
            }
       

        // Redirect to admin_view.php after successful update
        header("Location: admin_view.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student Result</title>
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

        table {
            width: 95%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #000000;
            padding: 8px;
            text-align: left;
            font-size: 15px;
            background-color: #A87BEF;
        }

        th {
            background-color: #FFFFFF;
            text-align: center;
        }

        form {
            margin-bottom: 20px;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            max-width: 100%;
            height: auto;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
            height: 100vh;
            width: 100vw;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 10px auto;
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

        #buttonContainer {
            display: flex;
            margin-bottom: 20px;
        }
		
		#backBtn{
            background-color: white;
            color: black;
            border: none;
            cursor: pointer;
            padding: 5px 20px;
            border-radius: 5px;
            font-size: 17px;
            opacity: 1.0;
            margin-left: -120px;
			text-decoration: none;
        }

        /* Style for Edit and Delete buttons */
        .editBtn{
            background-color: white;
            color: black;
            border: none;
            cursor: pointer;
            padding: 10px 19px;
            border-radius: 5px ;
            font-size: 15px;
            opacity: 1.0;
            margin-right: 5px;
			margin-bottom: 5px;
        }

        .editBtn:hover,
		#backBtn:hover,{
            opacity: 0.5;
        }
		
		#buttonContainer{
			margin-left: -1190px;
		}
    </style>
</head>
<body background="background.png">
    <h2>Update Student Result</h2>

     <?php foreach ($records as $record) : ?>
        <form action="update_result.php?studName=<?php echo $record['studName']; ?>&subjectCode=<?php echo $record['subjectCode']; ?>&action=update" method="post">
          
            <label for="studName">Student Name:</label>
            <input type="text" name="studName" value="<?php echo $record['studName']; ?>" required readonly><br><br>
		
			<label for="username">Student ID:</label>
            <input type="text" name="username" value="<?php echo $record['username']; ?>" required readonly><br><br>

            <label for="courseCode">Course Code:</label>
            <input type="text" name="courseCode" value="<?php echo $record['courseCode']; ?>" required readonly><br><br>

            <label for="subjectCode">Subject Code:</label>
            <input type="text" name="subjectCode" value="<?php echo $record['subjectCode']; ?>" required readonly><br><br>

            <label for="subjectName">Subject Name:</label>
            <input type="text" name="subjectName" value="<?php echo $record['subjectName']; ?>" required readonly><br><br>

            <label for="creditHour">Credit Hour:</label>
            <input type="text" name="creditHour" value="<?php echo $record['creditHour']; ?>" required readonly><br><br>

            <label for="sem">Semester:</label>
            <input type="text" name="sem" value="<?php echo $record['sem']; ?>" required readonly><br><br>

            <label for="grade">Grade:</label>
            <input type="text" name="grade" value="<?php echo isset($record['grade']) ? $record['grade'] : ''; ?>" required><br><br>

            <label for="status">Status:</label>
            <input type="text" name="status" value="<?php echo isset($record['status']) ? $record['status'] : ''; ?>" required><br><br>
        
			<input type="submit" value="Update Student">
            <button type="button" onclick="window.location.href='admin_view.php'">Cancel</button>
        </form>
    <?php endforeach; ?>

</body>
</html>