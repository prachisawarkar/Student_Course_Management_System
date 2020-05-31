<?php

session_start();
include "db_connect.php";

$id = $_POST['course_id'];
$delete_query = "delete from add_course where id = '$id'";
$result = mysqli_query($con, $delete_query);

$query = "select * from add_course where id = '$id'";
$result1 = mysqli_query($con, $query);

if(empty($query)) {
	echo "1";
} else {
	echo "Data deleted successfully.";
}

?>