<?php
$servername = "localhost";
$username = "mobw7774_brian";
$password = "brian7098";
$dbname = "mobw7774_api_brian";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
