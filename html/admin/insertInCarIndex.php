<html>
<head>
<title>Added to car rental index</title>
</head>
<body>

<?PHP

$lcnsNr = strtoupper($_POST['lcnsNr']);
$make = $_POST['make'];
$model = $_POST['model'];
$passengers = $_POST['passengers'];

//Gives $avail variable the property of 1 if user has input yes
// or 0 if the user has input no
if($_POST['avail']== "yes"){
	$avail = 1;
}else{
	$avail = 0;
}

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
//Creates a SQL query with the information given on carRegistration.html
$sql = "INSERT INTO cars (licenseNumber, make, model, passengers, availability) VALUES ('".$lcnsNr."','".$make."','".$model."','".$passengers."','".$avail."')";

//Sends the query to SQL db and gives confirmation if the query was successfully
	if ($conn->query($sql) === TRUE) {
    	echo "Car added to database";
	} else {
    	echo "Error: " . $sql . "<br>" . $conn->error;
	}
?>
<br \>
<button onclick="location.href='/infotivCarRental/html/admin/carRegistration.html'" class="selectBtn">Return</button>
</body>
</html>