<html>
<head>
<title>Updated Car Availability</title>
</head>
<body>
<?php
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
//Sends a sql query to insert new entryin table bookings for the car selected
//in showCars.phtml using the previously stored selectedLicenseNumber cookie.

$sql = "INSERT INTO bookings VALUES ('".$_COOKIE['selectedLicenseNumber']."' , '".$_COOKIE['startDate']."' , '".$_COOKIE['endDate']."');";
	
	if ($conn->query($sql) === TRUE) {
    	echo "Congratulations on booking a ".$_COOKIE['selectedMake']." ".$_COOKIE['selectedModel'];
	} else {
    	echo "Error: " . $sql . "<br>" . $conn->error;
	}

$conn->close();	
	
?>
</br>
<button onclick="location.href='/infotivCarRental/html/gui/index.html'" class="selectBtn">Back to start</button>
</body>
</html>