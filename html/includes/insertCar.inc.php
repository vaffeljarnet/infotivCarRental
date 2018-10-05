<?php 

session_start();

if(isset($_POST['addCar'])){

	$_SESSION['carRegLcnsNr'] = strtoupper($_POST['lcnsNr']);
	$_SESSION['carRegMake']  = $_POST['make'];
	$_SESSION['carRegModel'] = $_POST['model'];
	$_SESSION['carRegPass']  = $_POST['passengers'];

	//Sets up a connection to the database

	include_once '../includes/dbh.inc.php';

	//Creates a SQL query with the information given on carRegistration.html
	$sql = "INSERT INTO cars (licenseNumber, make, model, passengers, availability) VALUES ('".$_SESSION['carRegLcnsNr']."','".$_SESSION['carRegMake'] ."','".$_SESSION['carRegModel'] ."','".$_SESSION['carRegPass']  ."', 1)";

		//Sends the query to SQL db and gives confirmation if the query was successfully
	if ($conn->query($sql) === TRUE) {
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		$_SESSION['carRegStatus'] = "Car added successfully";
		unset($_SESSION['carRegLcnsNr']);
		unset($_SESSION['carRegMake'] );
		unset($_SESSION['carRegModel']);
		unset($_SESSION['carRegPass']);
	} else {

		if(strpos($conn->error, 'Duplicate entry')!== false){
			header('Location: ' . $_SERVER['HTTP_REFERER']);
			$_SESSION['carRegStatus'] = "License number is aldready registered";
		}else{
			header('Location: ' . $_SERVER['HTTP_REFERER']);
			$_SESSION['carRegStatus'] = "Error when adding car: ". $conn->error;
		}
	}
	
	$conn->close();

}

?>