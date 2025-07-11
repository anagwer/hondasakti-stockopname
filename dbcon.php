<?php
	$conn = new mysqli('localhost', 'root', '', 'db_hondasakti');
	
	if(!$conn){
		die("Error: Failed to connect to database");
	}
?>	
<?php

// Database configuration 	
$hostname = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname   = "db_hondasakti";
 
// Create database connection 
$con = new mysqli($hostname, $username, $password, $dbname); 
 
// Check connection 
if ($con->connect_error) { 
	die("Connection failed: " . $con->connect_error); 
}

?>