<?php
$q = intval($_GET['q']);

include_once 'dbh.inc.php';

$sql= "SELECT cars.*, orderhistory.* FROM cars LEFT JOIN orderhistory on cars.licenseNumber = orderhistory.licenseNumber WHERE orderhistory.user_id='".$q."';";
$result = mysqli_query($conn, $sql);

echo 
'<table style="width:44%">
<tr>
<th>orderID</th>
<th>Brand</th>
<th>Model</th>
<th>Booked from</th>
<th>Until</th>
<th>Passengers</th>
<th>LicenseNumber</th>


</tr>';
while($row = mysqli_fetch_array($result)) {
   echo "<tr>";
   echo "<td>" . $row['orderID'] . "</td>";
   echo "<td>" . $row['make'] . "</td>";
   echo "<td>" . $row['model'] . "</td>";
   echo "<td>" . $row['startDate'] . "</td>";
   echo "<td>" . $row['endDate'] . "</td>";
   echo "<td>" . $row['passengers'] . "</td>";
   echo "<td>" . $row['licenseNumber'] . "</td>";
   echo "</tr>";
}
echo "</table>";
mysqli_close($conn);
?>