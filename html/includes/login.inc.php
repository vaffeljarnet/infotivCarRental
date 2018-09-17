<?php

	include_once 'dbh.inc.php';

	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$pass = mysqli_real_escape_string($conn, $_POST['pass']);

	//creates a sql that selects the email based on user input and saves the email that matches
	$sql = "SELECT * FROM users WHERE user_email='".$email."';";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);

	//checks if we got a matching email if not exits script.

	if ($resultCheck < 1) {
		header('Location: http://localhost/infotivCarRental/html/gui/userLogin.php');
		exit();
	}else {
		
		//takes password from $result and dehashes it and then checks it against what the user typed in.
		//If there's no match it sends the user back, if it matches logs in the user.

		if($row = mysqli_fetch_assoc($result)) {
			//de-hashing the password.
			$hashedPassCheck = password_verify($pass, $row['user_pass']);
			if ($hashedPassCheck == false) {
			header('Location: http://localhost/infotivCarRental/html/gui/userLogin.php');
			exit();	
			} elseif ($hashedPassCheck == true) {
				//Logs in the user
			header('Location: http://www.google.com');	
			}
		}
	}