<?php 
/*session_start();
if(!isset($_SESSION['valid'])) {
	header("Location : login.html");
}*/

include 'db_connect.php';
$id = $_POST['status_id'];
$query = "select * from student_my_courses where id = '$id' ";

$result = mysqli_query($con, $query);
$row = $result -> fetch_assoc();
$status = $row['status'];

if($status == 1) {//green
	//header("Location : student_info3.php");
	mysqli_query($con, "update student_my_courses set status = '0' where id = '$id'");
	echo ("Status Updated to inactive");/*
	header("Location : course_enrolled_students.php>id=$");*/

} else if($status == 0) {
	mysqli_query($con, "update student_my_courses set status = '1' where id = '$id'");
	echo ("Status Updated to active");
} else {
	echo "status not updated";
}

?>
