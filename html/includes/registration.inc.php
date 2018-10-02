<?php
// If submit is empty then script won't start.
if (isset($_POST['submit'])) {

session_start();

	include_once 'dbh.inc.php';
					
	$_SESSION['firstNamePH'] = $_POST['firstName'];
 	$_SESSION['lastNamePH'] = $_POST['lastName'];
 	$_SESSION['phonePH'] = $_POST['phone'];
 	$_SESSION['emailPH'] = $_POST['email'];

	$firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
	$lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
	$phone = mysqli_real_escape_string($conn, $_POST['phone']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$pass = mysqli_real_escape_string($conn, $_POST['pass']);
	$passCon = mysqli_real_escape_string($conn, $_POST['passCon']);
	$emailCon = mysqli_real_escape_string($conn, $_POST['emailCon']);
	//built in function that hashes the password.
	$hashedPass = password_hash($pass, PASSWORD_DEFAULT);

	//takes the requested email and queries the db and store any result into a variable.
	$sql2 = "SELECT * FROM users WHERE userEmail='".$email."';";
	$validEmail = $conn->query($sql2);
	//takes the requested phonenumber and queries the db and store any result into a variable.
	$sql3 = "SELECT * FROM users WHERE userPhone='".$phone."';";
	$validPhone = $conn->query($sql3);


	//compares password and confrim passwords from the form, if no match then send user back with error.
	if ($pass!=$passCon) {
		$_SESSION['errorCreate'] = 'Passwords must match';
		header("Location: http://localhost/infotivCarRental/html/gui/userRegistration.php?userRegistration=name");
		exit();
    } else {
	//compares email and confrim email from the form, if no match then send user back with error.
	if ($email!=$emailCon) {
		$_SESSION['errorCreate'] = 'Emails must match';
		header("Location: http://localhost/infotivCarRental/html/gui/userRegistration.php?userRegistration=name");
		exit();
    } else {    
	//checks if first and last name contain any none regular characters and if it does then exits the script and send the user back with an error message.
	if (!preg_match("/^([a-zA-Z]+)$/", $firstName) || !preg_match("/^([a-zA-Z]+)$/", $lastName)) {
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
		$sql = "INSERT INTO users (userFirst, userLast, userEmail, userPhone, userPass) VALUES('".$firstName."','".$lastName."','".$email."', '".$phone."', '".$hashedPass."');";
	 	mysqli_query($conn, $sql);
	 //logs user in after creating account.
	 	$sqlLog = "SELECT * FROM users WHERE userEmail='".$email."';";
	 	$resultLog = $conn->query($sqlLog);
	 	if ($resultLog->num_rows > 0) {
			while($row = $resultLog->fetch_assoc()) {
				$_SESSION['u_id'] = $row['userID'];
				$_SESSION['u_first'] = $row['userFirst'];
				$_SESSION['u_last'] = $row['userLast'];
				$_SESSION['u_phone'] = $row['userPhone'];
				$_SESSION['u_email'] = $row['userEmail'];
			}
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
	}
	}
}




