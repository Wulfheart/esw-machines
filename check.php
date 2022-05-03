<?php
$servername   = "localhost";
$database = "u809243528_test";
$username = "u809243528_test";
$password = "Test1234";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}
  echo "Connected successfully";
?>
