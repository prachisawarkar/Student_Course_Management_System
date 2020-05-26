<?php
session_start();
/*if(!isset($_SESSION['valid'])) {
	header("Location : login.html");
}*/

include('db_connect.php');

$id = $_POST['id'];
$query = 'select * from student_registration where id = ' . $id;
$result = mysqli_query($con, $query);
$num = mysqli_num_rows($result);
if($num > 0) {
	$delete_query = "delete from student_registration where id = " . $id;
	mysqli($con, $delete_query);
	echo 1;
	exit();
	
}
echo 0;
exit();
?>