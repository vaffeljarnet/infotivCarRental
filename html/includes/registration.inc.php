<?php
// If submit is empty then script won't start.
if (isset($_POST['submit'])) {

session_start();

	include_once 'dbh.inc.php';

	$firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
	$lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
	$phone = mysqli_real_escape_string($conn, $_POST['phone']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$pass = mysqli_real_escape_string($conn, $_POST['pass']);
	//built in function that hashes the password.
	$hashedPass = password_hash($pass, PASSWORD_DEFAULT);

	//takes the requested email and queries the db and store any result into a variable.
	$sql2 = "SELECT * FROM users WHERE user_email='".$email."';";
	$validEmail = $conn->query($sql2);
	//takes the requested phonenumber and queries the db and store any result into a variable.
	$sql3 = "SELECT * FROM users WHERE user_phone='".$phone."';";
	$validPhone = $conn->query($sql3);
	
	//checks if first and last name contain any none regular characters and if it does then exits the script and send the user back with an error message.
	if (!preg_match("/^[a-zA-Z]*$", $firstName) || !preg_match("/^[a-zA-Z]*$", $lastName)) {
		$_SESSION['errorCreate'] = 'First and last name must be characters only';
		header("Location: http://localhost/infotivCarRental/html/gui/userRegistration.php?userRegistration=name");
		exit();
	} else {
	// checks the email against the database and if it gets a result then exits script and sends user back with a error message.
	if ($validEmail->num_rows > 0) {
		$_SESSION['errorCreate'] = 'That E-mail is already taken';
		header("Location: http://localhost/infotivCarRental/html/gui/userRegistration.php?userRegistration=email");
		exit();
	// checks the phone number against the database and if it gets a result then exits script and sends user back with a error message.
	}else {
		if ($validPhone->num_rows > 0) {
		$_SESSION['errorCreate'] = 'That Phone number is already taken';
		header("Location: http://localhost/infotivCarRental/html/gui/userRegistration.php?userRegistration=phone");
		} else {
	//creates a sql statement containing the user info and creates a user in the db.
		$sql = "INSERT INTO users (user_first, user_last, user_email, user_phone, user_pass) VALUES('".$firstName."','".$lastName."','".$email."', '".$phone."', '".$hashedPass."');";
	 	mysqli_query($conn, $sql);
   	//checks cookies to determine where to send the user after completed registration.
			if(isset($_COOKIE['selectedModel'])) {
				header("Location: http://localhost/infotivCarRental/html/gui/confirmBook.php");
			} else {				
				header("Location: http://localhost/infotivCarRental/html/gui/index.php");
			}
	
		}
	}
	}
}



