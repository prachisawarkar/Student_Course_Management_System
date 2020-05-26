<?php 

include 'db_connect.php';
$name = $_POST['name'];
$summary = $_POST['summary'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];

$query = "select * from add_course where name = '$name'";
$result = mysqli_query($con, $query);
if(mysqli_num_rows($result) > 0) {
	echo ("Course already exists");
} else {
	$insert_query = "INSERT INTO `add_course` (`name`, `summary`, `start_date`, `end_date`,`status`) values ('$name', '$summary', '$start_date', '$end_date','0')";
	if(mysqli_query($con, $insert_query)) {
		echo ("Course added successfully");
	} else {
		echo ("Course is not added. Try again...");
	}
}

?>