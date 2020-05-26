<?php
session_start();
if(!$_SESSION['valid']) {
	header("Location:login.html");
}
include 'db_connect.php';
$sid = $_SESSION['id']; 
print_r($sid);
$id = $_POST['id'];
$name = $_POST['name'];
$summary = $_POST['summary'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];

$query = "select * from student_registration sr inner join student_my_courses sc on sr.id = sc.student_id where sr.id = '$sid' and sc.id = '$id' ";
$result = mysqli_query($con, $query);

if(mysqli_num_rows($result) > 0) {
	echo ("Course already exists");
} else {
	$insert_query = "INSERT INTO `student_my_courses` (`student_id`,`name`, `summary`, `start_date`, `end_date`,`status`) values ('$sid', '$name', '$summary', '$start_date', '$end_date','1')";
	if(mysqli_query($con, $insert_query)) {
		echo ("Course added successfully");
	} else {
		echo ("Course is not added. Try again...");
	}
}

?>