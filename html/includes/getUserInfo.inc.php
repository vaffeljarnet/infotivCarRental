<?php
$q = intval($_GET['q']);

include_once 'dbh.inc.php';
//sql query that joins the tables users and bookings where there are matching user id,s and stores it in a variable.
$sql="SELECT users.*, bookings.* FROM users LEFT JOIN bookings on users.userID = bookings.userID WHERE bookings.orderID = '".$q."' UNION SELECT users.*, orderhistory.* FROM users LEFT JOIN orderhistory on users.userID = orderhistory.userID WHERE orderhistory.orderID = '".$q."';";
$result = mysqli_query($conn, $sql);
/*$sql="SELECT users.*, bookings.* FROM users LEFT JOIN bookings on users.userID = bookings.userID WHERE bookings.orderID = '".$q."';";
$result = mysqli_query($conn, $sql); */

/* $sql="SELECT DISTINCT users.*, bookings.*, orderhistory.* FROM users JOIN bookings on users.user_id = bookings.user_id JOIN orderhistory on users.user_id = orderhistory.user_id WHERE bookings.orderID = '".$q."' OR orderhistory.orderID = '".$q."'  LIMIT 1;";
$result = mysqli_query($conn, $sql); */


if ($result->num_rows > 0) {
?>
	<h1 id="historyText">User info for order: <?php echo $q?></h1><br><br>

	<table class="userTable">
		<tr class="orderTH">
		<th class="orderTH">First name</th>
		<th class="orderTH">Last name</th>
		<th class="orderTH">Phone number</th>
		<th class="orderTH">Email</th>
		<th class="orderTH">startDate</th>
		<th class="orderTH">endDate</th>
		<th class="orderTH">LicenseNumber</th>
	</tr>
	<?php
	// while loop that fetches all matching data from db and puts it into a table.
	while($row = mysqli_fetch_array($result)) {
	?>	<tr class="orderTDg">
			<td id="userFirst" class="orderTD"><?php echo $row['userFirst'];?></td>
			<td id="userLast" class="orderTD"><?php echo $row['userLast'];?></td>
			<td id="userPhone" class="orderTD"><?php echo $row['userPhone'];?></td>
			<td id="userEmail" class="orderTD"><?php echo $row['userEmail'];?></td>
			<td id="startDate" class="orderTD"><?php echo $row['startDate'];?></td>
			<td id="endDate" class="orderTD"><?php echo $row['endDate'];?></td>
			<td id="licenseNumber" class="orderTD"><?php echo $row['licenseNumber'];?></td>
		</tr>  <?php
	}
	?> </table> <br> <?php
}else{
	?><h1 id="historyText">No result</h1><?php
}
mysqli_close($conn);
?>