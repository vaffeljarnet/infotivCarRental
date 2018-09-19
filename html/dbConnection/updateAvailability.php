<?php
	session_start();
?>

<html>
<head>
<title>Updated Car Availability</title>
</head>
<body>
<?php

if($_COOKIE['previousLocation'] == "confirmBook"){
	
	if(!isset($_COOKIE['selectedLicenseNumber']) 
	|| !isset($_COOKIE['selectedMake'])
	|| !isset($_COOKIE['selectedModel']) 
	|| !isset($_COOKIE['startDate']) 
	|| !isset($_COOKIE['endDate'])
	|| !isset($_SESSION['u_id'])){
		
		echo "Booking incomplete. Go back to start.";
		
		?>
			</br>
				<button onclick="location.href='/infotivCarRental/html/gui/index.php'" class="selectBtn">Back to start</button>
			</br>
		<?php
		
	}else{
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

		$sql = "INSERT INTO bookings (licenseNumber, startDate, endDate, user_id) VALUES 
				('".$_COOKIE['selectedLicenseNumber']."' , 
				'".$_COOKIE['startDate']."' , 
				'".$_COOKIE['endDate']."' ,
				'".$_SESSION['u_id']."');";
				
			if ($conn->query($sql) === TRUE) {
				echo "Congratulations on booking a ".$_COOKIE['selectedMake']." ".$_COOKIE['selectedModel'];
			} else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}

		$conn->close();	
		
		setcookie('selectedLicenseNumber', null, -1, "/");
		setcookie('selectedMake', null, -1, "/");
		setcookie('selectedModel', null, -1, "/");
		setcookie('startDate', null, -1, "/");
		setcookie('endDate', null, -1, "/");
		
		?>
		</br>
		<button onclick="location.href='/infotivCarRental/html/gui/index.php'" class="selectBtn">Back to start</button>
		</body>
		</html>
		<?php
	}	
}else{
	echo "You seem to be trying to get to this page unallowed. Please go back one step or go to start.";
	?>
		</br>
			<button onclick="location.href='/infotivCarRental/html/gui/index.php'" class="selectBtn">Back to start</button>
			<button onclick="goBack()" class="selectBtn">One step back</button>	
		</br>
		<script>
			function goBack() {
				window.history.back();
			}
		</script>
	<?php
}
?>