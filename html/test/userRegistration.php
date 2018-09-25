<?php 
session_start()
 ?>
<!DOCTYPE html>
<html>
<head>
	    <script>
        function validate(){
            var a = document.getElementById("password").value;
            var b = document.getElementById("confirmPassword").value;
            if (a!=b) {
               alert("Passwords doesn't match");
               return false;
            } else {
            	var c = document.getElementById("email").value;
            	var d = document.getElementById("confirmEmail").value;
            if (c!=d) {
               alert("Email doesn't match");
               return false;
            }
            }
        }
     </script>
	<title>User creation</title>
</head>
<body>
<header>
	<nav>
		<div>
			<form onSubmit="return validate();" NAME ="FORM" ACTION="../includes/registration.inc.php" method="POST">
				<input type="text" required="required" name="firstName" placeholder="First name"><br>
				<input type="text" required="required" name="lastName" placeholder="Last name"><br>
				<input type="tel" required="required" name="phone" pattern="+[0-9]" placeholder="Phonenumber"><br>
				<input type="email" id="email" required="required" name="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-z]{2,3}$" placeholder="E-mail">
				<input type="email" id="confirmEmail" required="required" name="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-z]{2,3}$" placeholder="Confirm E-mail"><br>
				<input type="password" id="password" required="required" name="pass" pattern=".{6,}" title="Six or more characters" placeholder="Password">
				<input type="password" id="confirmPassword" required="required" name="passConfirm" pattern=".{6,}" title="Six or more characters" placeholder="Confirm Password"><br>
				<button type="submit" name="submit">Create user</button>
				<input id="input" type="button" value="Cancel Registration" onclick="location.href='index.php'" />				
				<br>
				<?php 
					if(isset($_SESSION['error'])) {
						echo $_SESSION['error'];
    					unset($_SESSION['error']);
					}
				 ?>

			</form>
		</div>
	</nav>
</header>
<section>
	
</section>
</body>
</html>