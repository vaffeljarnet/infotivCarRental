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
	<!--Imports the header from getHeader.inc.php by including it with php-->
	<?php include_once '../includes/getHeader.inc.php'; ?>
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
						<input class="bigInputFields" type="phone" required="required" name="phone" pattern="+[0-9]" placeholder="Phonenumber"><br>
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