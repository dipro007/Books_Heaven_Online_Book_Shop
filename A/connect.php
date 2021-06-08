<?php 

	$host = "localhost";
	$username = "root";
	$password = "";
	$db_name = "userinfosystem";

	$con = mysqli_connect($host, $username, $password, $db_name);

	if(!$con) {
		die("Cannot connect to the database");
	}

?>