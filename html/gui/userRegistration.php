<?php 
	session_start();
	$cookie_name = "previousLocation";
	$cookie_value = "userRegistration";
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
		<div id="aboutHeading">
			<h1 id="questionText">Create a new user</h1>
		</div>	
			<form onSubmit="return validate();" NAME ="FORM" ACTION="../includes/registration.inc.php" method="POST">		
				<div id="mainText">
					
						<input class="bigInputFields" type="text" required="required" name="firstName" placeholder="First name"><br>
						<input class="bigInputFields" type="text" required="required" name="lastName" placeholder="Last name"><br>
						<input class="bigInputFields" type="tel" required="required" name="phone" pattern="+[0-9]" placeholder="Phonenumber"><br>
						<input class="bigInputFields" type="email" id="emailCreate" required="required" name="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-z]{2,3}$" placeholder="E-mail">
						<input class="bigInputFields" type="email" id="confirmEmail" required="required" name="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-z]{2,3}$" placeholder="Confirm E-mail"><br>
						<input class="bigInputFields" type="password" id="passwordCreate" required="required" name="pass" pattern=".{6,}" title="Six or more characters" placeholder="Password">
						<input class="bigInputFields" type="password" id="confirmPassword" required="required" name="passConfirm" pattern=".{6,}" title="Six or more characters" placeholder="Confirm Password"><br><br>		
						<?php 
							if(isset($_SESSION['errorCreate'])) {
								?> <label id="signInError"><?php echo $_SESSION['errorCreate']; ?> </label> <?php
								unset($_SESSION['errorCreate']);
							}
						 ?>
				</div>
				<div id="versionNr">
					<button class="bigButton" type="submit" name="submit">Create</button>
					<button class="bigButton" onclick="location.href='/infotivCarRental/html/gui/index.php'">Cancel</button>	
				</div>
			</form>
	</div>
	<div id="rightpane"></div>
	</div>
</body>
	<script>
        function validate(){
            var a = document.getElementById("passwordCreate").value;
            var b = document.getElementById("confirmPassword").value;
            if (a!=b) {
               alert("Passwords doesn't match");
               return false;
            } else {
            	var c = document.getElementById("emailCreate").value;
            	var d = document.getElementById("confirmEmail").value;
            if (c!=d) {
               alert("Email doesn't match");
               return false;
            }
            }
        }
     </script> 
</html>