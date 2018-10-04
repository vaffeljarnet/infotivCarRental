<?php 

session_start();

$lcnsNr = strtoupper($_POST['lcnsNr']);
$make = $_POST['make'];
$model = $_POST['model'];
$passengers = $_POST['passengers'];

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
//Creates a SQL query with the information given on carRegistration.html
$sql = "INSERT INTO cars (licenseNumber, make, model, passengers, availability) VALUES ('".$lcnsNr."','".$make."','".$model."','".$passengers."', 1)";

//Sends the query to SQL db and gives confirmation if the query was successfully
	if ($conn->query($sql) === TRUE) {
    	header('Location: ' . $_SERVER['HTTP_REFERER']);
		$_SESSION['carRegStatus'] = "Car added successfully";
	} else {
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		$_SESSION['carRegStatus'] = "Error when adding car: ". $sql . "<br>" . $conn->error;
	}
	
$conn->close();

?>