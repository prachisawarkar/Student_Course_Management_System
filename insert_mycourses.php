<?php
session_start();
if(!$_SESSION['valid']) {
	header("Location:login.html");
}
include 'db_connect.php';
$sid = $_SESSION['id']; //student id
$id = $_POST['enroll_id']; // course id
$name = $_POST['name'];
$summary = $_POST['summary'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];

$add_query = "select * from add_course where id  = '$id'";
$result1 = mysqli_query($con, $add_query);
$row1 = $result1 -> fetch_assoc();

/*$query = "select * from student_registration sr join student_my_courses sc on sr.id = sc.student_id where sr.id = '$sid' and sc.name = '$name'";*/
$query = "select * from student_my_courses where id = '$id'";
$result = mysqli_query($con, $query);

if($result->num_rows > 0) {
	echo ($id . "Course already exists");
} else {
	$insert_query = 'INSERT INTO `student_my_courses` (`student_id`,`name`, `summary`, `start_date`, `end_date`,`status`) values ( \'$sid\', $row["name"], $row["summary"], $row["start_date"], $row["end_date"],"1")';
	if(mysqli_query($con, $insert_query)) {
		echo ("Course added successfully");
	} else {
		echo ("Course is not added. Try again...");
	}
}

?>