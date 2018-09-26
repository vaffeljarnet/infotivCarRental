<?php

//creates a basic connection.

$servername = "localhost";
$username = "root";
$password = "infotiv2018";
$dbname = "INPUT PASSWORD HERE";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
