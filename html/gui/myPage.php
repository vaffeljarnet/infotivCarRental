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
<table style="width:50%">

<tbody>
 
<th>orderID</th> 
<th>Brand</th> 
<th>Model</th> 
<th>Booked from</th> 
<th>Until</th> 
<th>Passengers</th> 
<th>License Number</th>
<th>Unbook car for</th>

<?php
//checks if user is logged in to an admin account, if true then redirect to adminPage.
if(isset($_SESSION['u_admin'])) {
header('Location: adminPage.php');
exit();
}
	
//checks if user is logged in, if NOT then return to index.
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
				<td><?php echo $row['orderID'];?></td>
				<td><?php echo $row['make'];?></td>
				<td><?php echo $row['model'];?></td>
				<td><?php echo $row['startDate'];?></td>
				<td><?php echo $row['endDate'];?></td>
				<td><?php echo $row['passengers'];?></td>
				<td><?php echo $row['licenseNumber'];?></td>
				<td><FORM id ="unBook" METHOD ="POST" onsubmit="return confirmUnbook('<?php echo $row['orderID'];?>');" ACTION ="../includes/unBooking.inc.php">
					<input name="orderID" type="hidden" value="<?php echo $row['orderID'];?>">
					<button type="submit" name = "submit">Cancel booking</button>
					</FORM>
				</td>
			</tr>
		<?php   
    }
} else {
    echo "0 results";
}

?>		

<form>
<select name="users" onchange="showHistory(this.value)">
  <option value="">Hide history</option>
  <option value="<?php echo $var?>">Show history</option>
  </select>
</form>
<div id="orderHistory"><b></div>

</tbody>
</table>
</table>
</body>
<script>
	//simple confirm method that takes an argument"order id" from the form "unBook". and alerts the user of what they're trying to do.
function confirmUnbook(string) {
	var response = confirm("are you sure you want cancel Order No: "+string+"??");
	if (response == true) {
	document.getElementById("unBook").submit();
	} else {
		return false;
		exit();
	}
} 

//Ajax function, takes the user input and updates content of the div "orderHistory".
function showHistory(str) {
    if (str == "") {
    	//if str is empty then return "".
        document.getElementById("orderHistory").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
        	 //creating xmlhttp object for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            //creating xmlhttp object for code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        } 
        xmlhttp.onreadystatechange = function() {
        // Create the function to be executed when the server response is ready.
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("orderHistory").innerHTML = this.responseText;
            }
        }; //Send the request off to a file on the server
        xmlhttp.open("GET","../includes/getHistory.inc.php?q="+str,true);
        xmlhttp.send();
    }
}

</script>	
</html>
