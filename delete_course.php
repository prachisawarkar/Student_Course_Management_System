<?php

session_start();
if(!isset($_SESSION['valid'])) {
	header("Location : login.html");
}
//database connection file
include "db_connect.php";

$name = $_POST['course_id']; // get the course name 
//delete query to delete the selected course
$delete_query = "delete from courses where name = '$name'";
$result = mysqli_query($con, $delete_query);
//check whether deleted or not
$query = "select * from courses where name = '$name'";
$result1 = mysqli_query($con, $query);

if(empty($query)) {
	echo "1";
} else {
	echo "Data deleted successfully.";
}

?>