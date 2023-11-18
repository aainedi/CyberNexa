
<?php 
	//wajib fail ini
	require 'db_connection.php';
	//mula sesi
	session_start();
	if (isset($_POST['username'])) {
	$user = $_POST['username'];
	$pass = $_POST['password'];
	$query = mysqli_query($conn,
	"SELECT * FROM users WHERE username='$user'
	AND password='$pass'");
	$row = mysqli_fetch_assoc($query);
	if(mysqli_num_rows($query) == 0||$row['password']!=$pass)
	{
	echo "<script>alert('Username or Password entered are invalid. ');
	window.location='login.php'</script>";
	}
	else 
	{
	$_SESSION['username']=$row['username'];
	header("Location: main_page.php");
	}
	}
	
?>

<!DOCTYPE html>
<html>
	<title>Main Page</title>
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
            background-image: url(background.png);
        	background-repeat: no-repeat;
            background-size: 100%;
			background-color:#ADB1FF;
            color: darkgray;
            font-family: Segoe UI;
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

        .icon-container.upper {
            top: 310px;
            margin-left: 170px;
            transform: translateY(-50%);
        }

        .icon-container.lower {
            bottom: 340px;
            left: 200px;
            transform: translateY(50%);
        }

        .icon-container.left {
            left: 150px;
            transform: translateX(-100%);
            transition: transform 1s ease-in-out;
        }

        .icon-container.right {
            right: 40px;
            transform: translateX(100%);
            transition: transform 1s ease-in-out;
        }

        .icon-container a:hover {
            transform: scale(1.1);
        }

        .icon-container img {
            width: 45%;
            height: auto;
        }

        .last {
            text-align: center;
			padding-top: 600px;
            bottom: 50px; /* Adjust this value as needed */
			color: white;
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
			bottom: 100px; 
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
<body>
<div id="main-content">
    <div class="icon-container upper left">
        <div class="icons-line">
            <a href="finance.php">
                <img src="icon4.png" alt="Icon 4">
            </a>
            <a href="timetable.php">
                <img src="icon5.png" alt="Icon 5">
            </a>
        </div>
    </div>
    
    <div class="icon-container lower right">
        <div class="icons-line">
            <a href="profile.php">
                <img src="icon1.png" alt="Icon 1">
            </a>
            <a href="academic.php">
                <img src="icon2.png" alt="Icon 2">
            </a>
        </div>
    </div>
	
	<div class="last">
            <p>"Embrace your educational journey with CyberNexa and discover the full spectrum of features designed to enhance your student experience. Dive in and explore all that we have in store for you, and make the most of your time as a student."</p>
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
            const leftIcons = document.querySelector(".icon-container.left");
            const rightIcons = document.querySelector(".icon-container.right");
            leftIcons.style.transform = "translateX(0)";
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