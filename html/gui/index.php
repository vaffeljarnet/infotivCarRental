<?php
	session_start();
	$cookie_name = "previousLocation";
	$cookie_value = "index";
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
		<div id="tripQuestion">
			<h1 id="questionText">When do you want to make your trip?</h1>
		</div>
		<!---Inputs date selectors that are restricted to todays date via js script.-->
		<FORM NAME ="form1" METHOD ="POST" ACTION = "/infotivCarRental/html/cookies/setCookiesDate.php">
			<div id="dateSelection">
				<input type="date" id="start" name="start" value="" min="" max="" onchange="updateLimit()" required = "required" title="Please input a valid date" pattern="[0-9]">
				<input type="date" id="end" name="end" value="" min="" max="" required="required" title="Please input a valid date" pattern="[0-9]">			
			</div>
			<!---Inputs buttons for reseting date selectors and continuing to next page.-->
			<div id="dateButtons">
				<button id="reset" class="bigButton" onclick="location.href='/infotivCarRental/html/gui/index.php'">Reset</button>
				<button id="continue" class="bigButton" type="submit" Name = "submit">Continue</button>
			</div>
		</form>
	</div>
	<div id="rightpane"></div>
</div>
</body>
<script>

		//Script that inserts todays date in the start date and end date
		//and restricts the maximum available date to one month ahead.
		var today = new Date();
		var dd = today.getDate();
		var mm = today.getMonth()+1; //January is 0!
		var yyyy = today.getFullYear();
		
		var ddPlusMonth = today.getDate();
		var mmPlusMonth = today.getMonth()+2; //January is 0!
		var yyyyPlusMonth = today.getFullYear();
		
		if(dd<10){
				dd='0'+dd
			} 
			if(mm<10){
				mm='0'+mm
			}
		
		if(ddPlusMonth<10){
				ddPlusMonth='0'+ddPlusMonth
			} 
			if(mmPlusMonth<10){
				mmPlusMonth='0'+mmPlusMonth
			}
			
		today = yyyy+'-'+mm+'-'+dd;
		var todayPlusMonth = yyyyPlusMonth+'-'+mmPlusMonth+'-'+ddPlusMonth;
		
		document.getElementById("start").setAttribute("min", today);
		document.getElementById("start").setAttribute("max", todayPlusMonth);
		document.getElementById("start").setAttribute("value", today);
		
		document.getElementById("end").setAttribute("min", today);
		document.getElementById("end").setAttribute("max", todayPlusMonth);
		document.getElementById("end").setAttribute("value", today);
		
		function updateLimit(){		
			//Function triggered when start date is updated. Updates the
			//end date to the selcted date, and sets the end dates maximum value
			//to month ahead of the selected date.
			var today  = new Date(document.getElementById("start").value);
			var dd = today.getDate();
			var mm = today.getMonth()+1; //January is 0!
			var yyyy = today.getFullYear();
			
			var ddPlusMonth = today.getDate();
			var mmPlusMonth = today.getMonth()+2; //January is 0!
			var yyyyPlusMonth = today.getFullYear();
			
			if(dd<10){
					dd='0'+dd
				} 
				if(mm<10){
					mm='0'+mm
				}
			
			if(ddPlusMonth<10){
					ddPlusMonth='0'+ddPlusMonth
				} 
				if(mmPlusMonth<10){
					mmPlusMonth='0'+mmPlusMonth
				}
				
			today = yyyy+'-'+mm+'-'+dd;
			var todayPlusMonth = yyyyPlusMonth+'-'+mmPlusMonth+'-'+ddPlusMonth;
			
			document.getElementById("start").setAttribute("value", today);
			
			document.getElementById("end").setAttribute("min", today);
			document.getElementById("end").setAttribute("max", todayPlusMonth);
			document.getElementById("end").setAttribute("value", today);
			
		}
		
	</script>
</html>