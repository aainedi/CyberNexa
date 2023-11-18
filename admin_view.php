<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student's Result</title>
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

        .modal-content label {
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
    <?php
    include 'result.php';
    // Retrieve all students
    $students = getAllStudentsWithUsernames();

    echo "<h2>STUDENT'S RESULT</h2>";

    // Button container
    echo "<div id=\"buttonContainer\">";
    // Back button
    echo "<a id=\"backBtn\" href=\"admin_main_page.php\">Back</a>";
    echo "</div>";

    // Display the students in a table
    if (!empty($students)) {
        echo "<table>";
        echo "<tr>
                <th>Student Name</th>
				<th>Student ID</th>
                <th>Course Code</th>
                <th>Subject Code</th>
                <th>Subject Name</th>
                <th>Credit Hour</th>
                <th>Semester</th>
                <th>Grade</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>";

        foreach ($students as $student) {
            echo "<tr>
                    <td>{$student['studName']}</td>
					<td>{$student['username']}</td>
                    <td>{$student['courseCode']}</td>
                    <td>{$student['subjectCode']}</td>
                    <td>{$student['subjectName']}</td>
                    <td>{$student['creditHour']}</td>
                    <td>{$student['sem']}</td>
                    <td>{$student['grade']}</td>
                    <td>{$student['status']}</td>
                    <td>
                        <button class='editBtn' onclick=\"openEditModal('{$student['studName']}','{$student['studName']}')\">Update</button>
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
        <form id="updateForm" onsubmit="updateStudent(); return false;">
          <label for="studName">Student Name:</label>
          <input type="text" name="studName" required><br><br>
			
		  <label for="username">Student ID:</label>
          <input type="text" name="username" required><br><br>

          <label for="courseCode">Course Code:</label>
          <input type="text" name="courseCode" required><br><br>

          <label for="subjectCode">Subject Code:</label>
          <input type="text" name="subjectCode" required><br><br>

          <label for="subjectName">Subject Name:</label>
          <input type="text" name="subjectName" required><br><br>

          <label for="creditHour">Credit Hour:</label>
          <input type="text" name="creditHour" required><br><br>

          <label for="sem">Semester:</label>
          <input type="text" name="sem" required><br><br>

          <label for="grade">Grade:</label>
          <input type="text" name="grade" required><br><br>

          <label for="status">Status:</label>
          <input type="text" name="status" required><br><br>

          <input type="submit" value="Update">
        </form>
      </div>
    </div>

<script>
    function openEditModal(studName, subjectCode) {
        // Open the modal
        document.getElementById("myModal").style.display = "block";

        // Fetch and load the content of update_result.php into the modal for the specific subjectCode
        fetch(`update_result.php?studName=${studName}&subjectCode=${subjectCode}`)
            .then(response => response.text())
            .then(data => {
                document.querySelector('.modal-content').innerHTML = data;
            })
            .catch(error => console.error('Error fetching data:', error));
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
