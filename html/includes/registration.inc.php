<?php



	include_once 'dbh.inc.php';

	$firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
	$lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
	$phone = mysqli_real_escape_string($conn, $_POST['phone']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$pass = mysqli_real_escape_string($conn, $_POST['pass']);

	$hashedPass = password_hash($pass, PASSWORD_DEFAULT);
	//Inserting user into the database

	$sql2 = "SELECT * FROM users WHERE user_email='".$email."';";
	$validEmail = $conn->query($sql2);
	$sql3 = "SELECT * FROM users WHERE user_phone='".$phone."';";
	$validPhone = $conn->query($sql3);
	
	if ($validEmail->num_rows > 0) {
		header("Location: http://localhost/infotivCarRental/html/gui/userRegistration.php?userRegistration=email");
		exit();

	}else {
		if ($validPhone->num_rows > 0) {
		header("Location: http://localhost/infotivCarRental/html/gui/userRegistration.php?userRegistration=phone");
		} else {
		$sql = "INSERT INTO users (user_first, user_last, user_email, user_phone, user_pass) VALUES('".$firstName."','".$lastName."','".$email."', '".$phone."', '".$hashedPass."');";
	 	mysqli_query($conn, $sql);
   		echo "User account created for: " . $firstName . " " . $lastName ;
		}
	}
	




