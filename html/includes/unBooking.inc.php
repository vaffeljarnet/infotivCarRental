<?php
session_start();


		 
if (isset($_POST['submit'])) {
	
	include_once '../includes/dbh.inc.php';
	//if user isn't logged in as admin then it creates a sql query that removes the booking from the db.
	if(!isset($_SESSION['u_admin'])) {
		$orderID = $_POST['orderID'];
		$sql = "DELETE FROM bookings WHERE orderID ='".$orderID."';";
		$conn->query($sql);
		//sends the user back.
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		// If logged in as a admin it instead creates a query that puts the info from bookings table into the orderhistory table
		// then removes it from bookings table, and sendsthe user back to where they came from.
	}elseif (isset($_SESSION['u_admin'])) {
		$orderID = $_POST['orderID'];
		$licenseNumber = $_POST['licenseNumber'];
		$startDate = $_POST['startDate'];
		$endDate = $_POST['endDate'];
		$userID = $_POST['userID'];
		$sql = "INSERT INTO orderhistory (orderID, licenseNumber, startDate, endDate, userID) VALUES('".$orderID."','".$licenseNumber."','".$startDate."', '".$endDate."', '".$userID."');";
		$conn->query($sql);
		$sqlfinish = "DELETE FROM bookings WHERE orderID ='".$orderID."';"; 
		$conn->query($sqlfinish);
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}
	$conn->close();
	//If user is signed in as admin and has pressed the Cancel all bookings button on my page
	//the database table bookings is emptied.
}elseif(isset($_SESSION['u_admin']) && isset($_POST['cancelAll'])){	
		
	include_once '../includes/dbh.inc.php';
	
	$sql = "TRUNCATE bookings;";
		if ($conn->query($sql) === TRUE) {
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}else{
		echo $conn->error;
	}
	
	$conn->close();
} 