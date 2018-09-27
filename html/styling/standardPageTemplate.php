<?php
	session_start();
	//If previous page is needed, uncomment bellow
	/*$cookie_name = "previousLocation";
	$cookie_value = "CURRENT_PAGE_NAME_HERE";
	setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");*/
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
				<div id="middleTop"></div>		
				<div id="middleMiddle">PAGE MAIN CONTENT HERE</div>
				<div id="middleBottom">NAVIGATION BUTTONS HERE</div>
			</div>
			<div id="rightpane"></div>
		</div>
	</body>
</html>
