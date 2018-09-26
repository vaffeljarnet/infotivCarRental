<?php

//creates a basic connection.

$servername = "localhost";
$username = "root";
$password = "INPUT PASSWORD HERE";
$dbname = "fleet_information";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
