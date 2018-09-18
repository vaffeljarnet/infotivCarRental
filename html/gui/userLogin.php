<?php 
session_start()
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
   <link rel="stylesheet" type="text/css" href="style.css">
<header>
	<nav>
		<div class="main-wrapper">
			<ul>
				<a href="index.php">Home</a>
			</ul>
			<?php
				if(isset($_SESSION['u_id'])) {
					echo '<div class="nav-login">
							"You are now logged in!"
						 "<form NAME ="logOut" ACTION="../includes/logout.inc.php" method="POST">
								<button type="submit" name="submit">Logout</button>
								</form>";
							
					</div>';

				} else {
					echo '<div class="nav-login">
							<form NAME ="FORM" ACTION="../includes/login.inc.php" method="POST">
							<input type="email" id="email" required="required" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" placeholder="E-mail">
							<input type="password" id="password" required="required" name="pass" pattern=".{6,}" title="Six or more characters" placeholder="Password">
							<br>
							<button type="submit" name="submit">Login</button>
							</form>
							<a href="userRegistration.php">Create user</a>
						</div>';					

				}
			?>
		</div>
</head>

<body>





</body>
</html>