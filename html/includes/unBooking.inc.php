<?php
session_start();

include_once '../includes/dbh.inc.php';
		 
	if (isset($_POST['submit'])) {
		//if user isn't logged in as admin then it creates a sql query that removes the booking from the db.
		if(!isset($_SESSION['u_admin'])) {
		$orderID = $_POST['orderID'];
		$sql = "DELETE FROM bookings WHERE orderID ='".$orderID."';";
		$conn->query($sql);
//		$_SESSION['success'] = 'removed';
		//sends the user back.
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		// If logged in as a admin it instead creates a query that puts the info from bookings table into the orderhistory table
		// then removes it from bookings table, and sendsthe user back to where they came from.
	} elseif (isset($_SESSION['u_admin'])) {
		$orderID = $_POST['orderID'];
		$licenseNumber = $_POST['licenseNumber'];
		$startDate = $_POST['startDate'];
		$endDate = $_POST['endDate'];
		$user_id = $_POST['user_id'];
		$sql = "INSERT INTO orderHistory (orderID, licenseNumber, startDate, endDate, user_id) VALUES('".$orderID."','".$licenseNumber."','".$startDate."', '".$endDate."', '".$user_id."');";
		mysqli_query($conn, $sql);
		$sqlfinish = "DELETE FROM bookings WHERE orderID ='".$orderID."';"; 
		mysqli_query($conn, $sqlfinish);
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		echo $sql;
		echo $sqlfinish;
	}
}