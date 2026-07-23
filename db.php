<?php
$host = "localhost";
$dbname = "shoe_world"; // Change this if your database name is different
$username = "root"; // Change if necessary
$password = ""; // Change if necessary

$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
