<?php 

session_start();

//Fetches the sql query generated in showCars.php 
//with the unavailable license numbers as a String
$sql = $_SESSION['sqlQuery']; 

//Fetches the selected filters from the Make filter 
//in showCars.php and puts them in a String array
$filtersMake = $_REQUEST['filtersMake'];

//Fetches the selected filters from the Passengers filter 
//in showCars.php and puts them in a String array
$filtersPass = $_REQUEST['filtersPass'];

//Sets up a connection to the database
include_once '../includes/dbh.inc.php';

$error = false;
$errorMessage = "";

if(!empty($filtersMake) && !empty($filtersPass)){
	
	//If the user has selected filters for both Make
	//and Passengers, the sql String is manipulated to
	//sort out the cars that meet the criterias from
	//Make and Passengers filter selection.
	if(empty($filtersMake)){
		$error = true;
		$errorMessage = "Make filter error in filterUpdate.inc.php";
	}elseif(empty($filtersPass)){
		$error = true;
		$errorMessage = "Passenger filter error in filterUpdate.inc.php";
	}else{
	
		$arrayKeys = array_keys($filtersMake);
		$lastArrayKey = array_pop($arrayKeys);
		
		$sql = str_replace("GROUP BY model, passengers;","AND make IN ('", $sql);
		
		foreach ($filtersMake as $key => $value) {     
				if($key == $lastArrayKey){
					$sql .= $value . "') AND passengers IN (";
				}else{
					$sql .= $value . "','";
				}
		}
		
		$arrayKeysPass = array_keys($filtersPass);
		$lastArrayKeyPass = array_pop($arrayKeysPass);
		
		foreach ($filtersPass as $key => $value) {     
				if($key == $lastArrayKeyPass){
					$sql .= $value . ") GROUP BY model, passengers;";
				}else{
					$sql .= $value . ",";
				}
		}
		$result = $conn->query($sql);
	}
	
}elseif(!empty($filtersMake) && empty($filtersPass)){
	
	//If the user has selected filters from only Make,
	//the sql String is manipulated to
	//sort out the cars that meet the criterias from
	//Make filter selection.
	if(empty($filtersMake)){
		$error = true;
		$errorMessage = "Make filter error in filterUpdate.inc.php";
	}else{
		
		$arrayKeys = array_keys($filtersMake);
		$lastArrayKey = array_pop($arrayKeys);
		
		$sql = str_replace("GROUP BY model, passengers;","AND make IN ('", $sql);
		
		foreach ($filtersMake as $key => $value) {     
				if($key == $lastArrayKey){
					$sql .= $value . "') GROUP BY model, passengers;";
				}else{
					$sql .= $value . "','";
				}
		}
		$result = $conn->query($sql);
	}
	
	
}elseif(empty($filtersMake) && !empty($filtersPass)){
	
	//If the user has selected filters from only Passengers,
	//the sql String is manipulated to
	//sort out the cars that meet the criterias from
	//Passengers filter selection.
	if(empty($filtersPass)){
		$error = true;
		$errorMessage = "Passenger filter error in filterUpdate.inc.php";
	}else{
		
		$arrayKeys = array_keys($filtersPass);
		$lastArrayKey = array_pop($arrayKeys);
		
		$sql = str_replace("GROUP BY model, passengers;","AND passengers IN (", $sql);
		
		foreach ($filtersPass as $key => $value) {     
				if($key == $lastArrayKey){
					$sql .= $value . ") GROUP BY model, passengers;";
				}else{
					$sql .= $value . ",";
				}
		}
		$result = $conn->query($sql);
	}
	
}else{
	//If no filters are selected the sql string is not
	//edited and the listed cars are only listed based
	//on availability, as in showCars.php
	$result = $conn->query($sql);
}

$conn->close();

	//If the result generated by one of the querys above has one 
	//or more entries, a new table is generated based on the content of
	//the result and replaces the previous one.
	if ($result->num_rows > 0) {   
		?>	
							<table id="carTable">
								<tbody>	

		<?php
		$idCounter = 1;
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
			<!-- Switches back to html to format and alternates between 
			that and php to populate the table with content from db-->
									
									<tr class="carRow">										
										<td valign="top"class="mediumText"><?php echo $row['make'];?></td>
										<td valign="top" class="mediumText"><?php echo $row['model'];?></td>
										<td style="white-space: nowrap;" class="mediumText"><img src="/infotivCarRental/img/passengerIcon.png" height=24 width=15></img><?php echo $row['passengers'];?></td>											
										<td><img src="<?php echo $carImage;?>" height=59 width=150></img></td>										
										<td>
											<form name ="form1" method ="POST" action = "/infotivCarRental/html/cookies/setCookiesCar.php">
												<input name="make" type="hidden" value="<?php echo $row['make'];?>">
												<input name="model" type="hidden" value="<?php echo $row['model'];?>">
												<input name="licenseNumber" type="hidden" value="<?php echo $row['licenseNumber'];?>">
												<?php if(isset($_SESSION['u_id'])) { ?>
													<INPUT id="<?php echo carSelect . $idCounter;?>"type = "submit" Name = "submit" value = "Book"><?php
												} else { ?>
													<INPUT id="<?php echo carSelect . $idCounter;?>"type = "button" onclick="pls();" Name = "submit" value = "Book"> <?php
												} ?>
											</form>
										</td>
									</tr>
								
												
			<?php
			++$idCounter;
		}
		?>				
								</tbody>
							</table>
							
	<?php
	}elseif($error){
		?><label class="mediumText">Error when updating filters. Please refresh page or contact support.</label></br>
		<label class="mediumText">Error message: <?php echo $errorMessage?></label></br><?php
	}else{
		//If the result has no content user is asked to edit the filter selection
		?><label class="mediumText">No cars with selected filters. Please edit filter selection.</label><?php
	}	
	
?>
