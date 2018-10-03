<?php
	session_start();
	$cookie_name = "previousLocation";
	$cookie_value = "confirmBook";
	setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
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

<div id="mainWrapperBody">
	<div id="leftpane"></div>
	<div id="middlepane">
	<!-- Prints confirmation  message with collected cookie for the selected make, model
	and the selected start and end dates.-->
		<div id="confirmQuestion">
			<h1 id="questionText">Confirm booking of <?php echo $_COOKIE['selectedMake']." ".$_COOKIE['selectedModel']; ?></h1></br>
			<label id="startDate" class="mediumText" for="start">Pickup date: <?php echo $_COOKIE['startDate'] ?></label>
			<label id="endDate" class="mediumText" for="start">Return date: <?php echo $_COOKIE['endDate'] ?></label></br>
		</div>
		<!-- Inputs buttons for canceling the booking and confirming it. If confirm button
		is pressed and user is not signed in, the booking will not be possible.-->
		<div id="confirmSelection">
			<form action="/infotivCarRental/html/gui/updateAvailability.php" method="GET">
<?php
			?><button class="bigButton" id="cancel" type="button" onclick="location.href='showCars.php'">Cancel</button><?php
			if(isset($_SESSION['u_id'])) {
				?><button id="confirm" class="bigButton" type="Submit">Confirm</button><?php
			} else {
				?><button id="confirm" class="bigButton" type="button" onclick="pls();">Confirm</button><?php
			}
		?>
			</form>
		</div>
	</div>
	<div id="rightpane"></div>
</div>		

</body>

<script>
    function pls(){
        alert("You need to be logged in to book a car.");
    }
</script>

</html>