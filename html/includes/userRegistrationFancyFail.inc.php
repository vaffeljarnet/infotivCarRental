<?php

//if (isset($_POST['submit'])) {

	
	$servername = "localhost";
	$username = "root";
	$password = "infotiv2018";
	$dbname = "fleet_information";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

	$firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
	$lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
	$phone = mysqli_real_escape_string($conn, $_POST['phone']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$pass = mysqli_real_escape_string($conn, $_POST['pass']);

	//error handlers
	//checking for empty fields
	if (empty($firstName) || empty($lastName) || empty($phone) || empty($email) || empty($pass)) {
		header("Location: ../userRegistration.php?userRegistration=empty")
		exit();
	} else {
		//check if input characters are valid
		if(!preq_match("/^[a-zA-Z*$/", $firstName) || !preq_match("/^[a-zA-Z*$/", $lastName)) {
			header("Location: ../userRegistration.php?userRegistration=invalid")
			exit();
		} else {
			//checks if email is valid
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			header("Location: ../userRegistration.php?userRegistration=email")
			exit();	
			} else {
				$sql = "SELECT * FROM users WHERE user_email='email'";
				$result = mysqli_query($conn, $sql);
				$resultCheck = mysqli_num_rows($result);

				if($resultCheck > 0) {
					header("Location: ../userRegistration.php?userRegistration=emailTaken")
					exit();	
				} else {
					//Hashing the password
					$hashedPass = password_hash($pass, PASSWORD_DEFAULT);
					//Inserting user into the database
					$sql = "INSERT INTO users (user_first, user_last, user_email, user_phone, user_pass) VALUES('".$firstName."','".$lastName."','".$email."', '".$phone."', '".$hashedPass."')";
					mysqli_query($conn, $sql);
					header("Location: ../userRegistration.php?userRegistration=UserCreated");
					exit();	

				}
			}

		}
	}


//} else {
//	header("Location: ../userRegistration.php")
//	exit();
//}