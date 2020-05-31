<?php
session_start();
if(!$_SESSION['valid']) {
	header("Location:login.html");
}
include 'db_connect.php';
$sid = $_SESSION['id']; //student id
$id = $_POST['enroll_id']; // course id

$add_query = "select * from add_course where id = '$id'";
$result1 = mysqli_query($con, $add_query);
$row1 = $result1 -> fetch_assoc();

$name = $row1['name'];
$summary = $row1['summary'];
$start_date = $row1['start_date'];
$end_date = $row1['end_date'];

$query = "select * from student_my_courses where course_id = '$id' and student_id = '$sid'";
$result = mysqli_query($con, $query);

//check whether course already enrolled or not. If not then enroll.
if($result->num_rows > 0) {
	echo ($id . "Course already enrolled");
} else {
	$insert_query = "INSERT INTO `student_my_courses` (`course_id`, `student_id`, `name`, `summary`, `start_date`, `end_date`, `status`) values ('$id', '$sid', '$name', '$summary', '$start_date', '$end_date','1')";
	$result1 = mysqli_query($con, $insert_query);
	if($result1) {
		echo ("Course Enrolled successfully");
	} else {
		echo ("Course not enrolled. Try again...");
	}
}

?>