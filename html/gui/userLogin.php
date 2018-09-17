<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>
<form NAME ="FORM" ACTION="../includes/login.inc.php" method="POST">
				<input type="email" id="email" required="required" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" placeholder="E-mail">
				<input type="password" id="password" required="required" name="pass" pattern=".{6,}" title="Six or more characters" placeholder="Password">
				<br>
				<button type="submit" name="submit">Login</button>
				<button onclick="location.href='index.php'" class="selectBtn">Home</button>

			</form>
</body>
</html>