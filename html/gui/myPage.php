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
<h3>My bookings!</h3>
<body>
<table style="width:46%">

<tbody>
 
<th>Brand</th> 
<th>Model</th> 
<th>Booked from</th> 
<th>Until</th> 
<th>Passengers</th> 
<th>License Number</th>
<th>Unbook car for</th>

<?php

if(isset($_SESSION['u_admin'])) {
header('Location: adminPage.php');
exit();
}
	




if(!isset($_SESSION['u_id'])) {
header('Location: index.php');
exit;
}

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
				<td><?php echo $row['make'];?></td>
				<td><?php echo $row['model'];?></td>
				<td><?php echo $row['startDate'];?></td>
				<td><?php echo $row['endDate'];?></td>
				<td><?php echo $row['passengers'];?></td>
				<td><?php echo $row['licenseNumber'];?></td>
				<td><FORM id ="unBook" METHOD ="POST" onsubmit="return <?php echo 'confirmUnbook();'?>" ACTION ="../includes/unBooking.inc.php">
					<input name="orderID" type="hidden" value="<?php echo $row['orderID'];?>">
					<button type="submit" name = "submit"><?php echo $row['startDate'];?></button>
					</FORM>
				</td>
			</tr>
		<?php   
    }
} else {
    echo "0 results";
}
$conn->close();
?>		


<script>
function confirmUnbook() {
	var response = confirm("are you sure you want to unbook this car?");
	if (response == true) {
	document.getElementById("unBook").submit();
	} else {
		return false;
		exit();
	} 
/*var carVar = "'example Car'";
var testStart = "'2018-09-24'";
var testEnd = "'2018-09-24'";
var data = [{'startDate':testStart,'endDate':testEnd}];
var alertText = "Are you sure you want to unbook "+carVar+" for these times?\n"
	for(var i in data) {
    alertText += data[i].startDate+ " to "+ data[i].endDate +"\n";
	}
	var response = confirm( alertText );
	if (response == true) {
	document.getElementById("unBook").submit();
	} else {
		return false;
		exit();
	} */
} 


</script>	

</tbody>
</table>
</table>
</body>
</html>
