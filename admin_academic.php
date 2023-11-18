<?php
require 'db_connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $searchTerm = $_POST["searchTerm"];
    $searchBy = $_POST["searchBy"];

    // Construct the SQL query based on the selected search option and whether a search term is provided
    if (!empty($searchTerm)) {
        $sql = "SELECT * FROM register WHERE $searchBy LIKE '%$searchTerm%'";
    } else {
        $sql = "SELECT * FROM register";
    }

    $result = $conn->query($sql);

    // Check if the query was successful
    if (!$result) {
        die("Query failed: " . $conn->error);
    }
} else {
    // If the form is not submitted, display all data
    $sql = "SELECT * FROM register";
    $result = $conn->query($sql);

    // Check if the query was successful
    if (!$result) {
        die("Query failed: " . $conn->error);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student's Academic Information</title>
    <style>
		h2{
			text-align: center;
		}
		
		body{
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
			margin-left: px;
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
		
		.button{
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
		
		.button:hover{
			opacity: 0.1;
		}
    </style>
</head>
<body background="background.png">

<h2>Student's Academic Information</h2>

<form action="admin_academic.php" method="post">
    <label for="searchTerm">Search :</label>
    <input type="text" name="searchTerm">
    <label for="searchBy">By :</label>
    <select name="searchBy" required>
		<option value="studName"></option>
        <option value="studName">Student Name</option>
        <option value="courseCode">Course Code</option>
        <option value="subjectCode">Subject Code</option>
        <option value="subjectName">Subject Name</option>
    </select>
    <input type="submit" value="Search">
    <button type="button" onclick="window.location.href='admin_main_page.php'">Back</button>
</form><br><br>

<?php
// Display the data in a table
if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr>
            <th>Student Name</th>
            <th>Course Code</th>
            <th>Subject Code</th>
            <th>Subject Name</th>
            <th>Credit Hour</th>
            <th>Semester</th>
          </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['studName']}</td>
                <td>{$row['courseCode']}</td>
                <td>{$row['subjectCode']}</td>
                <td>{$row['subjectName']}</td>
                <td>{$row['creditHour']}</td>
                <td>{$row['sem']}</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "No data found.";
}

// Close the database connection
$conn->close();
?>

</body>
</html>
