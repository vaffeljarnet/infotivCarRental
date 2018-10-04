<?php  
session_start()

 ?>


<!DOCTYPE html>
<html>
<head>
<title>Mypage</title>
<link rel="stylesheet" type="text/css" href="/infotivCarRental/html/styling/styling.css"> 
</head>	
<header>
	<!--Imports the header from getHeader.inc.php by including it with php-->
	<?php include_once '../includes/getHeader.inc.php'; ?>
</header>
<body onload="alternate('orderTable');">

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
$sql = "SELECT cars.*, bookings.* FROM cars LEFT JOIN bookings on cars.licenseNumber = bookings.licenseNumber WHERE bookings.userID='".$var."'";
$result = $conn->query($sql);
?>
<div id="mainWrapperBody">
	<div id="leftpane"></div>
	<div id="middlepane">

				
<?php 
$id=1;
//Loops trough the result of the query and populates the html table on the page. 
if ($result->num_rows > 0) {?>

			<div id="history">
				<h1 id="historyText">My bookings</h1>
			</div>

				<table class="orderTable">
 					<th class="orderTD">orderID</th> 
					<th class="orderTD">Brand</th> 
					<th class="orderTD">Model</th> 
					<th class="orderTD">Booked from</th> 
					<th class="orderTD">Until</th> 
					<th class="orderTD">Passengers</th> 
					<th class="orderTD">License Number</th>
					<th class="mediumTextCenter">Unbook car for</th>	<?php
    // output data of each row
    while($row = $result->fetch_assoc()) {
			?>
				<tr>
					<td id="order<?php echo $id;?>"><?php echo $row['orderID'];?></td>
					<td id="make<?php echo $id;?>"><?php echo $row['make'];?></td>
					<td id="model<?php echo $id;?>"><?php echo $row['model'];?></td>
					<td id="startDate<?php echo $id;?>"><?php echo $row['startDate'];?></td>
					<td id="endDate<?php echo $id;?>"><?php echo $row['endDate'];?></td>
					<td id="passengers<?php echo $id;?>"><?php echo $row['passengers'];?></td>
					<td id="licenseNumber<?php echo $id;?>"><?php echo $row['licenseNumber'];?></td>
					<td style="background-color: white">
						<FORM id="unBook" METHOD ="POST" onsubmit="return confirmUnbook('<?php echo $row['orderID'];?>');" ACTION ="../includes/unBooking.inc.php">
							<input name="orderID" type="hidden" value="<?php echo $row['orderID'];?>">
							<button id ="unBook<?php echo $id;?>" type="submit" name = "submit">Cancel booking</button>
						</FORM>
					</td>
					
				</tr>
		<?php   
	$id++;	
    }
} else {
    ?>	<div id="history">
			<h1 id="historyText">You have no bookings</h1>
		</div><?php
}
?>	
			</table>
			<div id="historyButton">	
						<button id="hide" type="submit" onclick="showHistory(this.value)">Hide history</button>			
 						<button id="show" type="submit" value="<?php echo $var?>" onclick="showHistory(this.value);">Show history</button>				
 			</div>
 				<div id="orderHistory"></B></div>		
	</div>
	<div id="rightpane"></div>
</div>
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
                alternate('historyTable');
            }
        }; //Send the request off to a file on the server
        xmlhttp.open("GET","../includes/getHistory.inc.php?q="+str,true);
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

</script>	
</html>
