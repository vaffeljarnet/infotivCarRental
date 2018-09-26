<?php
$q = intval($_GET['q']);

include_once 'dbh.inc.php';

$sql= "SELECT cars.*, orderhistory.* FROM cars LEFT JOIN orderhistory on cars.licenseNumber = orderhistory.licenseNumber WHERE orderhistory.user_id='".$q."';";
$result = mysqli_query($conn, $sql);

echo 
'<div id="historyButton">
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


</tr>';
while($row = mysqli_fetch_array($result)) {
   echo "<tr>";
   echo '<td class="orderTD">' . $row["orderID"] . '</td>';
   echo '<td class="orderTD">' . $row["make"] . '</td>';
   echo '<td class="orderTD">' . $row["model"] . '</td>';
   echo '<td class="orderTD">' . $row["startDate"] . '</td>';
   echo '<td class="orderTD">' . $row["endDate"] . '</td>';
   echo '<td class="orderTD">' . $row["passengers"] . '</td>';
   echo '<td class="orderTD">' . $row["licenseNumber"] . '</td>';
   echo '</tr>';
}
echo "</table>";
mysqli_close($conn);
?>