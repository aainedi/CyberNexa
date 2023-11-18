<?php 
	//wajib fail ini
	require 'db_connection.php';
	//mula sesi
	session_start();
	if (isset($_SESSION['username'])) {
		// Retrieve the username from the session
		$username = $_SESSION['username'];

		// Query the database to retrieve user information
		$query = "SELECT studName, password, username, nickname FROM users WHERE username = '$username'";
		$result = mysqli_query($conn, $query);

		if ($result && mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_assoc($result);
			$studName = $row['studName'];
			$icNumber = $row['password']; // Assuming IC number is stored in the 'password' column
			$idNumber = $row['username']; // Assuming ID number is stored in the 'username' column
			$nickname = $row['nickname'];
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

<!DOCTYPE html>
<html>
	<title>Admin Main Page</title>
<head>
    <style>
        body {
            margin: 0;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: auto;
        	background-repeat: no-repeat;
            background-size: 100%;
			background-color:#ADB1FF;
            color: darkgray;
            font-family: Segoe UI;
        }
		
		h2{
			margin-top: 150px;
			color: black;
			letter-spacing: 1px;
		}

        .icon-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: absolute;
            transform: translateX(-100%); /* Initial hidden state */
            transition: transform 1s ease-in-out; /* Add the transition here */
        }

        .icons-line {
            display: flex;
            align-items: center;
            margin: 15px 10px;
        }

        .icons-line a {
            display: block;
            margin: 15px 10px 10px 10px;
            align-item: center;
        }

        .icon-container.lower {
            bottom: 170px;
            left: 90px;
            transform: translateY(50%);
        }

        .icon-container.right {
            right: 20px;
            transform: translateX(100%);
            transition: transform 1s ease-in-out;
        }

        .icon-container a:hover {
            transform: scale(1.1);
        }

        .icon-container img {
            width: 60%;
            height: auto;
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

		.oval {
			position: fixed;
			right: 40px; 
			bottom: 80px; 
			width: 100px;
			height: 50px;
			border-radius: 50%;
			background-color: rebeccapurple;
			color: white;
			display: flex;
			justify-content: center;
			align-items: center;
			cursor: pointer;
			opacity: 0.5;
		}

		.oval:hover {
			opacity: 1.0;
		}
		
    </style>
	
</head>
<body background="background.png">
	<h2>WELCOME BACK, <?php echo $nickname; ?>! </h2> <br><br><br>
<div id="main-content">
    
    <div class="icon-container lower right">
        <div class="icons-line">
            <a href="admin_profile.php">
                <img src="adminicon1.png" alt="Admin Icon 1">
            </a>
            <a href="admin_academic.php">
                <img src="adminicon2.png" alt="Admin Icon 2">
            </a>
			<a href="admin_view.php">
                <img src="adminicon3.png" alt="Admin Icon 3">
            </a>
        </div>
    </div>
	
</div>
	
	<div class="oval" onclick="window.location.href = 'login.php'">
    <strong>LOGOUT</strong>
	</div>

	
    <div class="footer">
        <p>@2023 All right reserved</p>
    </div>


    <script>
    document.addEventListener("DOMContentLoaded", function () {
        setTimeout(function () {
            const rightIcons = document.querySelector(".icon-container.right");
            rightIcons.style.transform = "translateX(0)";
            
            // Now that the icons are animated, add the smooth scrolling event listener
            document.querySelector('.letsgo-button').addEventListener('click', function (e) {
                e.preventDefault();
                const targetElement = document.querySelector("#main-content");
                if (targetElement) {
                    targetElement.scrollIntoView({ behavior: 'smooth' });
                }
            });
        }, 1000);
    });
</script>

</body>
</html>