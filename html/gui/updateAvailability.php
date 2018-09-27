<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
<title>Infotiv Car Rental</title>
<link rel="stylesheet" type="text/css" href="/infotivCarRental/html/styling/styling.css"> 
</head>	
<header>
	<!--Imports the header from getHeader.inc.php by including it with php-->
	<?php include_once '../includes/getHeader.inc.php'; ?>
</header>
<body>
<?php
//Checks that the previous location was the confirm book page
//and that the user is signed in, book a car with incomplete information.
if($_COOKIE['previousLocation'] == "confirmBook"){
	
	if(!isset($_COOKIE['selectedLicenseNumber']) 
	|| !isset($_COOKIE['selectedMake'])
	|| !isset($_COOKIE['selectedModel']) 
	|| !isset($_COOKIE['startDate']) 
	|| !isset($_COOKIE['endDate'])
	|| !isset($_SESSION['u_id'])){
		
		echo "";
		
		?>
	<div id="mainWrapperBody">
		<div id="leftpane"></div>
		<div id="middlepane">
			<div id="confirmMessage">
				<h1 id="questionText">Booking incomplete, please try again from start.</h1>
			</div>
			<div id="backToStart">
				<button class="bigButton" onclick="location.href='/infotivCarRental/html/gui/index.php'" class="selectBtn">Home</button>
			</div>
		</div>
		<div id="rightpane"></div>
	</div>
		<?php
		
	}else{
		//Sets up a connection to the database
		include_once '../includes/dbh.inc.php';

		//Sends a sql query to insert new entry in table bookings for the car selected
		//in showCars.phtml using the previously stored selectedLicenseNumber cookie.
		$sql = "INSERT INTO bookings (licenseNumber, startDate, endDate, user_id) VALUES 
				('".$_COOKIE['selectedLicenseNumber']."' , 
				'".$_COOKIE['startDate']."' , 
				'".$_COOKIE['endDate']."' ,
				'".$_SESSION['u_id']."');";
				
			if ($conn->query($sql) === TRUE) {
				?>
	<div id="mainWrapperBody">
		<div id="leftpane"></div>
		<!-- Inputs a confirmation message with booking information, and buttons for 
		going to start page, and my page to view booking.-->
			<div id="middlepane">
				<div id="confirmMessage">
					<h1 id="questionTextSmall">A <?php echo $_COOKIE['selectedMake']." ".$_COOKIE['selectedModel']; ?> is now ready for pickup <?php echo $_COOKIE['startDate']; ?></h1>
					</br>
					<label class="mediumText">You can view your booking on your page</label>
				</div>
				<div id="backToStart">
					<button class="bigButton" onclick="location.href='/infotivCarRental/html/gui/index.php'" class="selectBtn">Home</button>
					<button class="bigButton" onclick="location.href='myPage.php'">My page</button>
				</div>
			</div>
			<div id="rightpane"></div>
	</div>
		<?php
			} else {
				?>
				<!-- If the sql query was unsucessfull, error message is printed.-->
	<div id="mainWrapperBody">
		<div id="leftpane"></div>
			<div id="middlepane">
				<div id="confirmMessage">
					<h1 id="questionTextSmall">Unfortunately there was an error in your booking. Try again, and please report the error bellow to the support if errors persists.</h1>
					<label class="mediumText">Error: <?php echo $sql . $conn->error;?></label>
				</div>
				<div id="backToStart">
					<button class="bigButton" onclick="location.href='/infotivCarRental/html/gui/index.php'" class="selectBtn">Home</button>
				</div>
			</div>
			<div id="rightpane"></div>
	</div>
		<?php
				echo "Error: " . $sql . "<br>" . $conn->error;
			}

		$conn->close();	
		
		//Cookies are reset after booking to make sure the same
		//car is not booked twice.
		setcookie('selectedLicenseNumber', null, -1, "/");
		setcookie('selectedMake', null, -1, "/");
		setcookie('selectedModel', null, -1, "/");
		setcookie('startDate', null, -1, "/");
		setcookie('endDate', null, -1, "/");
	}	
}else{
	?>
	<!-- If user inputs this url directly, a message is printed about bad request.-->
	<div id="mainWrapperBody">
		<div id="leftpane"></div>
		<div id="middlepane">
			<div id="confirmMessage">
				<h1 id="questionTextSmall">You seem to have gotten to this page by mistake. Please go back to start and try again.</h1>
			</div>
			<div id="backToStart">
				<button class="bigButton" onclick="location.href='/infotivCarRental/html/gui/index.php'" class="selectBtn">Home</button>
			</div>
		</div>
		<div id="rightpane"></div>
	</div>
	<?php
}
?>
</body>
</html>