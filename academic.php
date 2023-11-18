<!DOCTYPE html>
<html>
<head>
    <title>Academic</title>
    <style>
        body {
            background-image: url('background.png');
            background-repeat: no-repeat;
            background-size: 100%;
			background-color:#ADB1FF;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin-top: 35px;
            align-content: center;
        }

        .button-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .button {
            margin: 40px; /* Adjust margin as needed */
            padding: 40px 90px;
            background-color: white;
            color: black;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 20px;
            opacity: 1.0;
        }

        .button:hover {
            opacity: 0.5;
        }

        /* Style for the button container at the bottom */
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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <p><br><br><br><br><br></p>

    <div class="button-container">
        <a href="subject_registration.php">
            <button class="button"><strong>Subject Registration</strong></button>
        </a>
        <div style="display: flex;">
			<a href="exam_slip.php">
				<button class="button"><strong>Exam Slip</strong></button>
			</a>
			<a href="result_slip.php">
				<button class="button"><strong>Result Slip</strong></button>
			</a>        
		</div>
    </div>

    <div class="circle-button" onclick="window.location.href = 'main_page.php'">
        <i class="fa fa-arrow-left"></i>
    </div>
	
	<div class="footer">
        <p>@2023 All right reserved</p>
    </div>
</body>
</html>
