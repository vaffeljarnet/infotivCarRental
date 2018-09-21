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
<link rel="stylesheet" type="text/css" href="styleTest.css"> 
</head>	
<header>
	<div id="headerWrapper">
		<div id="leftHeader">
				<h1 id="title">Infotiv Car Rental</h1>
		</div>
		<div id="rightHeader">
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
						<button id="input" type="button" onclick="location.href='myPage.php'">My page</button>
					</form>
				</div>
			<?php
	} else {
				?><form NAME ="FORM" ACTION="../includes/login.inc.php" method="POST">
					<div id="userInfoTop">
						<input type="email" id="email" required="required" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" placeholder="E-mail">
						<input type="password" id="password" required="required" name="pass" pattern=".{6,}" title="Six or more characters" placeholder="Password">
					</div>
					<div id="userInfoTopBottom">
						<button type="submit" name="submit">Login</button>
						<button id="input" type="button" onclick="location.href='userRegistration.php'">Create user</button>
					</div>
				<?php 
					if(isset($_SESSION['error'])) {
					?> <label id="signInError"><?php echo $_SESSION['error']; ?> </label> <?php
    				unset($_SESSION['error']);
					}
				?></form>
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
	<!-- Prints confirmation  message with collected cookie for the selected make and model.-->
		<div id="showQuestion">
			<h1 id="questionText">Confirm booking of <?php echo $_COOKIE['selectedMake']." ".$_COOKIE['selectedModel']; ?></h1></br>
			<label class="mediumText" for="start">Pickup date: <?php echo $_COOKIE['startDate'] ?></label>
			<label class="mediumText" for="start">Return date: <?php echo $_COOKIE['endDate'] ?></label></br>
		</div>
		<div id="carSelection">
			<form action="/infotivCarRental/html/dbConnection/updateAvailability.php" method="GET">
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
		<div id="backToDate"></div>
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