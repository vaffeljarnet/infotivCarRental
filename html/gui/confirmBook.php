<?php 
	session_start();
	$cookie_name = "previousLocation";
	$cookie_value = "confirmBook";
	setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
 ?>
<!DOCTYPE html>
<html>
<head>
	 <script>
        function pls(){
              alert("You need to be logged in to book a car.");
           }
    </script>
	<title>Confirmation</title>
    <link type="text/css" href="style.css">
	<header>
		<nav>

			<div class="main-wrapper">
				<ul>
					<a href="index.php" style="float:right" >Home</a>
				</ul>
				<?php
					if(isset($_SESSION['u_id'])) {
						echo '<div class="nav-login" style="float:right">
								You are logged in!
							 	<form NAME ="logOut" ACTION="../includes/logout.inc.php" method="POST">
									<button type="submit" name="submit">Logout</button>'  ?>
									<button id="input" type="button" value="Create new user" onclick="location.href='myPage.php'">My page</button>
									<?php
									echo 
									'</form>	
							</div>';
					} else {
						echo '<div class="nav-login" style="float:right">
								<form NAME ="FORM" ACTION="../includes/login.inc.php" method="POST">
								<input type="text" id="email" required="required" name="email" placeholder="E-mail">
								<input type="password" id="password" required="required" name="pass" pattern=".{6,}" title="Six or more characters" placeholder="Password">
								<br>
								<button type="submit" name="submit">Login</button>'  ?>
								<button id="input" type="button" value="Create new user" onclick="location.href='userRegistration.php'">Create new user</button>
									<?php 
										if(isset($_SESSION['error'])) {
										echo $_SESSION['error'];
    									unset($_SESSION['error']);
										}
									 echo '
								</form>							
							</div>';					
					}
				?>
			</div>
		</nav>
	</header>
</head>

<!-- Prints confirmation  message with collected cookie for the selected make and model.-->

	<h3>Confirm booking of <?php echo $_COOKIE['selectedMake']." ".$_COOKIE['selectedModel']; ?></h3>
	<label for="start">Pickup date: <?php echo $_COOKIE['startDate'] ?></label></br>
	<label for="start">Return date: <?php echo $_COOKIE['endDate'] ?></label></br>
	<label for="start">License Number: <?php echo $_COOKIE['selectedLicenseNumber'] ?></label></br>
	
<body>
<!-- Adds a confirmation button that triggers the updateAvailability.php script-->
	<form action="/infotivCarRental/html/dbConnection/updateAvailability.php" method="GET">
	<?php
				if(isset($_SESSION['u_id'])) {
					echo '<form action="/infotivCarRental/html/dbConnection/updateAvailability.php" method="GET">
							<input type="Submit" value="Confirm">';
				} else {
				?>	<input id="funka" type="button" value="Confirm" onclick="pls();" />	<?php
				}
	?>
		<input id="input" type="button" value="Cancel Booking" onclick="location.href='showCars.php'" />
		
	</form>

</body>
</html>