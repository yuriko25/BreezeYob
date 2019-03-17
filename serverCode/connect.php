<?php
	//database information 
	$server = 	"localhost"; 
	$user = 	"root";
	$pass = 	"";
  $database = "product"; 
         
	//make a database connection object
	$mysqli = new mysqli($server, $user, $pass, $database);	
	
	//test if there are database connection errors
	if ($mysqli->connect_error) 
		die("Connect Error " . $mysqli->connect_error);

	
	
?>