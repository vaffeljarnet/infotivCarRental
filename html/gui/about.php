<?php
	session_start();
	$cookie_name = "previousLocation";
	$cookie_value = "about";
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
	<!---Simple information page that inputs a presentation text, and also states the current version-->
		<div id="aboutHeading">
			<h1 id="questionText">Welcome</h1>
		</div>		
		<div id="mainText">
			<label class="mediumText">This project was created at an internship at Infotiv AB, Gothenburg, by Joakim Gustavsson and Johan Larsson, with the help of Maheel Dabarera. The project consists of a mock car rental homepage, to be used as a system under test for educational purposes.</label>
		</div>
		<div id="versionNr">
			<label class="mediumText">Homepage version: 0.2</label></br></br>
			<a id="linkButton" href="location.href='/infotivCarRental/documentation/index.html" target="_blank">Documentation</a></br>
			<a id="linkButton" href="https://github.com/vaffeljarnet/infotivCarRental" target="_blank">Source Code</a>			
		</div>
	</div>
	<div id="rightpane"></div>
</div>
</body>
</html>