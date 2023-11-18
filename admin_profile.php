<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student's Information</title>
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

        /* Style for Add New Students button */
        #buttonContainer {
            display: flex;
            margin-bottom: 20px;
        }

        #addStudentBtn {
            background-color: white;
            color: black;
            border: none;
            cursor: pointer;
            padding: 8px 13px;
            border-radius: 5px;
            font-size: 16px;
            opacity: 1.0;
            margin-right: 10px;
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
            margin-right: 10px;
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

        .deleteBtn {
            background-color: white;
            color: black;
            border: none;
            cursor: pointer;
            padding: 10px;
            border-radius: 5px;
            font-size: 15px;
            opacity: 1.0;
            margin-right: 5px;
        }

        .editBtn:hover,
        .deleteBtn:hover,
		#backBtn:hover,
		#addStudentBtn:hover{
            opacity: 0.5;
        }
		
		#buttonContainer{
			margin-left: -1190px;
		}

    </style>
</head>
<body background="background.png">

<?php
session_start();

if (isset($_SESSION['alert'])) {
    echo "<script>alert('{$_SESSION['alert']}');</script>";
    // Unset the alert to avoid displaying it again on refresh
    unset($_SESSION['alert']);
}

include 'profile_update.php';
// Retrieve all students
$students = getAllStudents();

echo "<h2>STUDENT'S INFORMATION</h2>";

// Button container
echo "<div id=\"buttonContainer\">";
// Add New Students button
echo "<button id=\"addStudentBtn\" onclick=\"openModal()\">Add New Students</button>";
// Back button
echo "<a id=\"backBtn\" href=\"admin_main_page.php\">Back</a>";
echo "</div>";

// Display the students in a table
if (!empty($students)) {
    echo "<table>";
    echo "<tr>
            <th>ID Number</th>
            <th>IC Number</th>
            <th>Student Name</th>
            <th>Nickname</th>
            <th>Course Code</th>
            <th>Course Name</th>
            <th>Session</th>
            <th>Gender</th>
            <th>Current Semester</th>
            <th>Years of Completion</th>
            <th>Semester</th>
            <th>Admission</th>
            <th>Actions</th>
          </tr>";

    foreach ($students as $student) {
        echo "<tr>
                <td>{$student['username']}</td>
                <td>{$student['password']}</td>
                <td>{$student['studName']}</td>
                <td>{$student['nickname']}</td>
                <td>{$student['courseCode']}</td>
                <td>{$student['courseName']}</td>
                <td>{$student['session']}</td>
                <td>{$student['gender']}</td>
                <td>{$student['semester']}</td>
                <td>{$student['years']}</td>
                <td>{$student['sem']}</td>
                <td>{$student['admission']}</td>
                <td>
                    <button class='editBtn' onclick=\"openEditModal('{$student['username']}')\">Edit</button>
                    <button class='deleteBtn' onclick=\"window.location.href='delete_student.php?username={$student['username']}'\">Delete</button>
                </td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "No students found.";
}

// Close the database connection
$conn->close();
?>

<div class="modal" id="myModal">
  <div class="modal-content">
	<span class="close" onclick="closeModal()">&times;</span>
    <form action="add_student.php" method="post">
      <label for="username">ID Number:</label>
      <input type="text" placeholder="AM**********" name="username" required><br><br>
      
      <label for="password">IC Number:</label>
      <input type="password" placeholder="12-digit IC number" name="password" required><br><br>
      
      <label for="studName">Student Name:</label>
      <input type="text" placeholder="FULL NAME" name="studName" required><br><br>
      
      <label for="nickname">Nickname:</label>
      <input type="text" placeholder="ONE WORD ONLY" name="nickname" required><br><br>
      
      <label for="courseCode">Course Code:</label>
      <input type="text" placeholder="CC101/AA101/BE101" name="courseCode" required><br><br>
      
      <label for="courseName">Course Name:</label>
      <input type="text" placeholder="DIPLOMA/DEGREE/MASTER/PHD IN ***" name="courseName" required><br><br>
      
      <label for="session">Session:</label>
      <select name="session" required>
        <option value="JULY 2023 - NOVEMBER 2023">JULY 2023 - NOVEMBER 2023</option>
        <option value="NOVEMBER 2023 - APRIL 2024">NOVEMBER 2023 - APRIL 2024</option>
        <option value="APRIL 2024 - JULY 2024">APRIL 2024 - JULY 2024</option>
        </select><br><br>
      
      <label for="gender">Gender:</label>
      <select name="gender" required>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
        </select><br><br>
      
      <label for="semester">Current Semester:</label>
      <select name="semester" required>
        <option value="0722">0722</option>
        <option value="1122">1122</option>
        <option value="0423">0423</option>
        <option value="0723">0723</option>
        <option value="1123">1123</option>
        </select><br><br>
      
      <label for="years">Years of Completion:</label>
      <select name="years" required>
        <option value="1 YEARS">1 YEARS</option>
        <option value="2 YEARS">2 YEARS</option>
        <option value="3 YEARS">3 YEARS</option>
        <option value="4 YEARS">4 YEARS</option>
        <option value="5 YEARS">5 YEARS</option>
        <option value="6 YEARS">6 YEARS</option>
        </select><br><br>
      
      <label for="sem">Semester:</label>
      <select name="sem" required>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        </select><br><br>
      
      <label for="admission">Admission:</label>
      <select name="admission" required>
        <option value="JULY 22">JULY 22</option>
        <option value="NOVEMBER 22">NOVEMBER 22</option>
        <option value="APRIL 23">APRIL 23</option>
        <option value="JULY 23">JULY 23</option>
        <option value="NOVEMBER 23">NOVEMBER 23</option>
        </select><br><br>
      
      <input type="submit" value="Add Student">
    </form>
  </div>
</div>

<script>
	function openModal() {
        document.getElementById("myModal").style.display = "block";
    }

    function openEditModal(username) {
        // Open the modal
        document.getElementById("myModal").style.display = "block";

        // Fetch and load the content of edit_student.php into the modal
        fetch(`edit_student.php?username=${username}`)
            .then(response => response.text())
            .then(data => {
                document.querySelector('.modal-content').innerHTML = data;
            })
            .catch(error => console.error('Error:', error));
    }

    function closeModal() {
        document.getElementById("myModal").style.display = "none";
    }

    window.onclick = function (event) {
        var modal = document.getElementById("myModal");
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>

</body>
</html>
