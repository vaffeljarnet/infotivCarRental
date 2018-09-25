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
	<div id="headerWrapper">
		<a href="/infotivCarRental/html/gui/index.php">
			<div id="leftHeader">
				<div class="logo" id="logo">&nbsp;</div>
				<div class="title" id="title">
					<h1 id="title">Infotiv Car Rental</h1>
				</div>
			</div>
		</a>
		<div id="rightHeader">
			<div id="categories">
				<a class="categoryText" href="/infotivCarRental/html/gui/about.php">ABOUT</a>
			</div>
			<div id="userInfoWrapper">
	<?php
	if(isset($_SESSION['u_id'])) {
			?>
				<div id="userInfoTop">
					<label id="welcomePhrase">You are signed in as <?php echo $_SESSION['u_first'];?></label>
				</div>
				<div id="userInfoTopBottom">
					<form NAME ="logOut" ACTION="../includes/logout.inc.php" method="POST">
						<button type="submit" name="submit">Logout</button>
						<button id="input" type="button" onclick="location.href='/infotivCarRental/html/gui/myPage.php'">My page</button>
					</form>
				</div>
			<?php
	} else {
				?><form NAME ="FORM" ACTION="../includes/login.inc.php" method="POST">
					<div id="userInfoTop">
						<input class="inputFields" type="text" id="email" required="required" name="email" placeholder="E-mail">
						<input class="inputFields" type="password" id="password" required="required" name="pass" pattern=".{6,}" title="Six or more characters" placeholder="Password">
					</div>
					<div id="userInfoTopBottom">
					<?php 
					if(isset($_SESSION['error'])) {
					?> <label id="signInError"><?php echo $_SESSION['error']; ?> </label> <?php
    				unset($_SESSION['error']);
					}
					?>
						<button type="submit" name="submit">Login</button>
						<button id="input" type="button" onclick="location.href='/infotivCarRental/html/gui/userRegistration.php'">Create user</button>
					</div>
				</form>
				<?php
			}
				?>
			</div>
		</div>
	</div>
</header>
<body>
<div id="mainWrapperBody">
	<div id="leftpane"></div>
	<div id="middlepane">
		<div id="tripQuestion">
			<h1 id="questionText">When do you want to make your trip?</h1>
		</div>
		<FORM NAME ="form1" METHOD ="POST" ACTION = "/infotivCarRental/html/cookies/setCookiesDate.php">
			<div id="dateSelection">
				<input type="date" id="start" name="start" value="" min="" max="" onchange="updateLimit()" required = "required" title="Please input a valid date" pattern="[0-9]">
				<input type="date" id="end" name="end" value="" min="" max="" required="required" title="Please input a valid date" pattern="[0-9]">			
			</div>
			<div id="dateButtons">
				<button class="bigButton" id="input" type="button" onclick="location.href='/infotivCarRental/html/gui/index.php'">Reset</button>
				<button class="bigButton" type="submit" Name = "submit">Continue</button>
			</div>
		</form>
	</div>
	<div id="rightpane"></div>
</div>
</body>
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
</html>