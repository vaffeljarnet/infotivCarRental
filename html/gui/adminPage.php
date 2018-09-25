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
								Welcome oh Admin my Admin!
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
<body>
<table style="width:51%">

<h3>Admin control</h3>

<?php

if(isset($_SESSION['u_admin'])) {

?>	

	<button id="input" type="button" value="addCar" onclick="location.href='../admin/carRegistration.php'">Add new car</button>
	<button onclick="return confirm('Warning proceeding will remove all bookings!')" type="button" value="addCar" onclick="location.href='../admin/deleteBookings.php'">Delete all bookings</button>

	<input name="users" placeholder="Find user info" onchange ="showUser(this.value)">
	<div id="userInfo"><b></div>

<?php	
}
?>

<tbody>

<th>order id</th>
<th>License</th> 
<th>Make</th> 
<th>Model</th> 
<th>Passengers</th> 
<th>Booked from</th> 
<th>Until</th> 
<th>First</th>
<th>Last</th>
<th>Order completed</th>


<?php

if(!isset($_SESSION['u_admin'])) {
header('Location: index.php');
exit;
}

if(!isset($_SESSION['u_id'])) {
header('Location: index.php');
exit;
}

include_once '../includes/dbh.inc.php';

if(isset($_SESSION['u_id'])) {
	$var = $_SESSION['u_id'];
}
?>

<h1>Current orders</h1>
<?php
//A query for selecting all cars that are connected to the users ID.
$sql = "SELECT bookings.*, cars.*, users.* FROM bookings JOIN cars ON bookings.licenseNumber = cars.licenseNumber JOIN users ON users.user_id = bookings.user_id ORDER BY bookings.orderID;";
$result = $conn->query($sql);

//Loops trough the result of the query and populates the html table on the page. 
if ($result->num_rows > 0) {

    // output data of each row
    while($row = $result->fetch_assoc()) {
			?>
			<tr>
				<td><?php echo $row['orderID'];?></td>
				<td><?php echo $row['licenseNumber'];?></td>
				<td><?php echo $row['make'];?></td>
				<td><?php echo $row['model'];?></td>
				<td><?php echo $row['passengers'];?></td>
				<td><?php echo $row['startDate'];?></td>
				<td><?php echo $row['endDate'];?></td>
				<td><?php echo $row['user_first'];?></td>
				<td><?php echo $row['user_last'];?></td>
				<?php //form for sending info about the booking to unBooking.inc.php  ?>
				<td><FORM id ="unBook" METHOD ="POST" onsubmit="return confirmUnbook('<?php echo $row['orderID'];?>');" ACTION ="../includes/unBooking.inc.php">
					<input name="orderID" type="hidden" value="<?php echo $row['orderID'];?>">
					<input name="licenseNumber" type="hidden" value="<?php echo $row['licenseNumber'];?>">
					<input name="startDate" type="hidden" value="<?php echo $row['startDate'];?>">
					<input name="endDate" type="hidden" value="<?php echo $row['endDate'];?>">
					<input name="user_id" type="hidden" value="<?php echo $row['user_id'];?>">
					<button type="submit" name = "submit">Complete order</button>
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



</tbody>
</table>
</table>
</body>
<script>
	//simple confirm method that takes an argument"order id" from the form "unBook". and alerts the user of what they're trying to do.
function confirmUnbook(string) {
 	var r = confirm("Are you sure car from order No: " +string+ " has been returned and payed for?");
 	if (r == true) {
    document.getElementById("unBook").submit();
  	} else {
    return false;
  	exit();
	}
}
//Ajax function, takes the user input and updates content of the div "userInfo".
function showUser(str) {
    if (str == "") {
    	//if str is empty then return ""
        document.getElementById("userInfo").innerHTML = "";
        return;
    } else { 
 		//creating xmlhttp object for IE7+, Firefox, Chrome, Opera, Safari
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            //creating xmlhttp object for code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        } 
        // will come back for clarification.
        xmlhttp.onreadystatechange = function() {
        // Create the function to be executed when the server response is ready.
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("userInfo").innerHTML = this.responseText;
            }
        };  //Send the request off to a file on the server
        xmlhttp.open("GET","../includes/getUserInfo.inc.php?q="+str,true);
        xmlhttp.send();
    }
}

</script>	
</html>
