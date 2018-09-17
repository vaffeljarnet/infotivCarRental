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
//Sends a sql query to the database to set all entries in the 
//table cars to available. 

$sql = "UPDATE cars SET availability = '1' WHERE availability ='0'";

	if ($conn->query($sql) === TRUE) {
    	echo "Congratulations on getting all your cars back";
	} else {
    	echo "Error: " . $sql . "<br>" . $conn->error;
	}

?>
</br>
<button onclick="location.href='infotivCarRental/html/gui/dateSelection.html'" class="selectBtn">Back to start</button>
</body>
</html>