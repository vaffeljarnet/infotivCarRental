<!DOCTYPE html>
<html>
<body>
<?php

//Takes the value of the selected car in showCars.phtml and sets 
//cookies for the make, model and license number to be used later.

	$cookie_name = "selectedModel";
	$cookie_value = $_POST['model'];
	setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day


	$cookie_name = "selectedMake";
	$cookie_value = $_POST['make'];
	setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
	
	$cookie_name = "selectedLicenseNumber";
	$cookie_value = $_POST['licenseNumber'];
	setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

?>

<meta http-equiv="refresh" content="0;URL=/infotivCarRental/html/gui/confirmBook.php" />

</body>
</html>