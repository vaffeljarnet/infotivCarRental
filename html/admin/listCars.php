<!DOCTYPE html>
<html>
<head>
    <title>List Cars Database</title>
</head>
<body>
<table style="width:30%">

<tbody>

<th>Make</th>
<th>Model</th>
<th>License Number</th>
<th>Passengers</th>
<th>Availability</th>

<?php
$servername = "localhost";
$username = "root";
$password = "infotiv2018";
$dbname = "fleet_information";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

//A query for selecting all unique car models in the db that are available
$sql = "SELECT * FROM cars ORDER BY make";
$result = $conn->query($sql);

//Loops trough the result of the query and populates the html table
//on the page with all cars from the database table "cars"

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
			?>
			<tr>
				<td><?php echo $row['make'];?></td>
				<td><?php echo $row['model'];?></td>
				<td><?php echo $row['licenseNumber'];?></td>
				<td><?php echo $row['passengers'];?></td>
				<td><?php echo $row['availability'];?></td>
			</tr>
		<?php
    }
} else {
    echo "0 results";
}
$conn->close();
?>
</tbody>
</table>
</table>
</body>
</html>