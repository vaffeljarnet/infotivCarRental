<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Car Selection</title>
   <link type="text/css" href="style.css">
	<header>
		<nav>

			<div class="main-wrapper">
				<ul>
					<a href="index.php" style="float:right" >Home</a>
				</ul>
				<?php
					if(isset($_SESSION['u_id'])) {
						echo '<div class="nav-login" style="float:right">
								You are logged in!
							 	<form NAME ="logOut" ACTION="../includes/logout.inc.php" method="POST">
									<button type="submit" name="submit">Logout</button>
									</form>
							
							</div>';

					} else {
						echo '<div class="nav-login" style="float:right">
								<form NAME ="FORM" ACTION="../includes/login.inc.php" method="POST">
								<input type="email" id="email" required="required" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" placeholder="E-mail">
								<input type="password" id="password" required="required" name="pass" pattern=".{6,}" title="Six or more characters" placeholder="Password">
								<br>
								<button type="submit" name="submit">Login</button>
								<a href="userRegistration.php">Create user</a><br>' ?>
									<?php 
										if(isset($_SESSION['error'])) {
										echo $_SESSION['error'];
    									unset($_SESSION['error']);
										}
									 echo '
								

								</form>
							
							</div>';					

					}
				?>
			</div>
		</nav>
	</header>
</head>
<body>



<!-- Inputs a html table with headers-->
<h4>Select your desired car model<br></h4>

<table style="width:35%">

<tbody>

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

//A query for fetching all information from bookings table and put them in an array
$sqlBookings = "SELECT * FROM bookings";
$result = $conn->query($sqlBookings);
$licenseNumbers = [];
//Loops trough the result of the query and checks if the dates given by the user
//in index.html are within the range of the cars in the bookings table. If it is,
//the unavailable cars are put in to an array.

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		
		$start_date = $row['startDate'];
		$end_date = $row['endDate'];
		$start_from_user = $_COOKIE['startDate'];
		$end_from_user = $_COOKIE['endDate'];
		
		if(check_in_range($start_date, $end_date, $start_from_user, $end_from_user)==true){
			array_push($licenseNumbers, $row['licenseNumber']);
		}	
    }
} else {
    
}

//Sorts the array of unavailable cars and removes all duplicates
$licenseNumbers = array_unique($licenseNumbers);

//Determines the amount of entries in the licenseNumbers array
//to be able to determine when the last entry is looped through.
$arrayKeys = array_keys($licenseNumbers);
$lastArrayKey = array_pop($arrayKeys);

//Creates a sql query that sorts out all the license numbers that have previously
//been determined as not available. Resulting in a query that returns all available 
//cars, grouped by model.
$sqlCars = "SELECT * FROM cars WHERE NOT licenseNumber IN ('";
if(empty($licenseNumbers)){
	$sqlCars .= "') GROUP BY model;";
}else{
	foreach ($licenseNumbers as $key => $value) {     
			if($key == $lastArrayKey){
				$sqlCars .= $value . "') GROUP BY model;";
			}else{
				$sqlCars .= $value . "','";
			}
	}
}

$result = $conn->query($sqlCars);

//Loops trough the result of the query and populates the html table
//on the page. On each row it also adds the image corresponding to the model, or a stock img if model is not known. 
//Also a  Select button is added to each row that links to setCookiesCar.php file that sets cookies for the selected car.

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		
		if($row['model']== "S90"){
			$carImage = "/infotivCarRental/img/s90.png";
		}elseif($row['model']== "V40"){
			$carImage = "/infotivCarRental/img/v40.png";
		}elseif($row['model']== "XC90"){
			$carImage = "/infotivCarRental/img/xc90.png";
		}elseif($row['model']== "Model S"){
			$carImage = "/infotivCarRental/img/modelS.png";
		}else{
			$carImage = "/infotivCarRental/img/stockCar.png";
		}
		?>
		<!-- Switches back to html to format and alternates between 
		that and php to populate the table with content from db-->
			<tr>
				<td><?php echo $row['make'];?></td>
				<td><?php echo $row['model'];?></td>
				<td><img src="<?php echo $carImage;?>" height=59 width=150></img></td>
				<td>
					<FORM NAME ="form1" METHOD ="POST" ACTION = "/infotivCarRental/html/cookies/setCookiesCar.php">
						<input name="make" type="hidden" value="<?php echo $row['make'];?>">
						<input name="model" type="hidden" value="<?php echo $row['model'];?>">
						<input name="licenseNumber" type="hidden" value="<?php echo $row['licenseNumber'];?>">
						<INPUT TYPE = "submit" Name = "submit" VALUE = "Select">
					</form>
				</td>
			</tr>
		<?php
    }
} else {
    echo "No cars available in this period. Please select different dates.";
	?>
	</tbody>
	</table>
	</br>
		<button onclick="location.href='/infotivCarRental/html/gui/index.php'" class="selectBtn">Back to start</button>
	</br>
	<?php
}

$conn->close();

?>

</tbody>
</table>
</body>
</html>

<?php

//Function used for check if a pair of start and end dates are within the range 
//of another pair of start and end dates.
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