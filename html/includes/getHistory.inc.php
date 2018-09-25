<?php
$q = intval($_GET['q']);

include_once 'dbh.inc.php';

$sql= "SELECT cars.*, orderhistory.* FROM cars LEFT JOIN orderhistory on cars.licenseNumber = orderhistory.licenseNumber WHERE orderhistory.user_id='".$q."';";
$result = mysqli_query($conn, $sql);

echo 
'<div id="history">
<h1 id="historyText">My order history!</h1>
</div>
<table  id="historyTable">
<tr>
<th id="orderTH" class="mediumText">orderID</th>
<th id="orderTH" class="mediumText">Brand</th>
<th id="orderTH" class="mediumText">Model</th>
<th id="orderTH" class="mediumText">Booked from</th>
<th id="orderTH" class="mediumText">Until</th>
<th id="orderTH" class="mediumText">Passengers</th>
<th id="orderTH" class="mediumText">LicenseNumber</th>


</tr>';
while($row = mysqli_fetch_array($result)) {
   echo "<tr>";
   echo "<td id='orderTD' class='mediumText'>" . $row['orderID'] . "</td>";
   echo "<td id='orderTD' class='mediumText'>" . $row['make'] . "</td>";
   echo "<td id='orderTD' class='mediumText'>" . $row['model'] . "</td>";
   echo "<td id='orderTD' class='mediumText'>" . $row['startDate'] . "</td>";
   echo "<td id='orderTD' class='mediumText'>" . $row['endDate'] . "</td>";
   echo "<td id='orderTD' class='mediumText'>" . $row['passengers'] . "</td>";
   echo "<td id='orderTD' class='mediumText'>" . $row['licenseNumber'] . "</td>";
   echo "</tr>";
}
echo "</table>";
mysqli_close($conn);
?>