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
	$sql = "SELECT * FROM users WHERE user_email='".$email."';";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);

	//checks if we got a matching email if not exits script.

	if ($resultCheck < 1) {
		$_SESSION['error'] = 'Wrong e-mail or password';
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit();
	}else {
		
		//takes password from $result and dehashes it and then checks it against what the user typed in.
		//If there's no match it sends the user back, if it matches then the user gets logged in.

		if($row = mysqli_fetch_assoc($result)) {
			$hashedPassCheck = password_verify($pass, $row['user_pass']);
			if ($hashedPassCheck == false) {
				$_SESSION['error'] = 'Wrong e-mail or password';
				header('Location: ' . $_SERVER['HTTP_REFERER']);
				exit();
			} elseif ($hashedPassCheck == true) {
				$_SESSION['u_id'] = $row['user_id'];
				$_SESSION['u_first'] = $row['user_first'];
				$_SESSION['u_last'] = $row['user_last'];
				$_SESSION['u_phone'] = $row['user_phone'];
				$_SESSION['u_email'] = $row['user_email'];
				$_SESSION['u_admin'] = $row['Admin'];
			header('Location: ' . $_SERVER['HTTP_REFERER']);	
			exit();
			}
		}
	}
}