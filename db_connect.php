<?php
$server_name = "localhost"; //server name
$username = "root"; // username 
$password = ""; // password of the database
$database = "student_management_system"; // database name
$con = new mysqli($server_name, $username, $password, $database); //making connection
if($con -> connect_error) { // if any error is present
	die("connection failed : ".$con->connect_error);
}
?>