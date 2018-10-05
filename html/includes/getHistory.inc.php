<?php
$q = intval($_GET['q']);

include_once 'dbh.inc.php';


//sql query that joins the tables cars and orderhistory where there are matching license numbers and stores it in a variable.
$sql= "SELECT cars.*, orderhistory.* FROM cars LEFT JOIN orderhistory on cars.licenseNumber = orderhistory.licenseNumber WHERE orderhistory.userID='".$q."';";
$result = mysqli_query($conn, $sql);
$id = 1;
if ($result->num_rows > 0) {
	?>	<div id="historyButton">
	<h1 id="historyText">My order history</h1><br><br>
	</div> 
	<table class="historyTable">
		<tr class="orderTH">
		<th class="orderTH">orderID</th>
		<th class="orderTH">Brand</th>
		<th class="orderTH">Model</th>
		<th class="orderTH">Booked from</th>
		<th class="orderTH">Until</th>
		<th class="orderTH">Passengers</th>
		<th class="orderTH">LicenseNumber</th>
	</tr>
	<?php
	// while loop that fetches all matching data from db and puts it into a table.
	while($row = mysqli_fetch_array($result)) {
	?>	<tr class="orderTD">
			<td id="orderHis<?php echo $id;?>" class="orderTD"><?php echo $row['orderID'];?></td>
			<td id="makeHis<?php echo $id;?>" class="orderTD"><?php echo $row['make'];?></td>
			<td id="modelHis<?php echo $id;?>" class="orderTD"><?php echo $row['model'];?></td>
			<td id="startHis<?php echo $id;?>" class="orderTD"><?php echo $row['startDate'];?></td>
			<td id="endHis<?php echo $id;?>" class="orderTD"><?php echo $row['endDate'];?></td>
			<td id="passHis<?php echo $id;?>" class="orderTD"><?php echo $row['passengers'];?></td>
			<td id="licenseHis<?php echo $id;?>" class="orderTD"><?php echo $row['licenseNumber'];?></td>
		</tr>  <?php
		$id++;
	}
	?> </table> <?php
}else{
	?><h1 id="historyText">Order history empty</h1><?php
}
mysqli_close($conn);
?>