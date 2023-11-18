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
		else{
			$title = $row['title'];

			if ($title == 'STUDENT') {
				$_SESSION['username'] = $row['username'];
				header("Location: main_page.php");
			} elseif ($title == 'ADMIN') {
				$_SESSION['username'] = $row['username'];
				header("Location: admin_main_page.php");
		}
		}
	}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Login Page</title>
</head>
<style>
/* Bordered form */
form {
  border: 3px solid #DFDFDF;
  max-width: 400px; /* Set a maximum width for the form */
  margin: 0 auto; /* Center the form horizontally */
  padding: 20px; /* Add some padding for better appearance */
  background-color: white;
}

/* Full-width inputs */
input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

/* Set a style for all buttons */
button {
  background-color: cornflowerblue;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

/* Add a hover effect for buttons */
button:hover {
  opacity: 0.8;
}

/* Center the logo uptm image inside the container */
.imgcontainer {
  text-align: center;
  margin: 5px 0 5px 0;
  line-height: 4px;
  letter-spacing: 1px;
  font-size: 120%;
  color: black;
}

/* cyberNexa */
img.cyberNexa {
  width: 50%;
  border-radius: 5%;
}

/* Add padding to container */
.container {
  padding: 16px;
}

/* The "Forgot password" text */
span.password {
  float: right;
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screen */
@media screen and (max-width: 300px) {
  span.password {
    display: block;
    float: none;
  }
  .cancelbtn {
    width: 100%;
  }
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
</style>
	

	
<body bgcolor= #ADB1FF><br><br>
<form action="login.php" method="post">
  <div class="imgcontainer">
    <p><img src="cyberNexa.png" alt="cyberNexa" width="100%" height="auto" class="cyberNexa"></p><br>
    <p><strong>CAMPUS MANAGEMENT SYSTEM</strong></p>
  </div>

  <div class="container">
    <label for="username"><b>Username</b></label>
    <input type="text" placeholder="Student ID: AM********** / Admin ID: AD****" name="username" required>

    <label for="password"><b>Password</b></label>
    <input type="password" placeholder="Default password: 12-digit IC number" name="password" required>

    <button type="Submit">Login</button>

  </div>

  <div class="footer">
    <p>Copyright 2023@ CyberNexa</p>
    <p>All rights reserved</p>
  </div>
</form>
</body>
</html>
