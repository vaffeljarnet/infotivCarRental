<?php
session_start();

include_once '../includes/dbh.inc.php';

if (isset($_POST['submit'])) {
	
	$orderID = $_POST['orderID'];
	$sql = "DELETE FROM bookings WHERE orderID ='".$orderID."';";
	$conn->query($sql);
//	$_SESSION['success'] = 'removed';
	header('Location: ' . $_SERVER['HTTP_REFERER']);

}