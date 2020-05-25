<?php
$server_name = "localhost";
$username = "root";
$password = "";
$database = "student_management_system";
$con = new mysqli($server_name, $username, $password, $database);
if($con -> connect_error) {
	die("connection failed : ".$con->connect_error);
}
?>