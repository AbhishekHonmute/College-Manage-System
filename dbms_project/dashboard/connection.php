<?php
	$db_servername = "localhost";
	$db_username = "root";
	$db_password = "";
	$db1_name = "college";
	if ($conn = mysqli_connect($db_servername, $db_username, $db_password)) {
		$connection = "true";
		$sql = "CREATE DATABASE IF NOT EXISTS college";
        if ($conn->query($sql) === TRUE) {
			$conn = mysqli_connect($db_servername, $db_username, $db_password, $db1_name);
        } else {
            echo "Error creating college database : " . $conn->error;
        }
	} else {
    	exit("connection to database failed Please check the mysql server is on and database is created");
    	$connection = "false";
	}
?>