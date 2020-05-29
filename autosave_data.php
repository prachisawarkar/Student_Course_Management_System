<?php 
session_start();
if(!isset($_SESSION['valid'])) {
	header("Location : login.html");
}

include 'db_connect.php';
$id = $_POST['phone_no_id'];

$query = "select * from student_registration where id = '$id' ";

$result = mysqli_query($con, $query);
/*$row = $result -> fetch_assoc();*/

/*if($status == 1) {//green
	//header("Location : student_info3.php");
	echo "<img src = 'status_red.png' alt = '0'>";
	mysqli_query($con, "update student_registration set status = '0' where id = '$id'");
	echo ("inactive");

} else if($status == 0) {
	echo "<img src = 'status_green.png' alt = '1'>";
	mysqli_query($con, "update student_registration set status = '1' where id = '$id'");
	echo ("active");
}*/

$phone_no = $_POST['phone_no'];
if(mysqli_num_rows($result) > 0) {
	mysqli_query($con, "UPDATE student_registration set phone_no = '$phone_no' where id = '$id'");
	print_r($phone_no);
} else {
	echo ("data not changed");
}

?>

