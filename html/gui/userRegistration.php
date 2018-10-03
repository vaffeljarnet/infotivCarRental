<?php 
	session_start();
	$cookie_name = "previousLocation";
	$cookie_value = "userRegistration";
	setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
 ?>
 
<!DOCTYPE html>
<html>
<head>
<title>Create user</title>
<link rel="stylesheet" type="text/css" href="/infotivCarRental/html/styling/styling.css">
</head>	
<header>
	<!--Imports the header from getHeader.inc.php by including it with php-->
	<?php include_once '../includes/getHeader.inc.php'; 
	//checks if user is logged in, if NOT then return to index.
	if(isset($_SESSION['u_id'])) {
	header('Location: index.php');
	exit;
	}
	?>
</header>
<body>

<div id="mainWrapperBody">
	<div id="leftpane"></div>
	<div id="middlepane">
		<div id="aboutHeading">
			<h1 id="questionText">Create a new user</h1>
		</div>	
			<form NAME ="FORM" ACTION="../includes/registration.inc.php" method="POST">		
				<div id="mainText">
					
						<input id="name" class="bigInputFields" type="text" required="required" name="firstName" pattern="[a-zA-Z]{2,30}" title="only characters a-Z allowed" placeholder="First name" value="<?php echo $_SESSION['firstNamePH'];?>"><br>
						<input id="last" class="bigInputFields" type="text" required="required" name="lastName" pattern="[a-zA-Z]{2,30}" title="only characters a-Z allowed" placeholder="Last name" value="<?php echo $_SESSION['lastNamePH'];?>"><br>
						<input id="phone" class="bigInputFields" type="phone" required="required" name="phone" pattern="[0-9]{10,13}" title="only numbers, 10-13characters, 00 for +." placeholder="Phonenumber" value="<?php echo $_SESSION['phonePH'];?>"><br>
						<input class="bigInputFields" type="email" id="emailCreate" required="required" name="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-z]{2,3}$" title="Characters@email.boi" placeholder="E-mail" value="<?php echo $_SESSION['emailPH'];?>">
						<input class="bigInputFields" type="email" id="confirmEmail" required="required" name="emailCon" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-z]{2,3}$" title="Characters@email.boi" placeholder="Confirm E-mail" value="<?php echo $_SESSION['emailPH'];?>"><br>
						<input class="bigInputFields" type="password" id="passwordCreate" required="required" name="pass" pattern=".{6,}" title="Six or more characters" placeholder="Password">
						<input class="bigInputFields" type="password" id="confirmPassword" required="required" name="passCon" pattern=".{6,}" title="Six or more characters" placeholder="Confirm Password"><br><br>		
						<?php 
							if(isset($_SESSION['errorCreate'])) {
								?> <label id="signInError"><?php echo $_SESSION['errorCreate']; ?> </label> <?php
								unset($_SESSION['errorCreate']);
							}
							if (isset($_POST['submit'])) { 
 								$_SESSION['firstNamePH'] = $_POST['firstName'];
 								$_SESSION['lastNamePH'] = $_POST['lastName'];
 								$_SESSION['phonePH'] = $_POST['phone'];
					 			$_SESSION['emailPH'] = $_POST['email'];
 							} 

						 ?>
				</div>
				<div id="versionNr">
					<button id="cancel" class="bigButton" type="button" onclick="location.href='/infotivCarRental/html/gui/index.php'">Cancel</button>
					<button id="create" class="bigButton" type="submit" name="submit">Create</button>
					
				</div>
			</form>
	</div>
	<div id="rightpane"></div>
	</div>
</body>
</html>