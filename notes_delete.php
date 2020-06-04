<?php
session_start();
if(!isset($_SESSION['valid'])) {
	header("Location : login.html");
}
//database connection file
include('db_connect.php');
//fetch the notes name
$notes_name = $_POST['delete_id'];

//delete the row of the id from the database 
$delete_query = "delete from courses where notes = '$notes_name'";
$result = mysqli_query($con, $delete_query);

//check whether data deleted or not
$query = "select * from courses where notes  = '$notes_name'";
$result2 = mysqli_query($con, $query);
if(empty($query)) {
	echo "1"; //not deleted
	exit;
} else {
	echo "0"; //deleted
	exit;
}

?>