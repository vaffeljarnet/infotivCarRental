<?php 
session_start()

 ?>


<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link rel="stylesheet" type="text/css" href="/infotivCarRental/html/styling/styling.css"> 
</head>	
<header>
	<!--Imports the header from getHeader.inc.php by including it with php-->
	<?php include_once '../includes/getHeader.inc.php'; ?>
</header>
<body onload="alternate('currentOrderTable');">

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

//A query for selecting all cars that are connected to the users ID.
$sql = "SELECT bookings.*, cars.*, users.* FROM bookings JOIN cars ON bookings.licenseNumber = cars.licenseNumber JOIN users ON users.user_id = bookings.user_id ORDER BY bookings.orderID;";
$result = $conn->query($sql);


?>
<div id="mainWrapperBody">
	<div id="leftpane"></div>
	<div id="middlepane">
		<div id="admin">
			<h1 id="adminText">Admin control</h1>
		</div>
<?php
if(isset($_SESSION['u_admin'])) {
?>
	<div id="adminControl">
		<button id="input" type="button" value="addCar" onclick="location.href='../admin/carRegistration.php'">Add new car</button>
		<button onclick="return confirm('Warning proceeding will remove all bookings!')" type="button" value="addCar" onclick="location.href='../admin/deleteBookings.php'">Delete all bookings</button>

		<input name="users" placeholder="Find user info" onchange ="showUser(this.value)">
	</div>
		<div id="showUser"><br></div>
<?php	
}	?>
		<div id="currentOrders">
			<h1 id="historyText">Current orders</h1>
		</div>
			<table class="currentOrderTable">
				<th class="orderTD">order id</th>
				<th class="orderTD">License</th> 
				<th class="orderTD">Make</th> 
				<th class="orderTD">Model</th> 
				<th class="orderTD">Passengers</th> 
				<th class="orderTD">Booked from</th> 
				<th class="orderTD">Until</th> 
		<?php	/*	<th class="orderTD">First</th>
				<th class="orderTD">Last</th>*/ ?>
				<th class="orderTD">Order completed</th>
<?php
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
	<?php	/*		<td><?php echo $row['user_first'];?></td>
				<td><?php echo $row['user_last'];?></td>   */ ?>
				<?php //form for sending info about the booking to unBooking.inc.php  ?>
				<td><div class="formOrders"><FORM id ="unBook" METHOD ="POST" onsubmit="return confirmUnbook('<?php echo $row['orderID'];?>');" ACTION ="../includes/unBooking.inc.php">
					<input name="orderID" type="hidden" value="<?php echo $row['orderID'];?>">
					<input name="licenseNumber" type="hidden" value="<?php echo $row['licenseNumber'];?>">
					<input name="startDate" type="hidden" value="<?php echo $row['startDate'];?>">
					<input name="endDate" type="hidden" value="<?php echo $row['endDate'];?>">
					<input name="user_id" type="hidden" value="<?php echo $row['user_id'];?>">
					<button type="submit" name = "submit">Complete order</button>
					</FORM>
					</div>
				</td>
			</tr>
		<?php   
    }
} else {
    echo "0 results";
}
$conn->close();
?>		
			</table>
	</div>
	<div id="rightpane"></div>
</div>
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
        document.getElementById("showUser").innerHTML = "";
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
                document.getElementById("showUser").innerHTML = this.responseText;
            }
        };  //Send the request off to a file on the server
        xmlhttp.open("GET","../includes/getUserInfo.inc.php?q="+str,true);
        xmlhttp.send();
    }
}
function alternate(classNameMatch) {
    var tables = document.getElementsByTagName("table");
    for (var i=0; i < tables.length; i++) {
        var table = tables[i];
        if (table.className.indexOf(classNameMatch) == -1) continue;

        for (var j=0; j < table.rows.length; j++) { // "TABLE" elements have a "rows" collection built-in
            table.rows[j].className = j % 2 == 0 ? "orderTD" : "orderTDg";
        }
    }
}

function showUser(str) {
    if (str == "") {
    	//if str is empty then return ""
        document.getElementById("showUser").innerHTML = "";
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
                document.getElementById("showUser").innerHTML = this.responseText;
            }
        };  //Send the request off to a file on the server
        xmlhttp.open("GET","../includes/getUserInfo.inc.php?q="+str,true);
        xmlhttp.send();
    }
}


</script>	
</html>