<?php
session_start();
if(!$_SESSION['valid']) {
	header("Location:login.html");
}
//database connection file
include 'db_connect.php';
$sid = $_SESSION['id']; //student id
$id = $_POST['enroll_id']; // course id

//select the data
$add_query = "select * from courses where id = '$id'";
$result1 = mysqli_query($con, $add_query);
$row1 = $result1 -> fetch_assoc();

//fetch data from the table courses
$name = $row1['name']; 
$summary = $row1['summary'];
$start_date = $row1['start_date'];
$end_date = $row1['end_date'];

//select data according to the course id and student id
$query = "select * from my_courses where course_id = '$id' and student_id = '$sid'";
$result = mysqli_query($con, $query);

//check whether course already enrolled or not. If not then enroll.
if($result->num_rows > 0) {
	echo ("Course already enrolled");
} else {
	// insert data into my_courses table
	$insert_query = "INSERT INTO `my_courses` (`course_id`, `student_id`, `name`, `summary`, `start_date`, `end_date`, `status`) values ('$id', '$sid', '$name', '$summary', '$start_date', '$end_date','1')";
	$result1 = mysqli_query($con, $insert_query);
	if($result1) {
		echo ("1");
	} else {
		echo ("Course not enrolled. Try again...");
	}
}

?>