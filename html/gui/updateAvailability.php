<?php
	session_start();
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
						<input class="inputFields" type="email" id="email" required="required" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" placeholder="E-mail">
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
<?php

if($_COOKIE['previousLocation'] == "confirmBook"){
	
	if(!isset($_COOKIE['selectedLicenseNumber']) 
	|| !isset($_COOKIE['selectedMake'])
	|| !isset($_COOKIE['selectedModel']) 
	|| !isset($_COOKIE['startDate']) 
	|| !isset($_COOKIE['endDate'])
	|| !isset($_SESSION['u_id'])){
		
		echo "";
		
		?>
	<div id="mainWrapperBody">
		<div id="leftpane"></div>
		<div id="middlepane">
			<div id="confirmMessage">
				<h1 id="questionText">Booking incomplete, please try again from start.</h1>
			</div>
			<div id="backToStart">
				<button class="bigButton" onclick="location.href='/infotivCarRental/html/gui/index.php'" class="selectBtn">Home</button>
			</div>
		</div>
		<div id="rightpane"></div>
	</div>
		<?php
		
	}else{
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
		//Sends a sql query to insert new entryin table bookings for the car selected
		//in showCars.phtml using the previously stored selectedLicenseNumber cookie.

		$sql = "INSERT INTO bookings (licenseNumber, startDate, endDate, user_id) VALUES 
				('".$_COOKIE['selectedLicenseNumber']."' , 
				'".$_COOKIE['startDate']."' , 
				'".$_COOKIE['endDate']."' ,
				'".$_SESSION['u_id']."');";
				
			if ($conn->query($sql) === TRUE) {
				?>
	<div id="mainWrapperBody">
		<div id="leftpane"></div>
			<div id="middlepane">
				<div id="confirmMessage">
					<h1 id="questionTextSmall">A <?php echo $_COOKIE['selectedMake']." ".$_COOKIE['selectedModel']; ?> is now ready for pickup <?php echo $_COOKIE['startDate']; ?></h1>
					</br>
					<label class="mediumText">You can view your booking on your page</label>
				</div>
				<div id="backToStart">
					<button class="bigButton" onclick="location.href='/infotivCarRental/html/gui/index.php'" class="selectBtn">Home</button>
					<button class="bigButton" onclick="location.href='myPage.php'">My page</button>
				</div>
			</div>
			<div id="rightpane"></div>
	</div>
		<?php
			} else {
				?>
	<div id="mainWrapperBody">
		<div id="leftpane"></div>
			<div id="middlepane">
				<div id="confirmMessage">
					<h1 id="questionTextSmall">Unfortunately there was an error in your booking. Try again, and please report the error bellow to the support if errors persists.</h1>
					<label class="mediumText">Error: <?php echo $sql . $conn->error;?></label>
				</div>
				<div id="backToStart">
					<button class="bigButton" onclick="location.href='/infotivCarRental/html/gui/index.php'" class="selectBtn">Home</button>
				</div>
			</div>
			<div id="rightpane"></div>
	</div>
		<?php
				echo "Error: " . $sql . "<br>" . $conn->error;
			}

		$conn->close();	
		
		setcookie('selectedLicenseNumber', null, -1, "/");
		setcookie('selectedMake', null, -1, "/");
		setcookie('selectedModel', null, -1, "/");
		setcookie('startDate', null, -1, "/");
		setcookie('endDate', null, -1, "/");
	}	
}else{
	?>
	<div id="mainWrapperBody">
		<div id="leftpane"></div>
		<div id="middlepane">
			<div id="confirmMessage">
				<h1 id="questionTextSmall">You seem to have gotten to this page by mistake. Please go back to start and try again.</h1>
			</div>
			<div id="backToStart">
				<button class="bigButton" onclick="location.href='/infotivCarRental/html/gui/index.php'" class="selectBtn">Home</button>
			</div>
		</div>
		<div id="rightpane"></div>
	</div>
	<?php
}
?>
</body>
</html>