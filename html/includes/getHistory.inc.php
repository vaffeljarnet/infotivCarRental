<?php
$q = intval($_GET['q']);

include_once 'dbh.inc.php';

$sql= "SELECT cars.*, orderhistory.* FROM cars LEFT JOIN orderhistory on cars.licenseNumber = orderhistory.licenseNumber WHERE orderhistory.user_id='".$q."';";
$result = mysqli_query($conn, $sql);

?>	<div id="historyButton">
<h1 id="historyText">My order history</h1><br><br>
</div> 
<table class="historyTable">
	<tr>
	<th class="orderTH">orderID</th>
	<th class="orderTH">Brand</th>
	<th class="orderTH">Model</th>
	<th class="orderTH">Booked from</th>
	<th class="orderTH">Until</th>
	<th class="orderTH">Passengers</th>
	<th class="orderTH">LicenseNumber</th>
</tr>
<?php
while($row = mysqli_fetch_array($result)) {
?>	<tr class="orderTD">
		<td class="orderTD"><?php echo $row['orderID'];?></td>
		<td class="orderTD"><?php echo $row['make'];?></td>
		<td class="orderTD"><?php echo $row['model'];?></td>
		<td class="orderTD"><?php echo $row['startDate'];?></td>
		<td class="orderTD"><?php echo $row['endDate'];?></td>
		<td class="orderTD"><?php echo $row['passengers'];?></td>
		<td class="orderTD"><?php echo $row['licenseNumber'];?></td>
    </tr>  <?php
}
?> </table> <?php
mysqli_close($conn);
?>