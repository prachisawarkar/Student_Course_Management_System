<?php
session_start();
if(!isset($_SESSION['valid'])) {
	header("Location : login.html");
}

include('db_connect.php');

$id = $_POST['delete_id']; // fetch the id to be deleted

//delete the row of the id from the database 
$delete_query = "delete from student_registration where id = '$id'";
$result = mysqli_query($con, $delete_query);

//check whether data deleted or not
$query = "select * from student_registration where id  = '$id'";
$result2 = mysqli_query($con, $query);
if(empty($query)) {
	echo "1"; //not deleted
	exit;
} else {
	echo "0"; //deleted
	exit;
}

?>