<?php
$servername = "localhost";
$un = "root";
$password = "";
$dbname = "volunteer";

// Create connection
$con = mysqli_connect($servername, $un, $password,$dbname);

// Check connection
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully";
?>
