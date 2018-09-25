<?php
	session_start();
	$cookie_name = "previousLocation";
	$cookie_value = "confirmBook";
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
	<!---Inputs the logo and title of hompage to the left in the header-->
		<a href="/infotivCarRental/html/gui/index.php">
			<div id="leftHeader">
				<div class="logo" id="logo">&nbsp;</div>
				<div class="title" id="title">
					<h1 id="title">Infotiv Car Rental</h1>
				</div>
			</div>
		</a>
		<div id="rightHeader">
		<!---Inputs the About button to the left in the right part of the header-->
			<div id="categories">
				<a class="categoryText" href="/infotivCarRental/html/gui/about.php">ABOUT</a>
			</div>
		<!---If user is logger in, inputs welcome phrase and buttons for logout and my page.
		If not logged in, inputs email and password field, and log in and create user buttons.-->
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
					<!---If wrong information is given on sign in, appropriate error message is printed-->
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
	<!-- Prints confirmation  message with collected cookie for the selected make, model
	and the selected start and end dates.-->
		<div id="confirmQuestion">
			<h1 id="questionText">Confirm booking of <?php echo $_COOKIE['selectedMake']." ".$_COOKIE['selectedModel']; ?></h1></br>
			<label class="mediumText" for="start">Pickup date: <?php echo $_COOKIE['startDate'] ?></label>
			<label class="mediumText" for="start">Return date: <?php echo $_COOKIE['endDate'] ?></label></br>
		</div>
		<!-- Inputs buttons for canceling the booking and confirming it. If confirm button
		is pressed and user is not signed in, the booking will not be possible.-->
		<div id="confirmSelection">
			<form action="/infotivCarRental/html/gui/updateAvailability.php" method="GET">
<?php
			?><button class="bigButton" id="input" type="button" onclick="location.href='showCars.php'">Cancel</button><?php
			if(isset($_SESSION['u_id'])) {
				?><button class="bigButton" type="Submit">Confirm</button><?php
			} else {
				?><button class="bigButton" type="button" onclick="pls();">Confirm</button><?php
			}
		?>
			</form>
		</div>
	</div>
	<div id="rightpane"></div>
</div>		

</body>

<script>
    function pls(){
        alert("You need to be logged in to book a car.");
    }
</script>

</html>