<?php
session_start();

include_once '../includes/dbh.inc.php';

if (isset($_POST['submit'])) {
	if(!isset($_SESSION['u_admin'])) {
	$orderID = $_POST['orderID'];
	$sql = "DELETE FROM bookings WHERE orderID ='".$orderID."';";
	$conn->query($sql);
//	$_SESSION['success'] = 'removed';
	header('Location: ' . $_SERVER['HTTP_REFERER']);
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
//	header('Location: ' . $_SERVER['HTTP_REFERER']);
	echo $sql;
	echo $sqlfinish;
}
}