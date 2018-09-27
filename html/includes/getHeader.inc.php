
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
					<input class="inputFields" type="email" id="email" required="required" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" placeholder="E-mail">
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
