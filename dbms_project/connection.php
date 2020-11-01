<?php
	$db_servername = "localhost";
	$db_username = "root";
	$db_password = "";
	$db1_name = "college";
	if ($conn = mysqli_connect($db_servername, $db_username, $db_password, $db1_name)) {
    	$connection = "true";
	} else {
    	exit("connection to database failed Please check the mysql server is on and database is created");
    	$connection = "false";
	}
?>