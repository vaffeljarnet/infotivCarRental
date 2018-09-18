<?php 
session_start()
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>

	<h2>
		<?php
			if(isset($_SESSION['u_id'])) {
				echo "You are now logged in!";
				echo '<form NAME ="logOut" ACTION="../includes/logout.inc.php" method="POST">
				<button type="submit" name="submit">Logout</button>
				</form>';
			} else {
				echo '			<form NAME ="logIn" ACTION="../includes/login.inc.php" method="POST">
				<input type="email" id="email" required="required" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" placeholder="E-mail">
				<input type="password" id="password" required="required" name="pass" pattern=".{6,}" title="Six or more characters" placeholder="Password">
				<br>
				<button type="submit" name="submit">Login</button>
				<button onclick="location.href="index.php" class="selectBtn">Home</button><br>

			</form>';
			}
		?>
	</h2>


</body>
</html>