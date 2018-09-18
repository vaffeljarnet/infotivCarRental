<html>
<head>
<title>Added to car rental index</title>
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
//Sends a sql query to the database to remove all entries from table bookings

$sql = "DELETE FROM bookings";

	if ($conn->query($sql) === TRUE) {
    	echo "All bookings removed";
	} else {
    	echo "Error: " . $sql . "<br>" . $conn->error;
	}

$conn->close();	
	
?>
</br>
<button onclick="location.href='infotivCarRental/html/gui/dateSelection.html'" class="selectBtn">Back to start</button>
</body>
</html>