<?php
require 'db_connection.php';
session_start();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $query = "SELECT studName, password, username, courseCode, courseName, gender, semester FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $studName = $row['studName'];
        $icNumber = $row['password'];
        $idNumber = $row['username'];
		$courseCode = $row['courseCode'];
        $courseName = $row['courseName'];
        $gender = $row['gender'];
        $semester = $row['semester'];
    }
} 
else {
    header("Location: login.php");
    exit;
}

// Handle subject registration changes
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve hidden input values
    $scourseCode = $_POST['courseCode'];
    $subjectCode = $_POST['subjectCode'];
    $subjectName = $_POST['subjectName'];
    $creditHour = $_POST['creditHour'];
    $sem = $_POST['sem'];
}

	// Use $courseName instead of $courseCode
	$subjectsQuery = "SELECT * FROM subjects WHERE courseCode = '$courseCode'";
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
<title>Subject Registration</title>
<meta charset="utf-8">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<style>
    body {
        align-content: center;
        background-repeat: no-repeat;
        background-size: 100%;
		background-color:#ADB1FF;
        color: black;
		margin-left: 80px;
    }

    table{
        margin-left: 40px;
        margin-top: 100px;
		margin-bottom: 60px;
		color: black;
		background-color: mediumpurple;
        border: 5px solid #FFFFFF;
        border-collapse: collapse;
    }
	
	button{
		opacity: 1.0;
		padding: 10px 20px;
		background-color: white;
	}
	
	button:hover{
		opacity: 0.8;
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

<body style="background-image: url('background.png');">
	
<form action="subjectList.php" method="post">
  <input type="hidden" name="studName" value="<?php echo $studName; ?>">
    <input type="hidden" name="courseCode" value="">
    <input type="hidden" name="subjectCode" value="">
    <input type="hidden" name="subjectName" value="">
    <input type="hidden" name="creditHour" value="">
  <input type="hidden" name="sem" value="">

<p>&nbsp;</p>
<p>&nbsp;</p>
<div class="table_one">
  <table width="428" border="1">
        <tbody>
            <tr>
                <td colspan="2" bgcolor="#AB00C9"><strong>GRANT SUBJECT FOR STUDENT BELOW</strong></td>
            </tr>
            <tr>
                <td width="132"><strong>NAME</strong></td>
                <td width="280"><?php echo $studName; ?></td>
            </tr>
            <tr>
                <td><strong>IC NUMBER</strong></td>
                <td><?php echo $icNumber; ?></td>
            </tr>
            <tr>
                <td><strong>ID NUMBER</strong></td>
                <td><?php echo $username?></td>
            </tr>
            <tr>
                <td><strong>GENDER</strong></td>
                <td><?php echo $gender?></td>
            </tr>
            <tr>
                <td><strong>COURSE NAME</strong></td>
                <td><?php echo $courseName?></td>
            </tr>
            <tr>
                <td><strong>SEMESTER</strong></td>
                <td><?php echo $semester?></td>
            </tr>
        </tbody>
  </table>
</div>

<p style="margin: 0; padding: 0;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Here's the list of subjects that you can register for this semester:</p>

<table width="82%" border="1" style="width: 80%; margin-top: 8px; margin-bottom: 15px;">
    <thead>
        <tr>
            <th bgcolor="#AB00C9">No</th>
            <th bgcolor="#AB00C9">Course Code</th>
            <th bgcolor="#AB00C9">Subject Code</th>
            <th bgcolor="#AB00C9">Subject Name</th>
            <th bgcolor="#AB00C9">Credit Hour</th>
            <th bgcolor="#AB00C9">Semester</th>
            <th bgcolor="#AB00C9">Action</th>
      </tr>
    </thead>
    <tbody>
        <?php foreach ($subjects as $subject) { ?>
            <tr>
                <td height="67" style="text-align: center;"><?php echo $subject['no']; ?></td>
                <td><?php echo $subject['courseCode']; ?></td>
                <td><?php echo $subject['subjectCode']; ?></td>

                <td><?php echo $subject['subjectName']; ?></td>
                <td style="text-align: center;"><?php echo $subject['creditHour']; ?></td>
				<td style="text-align: center;"><?php echo $subject['sem']; ?></td>
                <td bgcolor="#9370DB" style="text-align: center;">
					<button type="button" class="add-button"
						onclick="addSubject('<?php echo $studName; ?>', '<?php echo $subject['courseCode']; ?>', '<?php echo $subject['subjectCode']; ?>', '<?php echo $subject['subjectName']; ?>', '<?php echo $subject['creditHour']; ?>', '<?php echo $subject['sem']; ?>', this, this.nextElementSibling)"
						style="background-color: white; color: black;">Add</button>

					<button type="button" class="drop-button"
						onclick="dropSubject('<?php echo $subject['subjectCode']; ?>', '<?php echo $subject['subjectName']; ?>', '<?php echo $subject['creditHour']; ?>', this, this.previousElementSibling)"
						style="background-color: white; color: black;">Drop</button>
				</td>
      </tr>
        <?php } ?>
    </tbody>
</table>
	  <input type="submit" name="submitBtn" value="View Subject Registered">
</form>
	
<p>&nbsp;</p>
<p>&nbsp;</p>

<div class="circle-button" onclick="window.location.href = 'academic.php'">
	<i class="fa fa-arrow-left"></i>
</div>

<div class="footer">
    <p>@2023 All right reserved</p>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
	
	$(document).ready(function () {
		// Check subject status and enable/disable buttons
		checkSubjectStatus();
	});

	function checkSubjectStatus() {
		// Use AJAX to check if the subject is already registered
		$.ajax({
			type: 'POST',
			url: 'check_subject.php', // Create a new PHP script to handle this check
			data: {
				studName: '<?php echo $studName; ?>',
				// Add other necessary parameters if needed
			},
			success: function (response) {
				// Parse the response, assuming it's a JSON object
				var subjectStatus = JSON.parse(response);

				// Iterate through subjects and update button states
				subjectStatus.forEach(function (subject) {
					var addButton = document.getElementById('addButton_' + subject.subjectCode);
					var dropButton = document.getElementById('dropButton_' + subject.subjectCode);

					if (subject.isRegistered) {
						addButton.disabled = true;
						dropButton.disabled = false;
					} else {
						addButton.disabled = false;
						dropButton.disabled = true;
					}
				});
			},
			error: function (xhr, status, error) {
				console.error(xhr, status, error);
				alert('An error occurred while checking subject status.');
			}
		});
	}
	
    function addSubject(studName, courseCode, subjectCode, subjectName, creditHour, sem, addButton, dropButton) {
        console.log('Sending AJAX request');

        // Use AJAX to check if the subject is already registered
        $.ajax({
            type: 'POST',
            url: 'check_subject.php', // Create a new PHP script to handle this check
            data: {
                studName: studName,
                subjectCode: subjectCode
            },
            success: function (response) {
                if (response === 'already_registered') {
                    alert('This subject is already registered for the student.');
                } else {
                    // Subject is not registered, proceed to add it
                    console.log('Subject is not registered, adding now...');

                    // Populate the hidden inputs with data
                    document.getElementsByName('courseCode')[0].value = courseCode;
                    document.getElementsByName('subjectCode')[0].value = subjectCode;
                    document.getElementsByName('subjectName')[0].value = subjectName;
                    document.getElementsByName('creditHour')[0].value = creditHour;
                    document.getElementsByName('sem')[0].value = sem;

                    // Use AJAX to send data to the server-side script
                    $.ajax({
                        type: 'POST',
                        url: 'add_subject.php',
                        data: {
                            studName: studName,
                            courseCode: courseCode,
                            subjectCode: subjectCode,
                            subjectName: subjectName,
                            creditHour: creditHour,
                            sem: sem
                        },
                        success: function (response) {
                            alert(response);
                        },
                        error: function (xhr, status, error) {
                            console.error(xhr, status, error);
                            alert('An error occurred while adding the subject.');
                        }
                    });

                    // Disable the Add button and enable the Drop button
                    addButton.disabled = true;
					dropButton.disabled = false;
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr, status, error);
                alert('An error occurred while checking the subject registration.');
            }
        });
    }

    function dropSubject(subjectCode, subjectName, creditHour, dropButton, addButton) {
		console.log('Drop button clicked');

		if (!dropButton.disabled) {
			console.log('Sending AJAX request');

			// Use AJAX to send data to the server-side script
			$.ajax({
				type: 'POST',
				url: 'drop_subject.php',
				data: {
					studName: '<?php echo $studName; ?>',  // Pass the student's name
					subjectCode: subjectCode
				},
				success: function (response) {
					if (response === 'subject_not_registered') {
						alert('This subject is not registered for the student. Unable to drop.');
					} else {
						alert(response);

						// Enable the Add button and disable the Drop button
						addButton.disabled = false;
						dropButton.disabled = true;
					}
				},
				error: function (error) {
					alert('An error occurred while dropping the subject.');
				}
			});
		}
	}

</script>

</body>
</html>