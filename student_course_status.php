<?php 
session_start();
if(!isset($_SESSION['valid'])) {
	header("Location : login.html");
}
//database connection file
include 'db_connect.php';
$id = $_POST['status_id']; //get the status id
//select data
$query = "select * from student_my_courses where id = '$id' ";

$result = mysqli_query($con, $query);
$row = $result -> fetch_assoc();
$status = $row['status']; //status of the course for the student

if($status == 1) {//green
	//update the course status in table student_my_courses
	mysqli_query($con, "update student_my_courses set status = '0' where id = '$id'");
	echo ("Status Updated to inactive");

} else if($status == 0) { //red
	//update the course status in table student_my_courses
	mysqli_query($con, "update student_my_courses set status = '1' where id = '$id'");
	echo ("Status Updated to active");
} else {
	echo "status not updated";
}

?>
