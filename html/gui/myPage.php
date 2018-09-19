<?php 
session_start()
 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
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
								<input type="email" id="email" required="required" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" placeholder="E-mail">
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
<h3>My bookings!</h3>
<body>
<table style="width:40%">

<tbody>

<th>License Number </th> 
<th>Brand</th> 
<th>Model</th> 
<th>Passengers</th> 
<th>Booked from</th> 
<th>Until</th> 

<?php


include_once '../includes/dbh.inc.php';

if(isset($_SESSION['u_id'])) {
	$var = $_SESSION['u_id'];
}

//A query for selecting all cars that are connected to the users ID.
$sql = "SELECT cars.*, bookings.* FROM cars LEFT JOIN bookings on cars.licenseNumber = bookings.licenseNumber WHERE bookings.user_id='".$var."'";
$result = $conn->query($sql);


//Loops trough the result of the query and populates the html table on the page. 
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
			?>
			<tr>
				<td><?php echo $row['licenseNumber'];?></td>
				<td><?php echo $row['make'];?></td>
				<td><?php echo $row['model'];?></td>
				<td><?php echo $row['passengers'];?></td>
				<td><?php echo $row['startDate'];?></td>
				<td><?php echo $row['endDate'];?></td>
			</tr>
		<?php
    }
} else {
    echo "0 results";
}
$conn->close();
?>
</tbody>
</table>
</table>
</body>
</html>
