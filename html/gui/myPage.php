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
						<input class="inputFields" type="text" id="email" required="required" name="email" placeholder="E-mail">
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
</header>
<body>

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
?>
<div id="mainWrapperBody">
	<div id="leftpane"></div>
	<div id="middlepane">
		<div id="history">
			<h1 id="historyText">My bookings!</h1>
		</div>
		<div>
			<table id="orderTable">
				<tr>
 					<th id="orderTH" class="mediumText">orderID</th> 
					<th id="orderTH" class="mediumText">Brand</th> 
					<th id="orderTH" class="mediumText">Model</th> 
					<th id="orderTH" class="mediumText">Booked from</th> 
					<th id="orderTH" class="mediumText">Until</th> 
					<th id="orderTH" class="mediumText">Passengers</th> 
					<th id="orderTH" class="mediumText">License Number</th>
					<th class="mediumText">Unbook car for</th>
				</tr>
<?php 
//Loops trough the result of the query and populates the html table on the page. 
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
			?>
				<tr>
					<td id="orderTD" class="mediumText"><?php echo $row['orderID'];?></td>
					<td id="orderTD" class="mediumText"><?php echo $row['make'];?></td>
					<td id="orderTD" class="mediumText"><?php echo $row['model'];?></td>
					<td id="orderTD" class="mediumText"><?php echo $row['startDate'];?></td>
					<td id="orderTD" class="mediumText"><?php echo $row['endDate'];?></td>
					<td id="orderTD" class="mediumText"><?php echo $row['passengers'];?></td>
					<td id="orderTD" class="mediumText"><?php echo $row['licenseNumber'];?></td>
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
			
			</table>
		</div> 
			<div id="history">
				<form>
					<select id="selectHistory" name="users" onchange="showHistory(this.value)">
 					 <option id="selectHistory" value="">Hide order history</option>
 					 <option id="selectHistory" value="<?php echo $var?>">Show order history</option>
 					 </select>
				</form>
				<div id="orderHistory"></B></div>
			</div>
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
            }
        }; //Send the request off to a file on the server
        xmlhttp.open("GET","../includes/getHistory.inc.php?q="+str,true);
        xmlhttp.send();
    }
}

</script>	
</html>
