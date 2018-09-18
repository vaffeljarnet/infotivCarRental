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

//A query for selecting all unique car models in the db that are available
$sqlBookings = "SELECT * FROM bookings";
$result = $conn->query($sqlBookings);
$licenseNumbers = [];
//Loops trough the result of the query and populates the html table
//on the page with all cars from the database table "cars"

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		
		$start_date = $row['startDate'];
		$end_date = $row['endDate'];
		$start_from_user = "2018-09-20";
		$end_from_user = "2018-09-22";
		//$start_from_user = $_COOKIE['startDate'];
		//$end_from_user = $_COOKIE['endDate'];
		
		if(check_in_range($start_date, $end_date, $start_from_user, $end_from_user)==true){
			array_push($licenseNumbers, $row['licenseNumber']);
		}	
    }
} else {
    echo "0 results";
}


$licenseNumbers = array_unique($licenseNumbers);

//print_r($licenseNumbers);

$arrayKeys = array_keys($licenseNumbers);
$lastArrayKey = array_pop($arrayKeys);

$sqlCars = "SELECT DISTINCT model FROM cars WHERE NOT licenseNumber IN ('";

foreach ($licenseNumbers as $key => $value) {
    if($key == $lastArrayKey){
		$sqlCars .= $value . "');";
	}else{
		$sqlCars .= $value . "','";
	}
}

echo $sqlCars;

function check_in_range($start_date, $end_date, $start_from_user, $end_from_user)
{
  // Convert to timestamp
  $start_ts = strtotime($start_date);
  $end_ts = strtotime($end_date);
  $userStart_ts = strtotime($start_from_user);
  $userEnd_ts = strtotime($end_from_user);
  
  // Check that user date is between start & end
  return (($userStart_ts >= $start_ts) && ($userStart_ts <= $end_ts) || ($userEnd_ts >= $start_ts) && ($userEnd_ts <= $end_ts));
}



?>