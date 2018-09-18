<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Infotiv Car Rental</title>
</head>
<body>
<header>
	


</header>
<!-- Inputs two date selection fields and a continue button that directs customer to 
showCars.phtml if the given values are valid-->

	<h4>Infotiv Car Rental </h4>
	
	
    <legend>Select trip dates</legend> </br>
		
	<FORM NAME ="form1" METHOD ="POST" ACTION = "/infotivCarRental/html/cookies/setCookiesDate.php">
		
		<label for="start">Start</label>
		<input type="date" id="start" name="start" value="" min="" max="" onchange="updateLimit()" required = "required" title="Please input a valid date" pattern="[0-9]"></br>
		
		<label for="end">End</label>
		<input type="date" id="end" name="end" value="" min="" max="" required="required" title="Please input a valid date" pattern="[0-9]"></br>			
		
		<INPUT TYPE = "submit" Name = "submit" VALUE = "Continue">
	</form>

	</br>
		<button onclick="location.href='/infotivCarRental/html/gui/index.php'" class="selectBtn">Reset</button>
	</br>
	
	<p id="result"></p>

<!-- JavaScript for inputing todays date in the date fields and sets minimum date to today, 
and maximum to one month ahead. The function updateLimit() sets the selected start date as value for start date,
updates end date minimum to selected date, maximum to one month from that and value to today-->
	
	<script>
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
		
	
		
</body>
</html>