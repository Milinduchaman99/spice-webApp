<?php 
	//Start session
	session_start();
	
	//Creating Constants to Store Non Repeating Values
	define('SITEURL', 'http://localhost/finalproject/');
	define('LOCALHOST', 'localhost');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', '');
	define('DB_NAME', 'spice-order');

	$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error()); //Database Connection
	$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error()); //Selecting Database

?>