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
    <link href="/infotivCarRental/libs/css/jquery.multiselect.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="/infotivCarRental/html/styling/styling.css">
	<meta charset='utf-8'>
</head>
<header>
	<!--Imports the header from getHeader.inc.php by including it with php-->
	<?php include_once '../includes/getHeader.inc.php'; ?>
</header>
<body>

<?php

//Sets up a connection to the database

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
				<div id="backToDate" style="text-align: center">
				<button id="backToDateButton" class="bigButton" style="width:200px" onclick="location.href='/infotivCarRental/html/gui/index.php'" class="selectBtn">Back to date selection</button>
				</div>
			</div>
			<div id="rightpane"></div>
		</div>
	<?php
	$conn->close();
}elseif(strpos($_COOKIE['startDate'], '-10-31') !== false && strpos($_COOKIE['endDate'], '-10-31') !== false){
	?>
		<div id="mainWrapperBody" style="background-color: rgb(47,47,47)">
			<div id="leftpane"></div>
			<div id="middlepane">
				<div id="showQuestion">
					<h1 id="questionText" style="color: rgb(237,110,28)">🎃 No car rentals this day, this one is on the road! 🎃</h1>
				</div>
				<div id="backToDate" style="text-align:center;">
					<img style="border-radius: 15px; border: 5px solid rgb(237,110,28)" src="/infotivCarRental/img/duel.gif"></img>
				</div>			
			</div>
		<div id="rightpane"></div>
	<?php
	$conn->close();
}else{
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			
			$startDate = $row['startDate'];
			$endDate = $row['endDate'];
			$startFromUser = $_COOKIE['startDate'];
			$endFromUser = $_COOKIE['endDate'];
			
			if(checkInRange($startDate, $endDate, $startFromUser, $endFromUser)==true){
				array_push($licenseNumbers, $row['licenseNumber']);
			}	
		}
	}else {
		
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
		$sqlCars .= "') GROUP BY model, passengers;";
	}else{
		foreach ($licenseNumbers as $key => $value) {     
				if($key == $lastArrayKey){
					$sqlCars .= $value . "') GROUP BY model, passengers;";
				}else{
					$sqlCars .= $value . "','";
				}
		}
	}

	//Stores the query with unavailable license numbers
	//as a session variable to be able to use and manipulate 
	//it in filterUpdate.inc.php
	$_SESSION['sqlQuery'] = $sqlCars;
	
	//Queries the database for the cars wich do not match 
	//the above generated license numbers and puts them as 
	//a multidimensional array in $result
	$result = $conn->query($sqlCars);
	
	//Manipulates the sql query to return unique makes
	//and executes the query. Used for populating the 
	//make filter selection.
	$sqlCars = str_replace("model, passengers","make", $sqlCars);	
	$makeList = $conn->query($sqlCars);
	
	//Manipulates the sql query to return unique 
	//passengers values and executes the query. 
	//Used for populating the Passengers filter selection.
	$sqlCars = str_replace("make","passengers", $sqlCars);
	$passList = $conn->query($sqlCars);

	//Loops trough the result of the query and populates the html table
	//on the page. On each row it also adds the image corresponding to the model, or a stock img if model is not known. 
	//Also a  Select button is added to each row that links to setCookiesCar.php file that sets cookies for the selected car.
   if ($result->num_rows > 0) {
	   
	   
	   ?>
				<div id="mainWrapperBody">
					<div id="leftpane"></div>
					<div id="middlepane">
						<div id="showQuestion">
							<h1 id="questionText">What would you like to drive?</h1></br>
							<label class="mediumText" for="start">Selected trip dates: <?php echo $_COOKIE['startDate'] ?> – <?php echo $_COOKIE['endDate'] ?></label></br>
							<button id="backToDateButton" style="width:175px;margin-top:12px;" onclick="location.href='/infotivCarRental/html/gui/index.php'" class="selectBtn">Back to date selection</button>
						</div>
						<div id="filters">
							<div id="filterMakeHolder" class="filterHolder">
								<select multiple="multiple" id="filterMake">
									<?php
									//Populates the Make filter dropdown with options
									//generated by the contents of makeList database query
									while($row = $makeList->fetch_assoc()){
									?><option value="<?php echo $row['make'];?>"><?php echo $row['make'];?></option><?php
									}
									?>
								</select>							
							</div>
							<div id="filterPassHolder" class="filterHolder">
								<select multiple="multiple" id="filterPass">
									<?php 
									//Populates the Passengers filter dropdown with options
									//generated by the contents of passList database query									
									while($row = $passList->fetch_assoc()){
									?><option value="<?php echo $row['passengers'];?>"><?php echo $row['passengers'];?></option><?php
									}
									?>
								</select>
							</div>
						</div>
						<div id="carSelection">
							<table id="carTable">
								<tbody>	
<?php
		// The while loop swithes back and fort between html and php to 
		//to format  the table with content from db		
		while($row = $result->fetch_assoc()) {
			
			
			if($row['model']== "S90"){
				$carImage = "/infotivCarRental/img/s90.png";
			}elseif($row['model']== "V40"){
				$carImage = "/infotivCarRental/img/v40.png";
			}elseif($row['model']== "XC90"){
				$carImage = "/infotivCarRental/img/xc90.png";
			}elseif($row['model']== "Model S"){
				$carImage = "/infotivCarRental/img/modelS.png";
			}elseif($row['model']== "Model X"){
				$carImage = "/infotivCarRental/img/modelX.png";
			}elseif($row['model']== "Roadster"){
				$carImage = "/infotivCarRental/img/roadster.png";
			}elseif($row['model']== "TT"){
				$carImage = "/infotivCarRental/img/audiTT.png";
			}elseif($row['model']== "Q7"){
				$carImage = "/infotivCarRental/img/audiQ7.png";
			}elseif($row['model']== "Vivaro"){
				$carImage = "/infotivCarRental/img/vivaro.png";
			}else{
				$carImage = "/infotivCarRental/img/stockCar.png";
			}
			?>
									
									<tr class="carRow">										
										<td valign="top"class="mediumText"><?php echo $row['make'];?></td>
										<td valign="top" class="mediumText"><?php echo $row['model'];?></td>
										<td style="white-space: nowrap;" class="mediumText"><img src="/infotivCarRental/img/passengerIcon.png" height=24 width=15></img><?php echo $row['passengers'];?></td>											
										<td><img src="<?php echo $carImage;?>" height=59 width=150></img></td>										
										<td>
											<form name ="form1" method ="POST" action = "/infotivCarRental/html/cookies/setCookiesCar.php">
												<input name="make" type="hidden" value="<?php echo $row['make'];?>">
												<input name="model" type="hidden" value="<?php echo $row['model'];?>">
												<input name="licenseNumber" type="hidden" value="<?php echo $row['licenseNumber'];?>"><?php
												if(isset($_SESSION['u_id'])) { ?>
													<INPUT id="<?php echo "book" . str_replace(' ', '', $row['model']) . "pass" . $row['passengers'];?>"type = "submit" Name = "submit" value = "Book"><?php
												} else { ?>
													<INPUT id="<?php echo "book" . str_replace(' ', '', $row['model']) . "pass" . $row['passengers'];?>"type = "button" onclick="pls();" Name = "submit" value = "Book"> <?php
												} ?>

											</form>
										</td>
									</tr>
														
			<?php	
		}
		?>				
								</tbody>
							</table>							
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
							<button id="backToDateButton" class="bigButton" style="width:200px" onclick="location.href='/infotivCarRental/html/gui/index.php'" class="selectBtn">Back to date selection</button>
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


<script src="/infotivCarRental/libs/js/jquery.min.js"></script> 
<script src="/infotivCarRental/libs/js/jquery.multiselect.js"></script>
<script>
		
		//Manipulates the options list filterMake with
		//the library jquery.multiselect which turns it
		//in to a dropdown list with checkboxes
		$("#filterMake").multiselect({
			columns: 1,
			placeholder: "Make",
		});
		
		//Manipulates the options list filterPass with
		//the library jquery.multiselect which turns it
		//in to a dropdown list with checkboxes
		$("#filterPass").multiselect({
			columns: 1,
			placeholder: "Passengers",
		});

	//Empty arrays to house the selections from the 
	//selections in the filter dropdown menus
	var filtersMake = [];
	var filtersPass = [];
	
	
	//Function that senses if thers been an option in the
	//filter Make has been selected, adds that/those options to
	//the filterMake array and triggers the filterUpdate function.
	$(function(){

	 $("#filterMake").change(function(){

		 if($(this).val() !="0")
		  {
			filtersMake = $("#filterMake").val();
			filterUpdate();
		  }
		  else
		  {
		   document.getElementById("carSelection").innerHTML = "<label class=\x22mediumText\x22>Issue when updating filters. Please refresh page and try again</label></br></br><button style=\x22width:200px\x22 onclick=\x22location.href=\x27/infotivCarRental/html/gui/index.php\x27\x22 class=\x22selectBtn\x22>Back to date selection</button>";
		  }
		});

	});

	//Function that senses if thers been an option in the
	//filter Passengers has been selected, adds that/those options to
	//the filterPass array and triggers the filterUpdate function.
	$(function(){

	 $("#filterPass").change(function(){

		 if($(this).val() !="0")
		  {
			filtersPass = $("#filterPass").val();
			filterUpdate();
		  }
		  else
		  {
		   document.getElementById("carSelection").innerHTML = "<label class=\x22mediumText\x22>Issue when updating filters. Please refresh page and try again</label></br></br><button style=\x22width:200px\x22 onclick=\x22location.href=\x27/infotivCarRental/html/gui/index.php\x27\x22 class=\x22selectBtn\x22>Back to date selection</button>";
		  }
		});

	});
	
	//Function used to call the filterUpdate.inc.php script and supplies 
	//that script with the two arrays containing the selected filters from 
	//all filter selections.
	function filterUpdate() {
		$.ajax({
		   type: "POST",
		   data: {filtersMake:filtersMake, filtersPass:filtersPass},
		   url: "/infotivCarRental/html/includes/filterUpdate.inc.php",
		   success: function(data) {
			   document.getElementById("carSelection").innerHTML = data;     
			},
			error: function() {
				document.getElementById("carSelection").innerHTML = "<label class=\x22mediumText\x22>Issue when updating filters. Please refresh page and try again</label></br></br><button style=\x22width:200px\x22 onclick=\x22location.href=\x27/infotivCarRental/html/gui/index.php\x27\x22 class=\x22selectBtn\x22>Back to date selection</button>";
			}
		});
	}
    
    function pls(){
        alert("You need to be logged in to continue.");
    }

</script>
</body>
</html>

<?php

//Function used to check if a pair of start and end dates are within the range 
//of another pair of start and end dates.
function checkInRange($startDate, $endDate, $startFromUser, $endFromUser)
{
  // Convert to timestamp
  $startTs = strtotime($startDate);
  $endTs = strtotime($endDate);
  $userStartTs = strtotime($startFromUser);
  $userEndTs = strtotime($endFromUser);
  
  // Check if the users selected dates is between start & end
  return (($userStartTs >= $startTs) && ($userStartTs <= $endTs) || ($userEndTs >= $startTs) && ($userEndTs <= $endTs));
}

?>