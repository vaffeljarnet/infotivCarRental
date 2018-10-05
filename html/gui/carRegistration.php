<?php 
	session_start();
	$cookie_name = "previousLocation";
	$cookie_value = "carRegistration";
	setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
 ?>
 
<!DOCtype html>
<html>
<head>
<title>Create user</title>
<link rel="stylesheet" type="text/css" href="/infotivCarRental/html/styling/styling.css">
</head>	
<header>
	<!--Imports the header from getHeader.inc.php by including it with php-->
	<?php include_once '../includes/getHeader.inc.php'; 
	//checks if user is logged in, if NOT then return to index.
	if(!isset($_SESSION['u_admin'])) {
	header('Location: index.php');
	exit;
	}
	?>
</header>
<body>
<div id="mainWrapperBody">
			<div id="leftpane"></div>
			<div id="middlepane">
				<div id="showQuestion" style="heigth: 10%">
					<h1 id="questionText">Fill out car details</h1>
				</div>
				<div style="text-align: center;heigth: 90%">
				
					<FORM name ="form1" method ="POST" action = "/infotivCarRental/html/includes/insertCar.inc.php">

						<!--Simple HTML form with fields for each input. The submit button 
						calls "insertInCarIndex.php" script that inputs the data in SQL db-->

						<INPUT class="bigInputFields" type = "TEXT" required="required" style="text-transform:uppercase" pattern="[A-Za-z]{3}[0-9]{3}$" title="ABC123" maxlength="6" name="lcnsNr" placeholder="License Number" value="<?php echo $_SESSION['carRegLcnsNr']?>"><br \>
						<INPUT class="bigInputFields" type = "TEXT" required="required" name="make" placeholder="Make" value="<?php echo $_SESSION['carRegMake']?>"><br \>
						<INPUT class="bigInputFields" type = "TEXT" required="required" name="model" placeholder="Model" value="<?php echo $_SESSION['carRegModel']?>"><br \>
						<select class="bigInputFields" name="passengers" required="required" value="<?php echo $_SESSION['carRegPass']?>">
						  <?php if(isset($_SESSION['carRegPass'])){
									?><option value="<?php echo $_SESSION['carRegPass']?>" selected hidden><?php echo $_SESSION['carRegPass']?></option><?php 
						  }else{
								?><option value="Passengers" selected disabled hidden>Passengers</option><?php
						  }?>
						  <option value="1">1</option>
						  <option value="2">2</option>
						  <option value="3">3</option>
						  <option value="4">4</option>
						  <option value="5">5</option>
						  <option value="6">6</option>
						  <option value="7">7</option>
						  <option value="8">8</option>
						</select></br></br>
						<?php 
						if(isset($_SESSION['carRegStatus'])) {
						?> <label id="signInError"><?php echo $_SESSION['carRegStatus']; ?> </label></br></br><?php
						unset($_SESSION['carRegStatus']);
						}
						?>
						
						<button class="bigButton" type="button" value="addCar" onclick="location.href='../gui/myPage.php'">Back</button>
						<button class="bigButton" type ="submit" name ="addCar">Add Car</button>				
					</FORM>
				</div>
			</div>
		<div id="rightpane"></div>
		
</body>
</html>