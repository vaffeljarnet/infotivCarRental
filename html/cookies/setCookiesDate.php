<!DOCTYPE html>
<html>
<body>
<?php

//Takes the value of the selected dates in index.html and sets 
//cookies for the start and end date to be used later

	$cookie_name = "startDate";
	$cookie_value = $_POST['start'];
	setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day


	$cookie_name = "endDate";
	$cookie_value = $_POST['end'];
	setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

?>

<meta http-equiv="refresh" content="0;URL=/infotivCarRental/html/gui/showCars.php" />

</body>
</html>