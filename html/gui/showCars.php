<?php
	session_start();
	$cookie_name = "previousLocation";
	$cookie_value = "showCars";
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

<?php

//Sets up a connection to the database

//creates a basic connection

include_once '../includes/dbh.inc.php';

//A query for fetching all information from bookings table and put them in an array

$sqlBookings = "SELECT * FROM bookings";
$result = $conn->query($sqlBookings);
$licenseNumbers = [];

//If no dates are set, an error message. Otherwise loops trough the 
//result of the query above and checks if the dates given by the user
//in index.html are within the range of the cars in the bookings table. If it is,
//the unavailable cars are put in to an array. 

if(!isset($_COOKIE['startDate']) || !isset($_COOKIE['endDate'])){
	?>
		<div id="mainWrapperBody">
			<div id="leftpane"></div>
			<div id="middlepane">
			<div id="showQuestion">
				<h1 id="questionText">No date set. Please return to date selection.</h1>
			</div>
			<div id="backToDate">
			<button class="bigButton" style="width:200px" onclick="location.href='/infotivCarRental/html/gui/index.php'" class="selectBtn">Back to date selection</button>
			</div>
			<div id="rightpane"></div>
		</div>
	<?php
	$conn->close();
}else{
	if ($result->num_rows > 0) {
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
	   
	   ?>
				<div id="mainWrapperBody">
					<div id="leftpane"></div>
					<div id="middlepane">
						<div id="showQuestion">
							<h1 id="questionText">Which car model would you like to drive?</h1></br>
							<label class="mediumText" for="start">Selected trip dates: <?php echo $_COOKIE['startDate'] ?> – <?php echo $_COOKIE['endDate'] ?></label></br>
						</div>
						<div id="backToDate">
							
						</div>
						<div id="carSelection">
							<table id="carTable">
								<tbody>	
<?php
	   
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
										<td class="mediumText"><?php echo $row['make'];?></td>
										<td class="mediumText"><?php echo $row['model'];?></td>		
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
		?>				
								</tbody>
							</table>
							</br><button style="width:200px" onclick="location.href='/infotivCarRental/html/gui/index.php'" class="selectBtn">Back to date selection</button>
						</div>
					</div>
					<div id="rightpane"></div>
				</div>
		<?php
	} else {
		//If query has no entries, that information is printed and a button to go back 
		//to date select is added.
		?>
				<div id="mainWrapperBody">
					<div id="leftpane"></div>
					<div id="middlepane">
						<div id="showQuestion">
							<h1 id="questionText">Sorry, no cars available during the selected dates</h1>
							<label class="mediumText" for="start">Selected trip dates: <?php echo $_COOKIE['startDate'] ?> – <?php echo $_COOKIE['endDate'] ?></label></br>
						</div>
						<div id="carSelection" style="margin: 0 auto">
							<button class="bigButton" style="width:200px" onclick="location.href='/infotivCarRental/html/gui/index.php'" class="selectBtn">Back to date selection</button>
						</div>
						<div id="backToDate">
						</div>
					</div>
					<div id="rightpane"></div>
				</div>
		<?php
	}

	$conn->close();
}
?>

</body>
</html>

<?php

//Function used to check if a pair of start and end dates are within the range 
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