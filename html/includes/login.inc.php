<?php
	session_start();

if (isset($_POST['submit'])) {

	include_once 'dbh.inc.php';

	if(isset($_SERVER['HTTP_REFERER'])) {
    $previous = $_SERVER['HTTP_REFERER'];
	}

	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$pass = mysqli_real_escape_string($conn, $_POST['pass']);

	//creates a sql that selects the email based on user input and saves the email that matches
	$sql = "SELECT * FROM users WHERE userEmail='".$email."';";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);

	//checks if we got a matching email if not exits script and sends user back.

	if ($resultCheck < 1) {
		$_SESSION['error'] = 'Wrong e-mail or password';
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit();
	}else {
		
		//takes password from $result and dehashes it and then checks it against what the user typed in.
		//If there's no match it sends the user back, if it matches then the user gets logged in.

		if($row = mysqli_fetch_assoc($result)) {
			$hashedPassCheck = password_verify($pass, $row['userPass']);
			if ($hashedPassCheck == false) {
				$_SESSION['error'] = 'Wrong e-mail or password';
				header('Location: ' . $_SERVER['HTTP_REFERER']);
				exit();
			} elseif ($hashedPassCheck == true) {
				$_SESSION['u_id'] = $row['userID'];
				$_SESSION['u_first'] = $row['userFirst'];
				$_SESSION['u_last'] = $row['userLast'];
				$_SESSION['u_phone'] = $row['userPhone'];
				$_SESSION['u_email'] = $row['userEmail'];
				$_SESSION['u_admin'] = $row['Admin'];
			header('Location: ' . $_SERVER['HTTP_REFERER']);	
			exit();
			}
		}
	}
}