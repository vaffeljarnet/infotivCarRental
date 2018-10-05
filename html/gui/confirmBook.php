<?php
	session_start();
	$cookie_name = "previousLocation";
	$cookie_value = "confirmBook";
	setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
?>

<!DOCTYPE html>
<meta charset="UTF-8"> </meta>
<html>
<head>
<title>Infotiv Car Rental</title>
<link rel="stylesheet" type="text/css" href="/infotivCarRental/html/styling/styling.css"> 
</head>	
<header>
	<!--Imports the header from getHeader.inc.php by including it with php-->
	<?php include_once '../includes/getHeader.inc.php';
	//checks if user is logged in, if NOT then return to index.
	if(!isset($_SESSION['u_id']) || !isset($_COOKIE['selectedModel']) || !isset($_COOKIE['startDate'])) {
		header('Location: index.php');
		exit;
	}

	 ?>
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
			<input id="cardNum" class="biggerInputFields" type="text" required="required" pattern="[0-9]{16}" title="16 Numbers, real info only" placeholder="Card number" maxlength="16"><br><br>
			<input id="fullName" class="biggerInputFields" type="text" required="required" name="fullName" pattern="(?![\s',0-9]+$)^[^±!@£$%^&*_+§¡€#¢§¶•ªº«\\/<>?:;|=.]{1,30}$" title="Your name please, Sir/M'am." placeholder="Name of card holder"><br><br>
			
			<select title="Month" class="mediumInputFields">

<?php   
	for ($month = 1; $month <= 12; $month++) {  ?>
		<option id="month<?php echo $month;?>"><?php echo $month;?></option><?php
	} ?>
			</select>
			<select title="Year" class="mediumInputFields">

<?php
	for ($year = 2018; $year <= 2025; $year++) {  ?>
		<option id="month<?php echo $year;?>"><?php echo $year;?></option><?php
	} ?>

			</select>
			<input id="cvc" class="mediumInputFields" type="text" required="required" pattern="[0-9]{3}" title="last 3 digits on the back of your card" placeholder="cvc/cid" maxlength="3"><br><br>
			
			<button class="bigButton" id="cancel" type="button" onclick="location.href='showCars.php'">Cancel</button>
			<button id="confirm" class="bigButton" type="Submit">Confirm</button>

			</form>
		</div>
	</div>
	<div id="rightpane"></div>
</div>		
</body>

</html>