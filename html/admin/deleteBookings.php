<?php
session_start();
if(!isset($_SESSION['u_admin'])) {
header('Location: /infotivCarRental/html/gui/index.php');
exit;
}


include_once '../includes/dbh.inc.php';
//Sends a sql query to the database to remove all entries from table bookings

$sql = "DELETE * FROM bookings";
$conn->query($sql);
$conn->close();	

?>
