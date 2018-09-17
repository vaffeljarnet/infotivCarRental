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

//Sends a sql query to update the availability for one of the cars selected
//in showCars.phtml using the previously stored cookie from setCookiesCar.php

$sql = "UPDATE cars SET availability = '0' WHERE model ='".$_COOKIE['selectedCar']."' AND availability ='1' LIMIT 1";

	if ($conn->query($sql) === TRUE) {
    	echo "Congratulations on booking a ".$_COOKIE['selectedMake']." ".$_COOKIE['selectedCar'];
	} else {
    	echo "Error: " . $sql . "<br>" . $conn->error;
	}

?>
</br>
<button onclick="location.href='/infotivCarRental/html/index.html'" class="selectBtn">Back to start</button>
</body>
</html>
