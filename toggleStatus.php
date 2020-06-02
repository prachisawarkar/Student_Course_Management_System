<?php 
session_start();
if(!isset($_SESSION['valid'])) {
	header("Location : login.html");
}
//database connection file
include 'db_connect.php';
$id = $_POST['status_id']; //fetch the id whose status to be updated
//select data
$query = "select * from student_registration where id = '$id' ";

$result = mysqli_query($con, $query);
$row = $result -> fetch_assoc();
$status = $row['status']; //store status into variable status

if($status == 1) {//green
	//update the status in student_registration table
	mysqli_query($con, "update student_registration set status = '0' where id = '$id'");
	echo ("Status Updated to inactive");

} else if($status == 0) { //red
	//update the status in student_registration table
	mysqli_query($con, "update student_registration set status = '1' where id = '$id'");
	echo ("Status Updated to active");
}

?>
























