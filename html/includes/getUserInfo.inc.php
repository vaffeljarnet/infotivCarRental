
<?php
$q = intval($_GET['q']);

include_once 'dbh.inc.php';

mysqli_select_db($con,"ajax_demo");
$sql="SELECT users.*, bookings.* FROM users LEFT JOIN bookings on users.user_id = bookings.user_id WHERE bookings.orderID LIKE '".$q."';";
$result = mysqli_query($conn, $sql);

echo 
"<table>
<tr>
<th>First name</th>
<th>Last Name</th>
<th>Phone number</th>
<th>Email</th>
<th>startDate</th>
<th>endDate</th>
<th>licenseNumber</th>

</tr>";
while($row = mysqli_fetch_array($result)) {
   echo "<tr>";
   echo "<td>" . $row['user_first'] . "</td>";
   echo "<td>" . $row['user_last'] . "</td>";
   echo "<td>" . $row['user_phone'] . "</td>";
   echo "<td>" . $row['user_email'] . "</td>";
   echo "<td>" . $row['startDate'] . "</td>";
   echo "<td>" . $row['endDate'] . "</td>";
   echo "<td>" . $row['licenseNumber'] . "</td>";
   echo "</tr>";
}
echo "</table>";
mysqli_close($conn);
?>