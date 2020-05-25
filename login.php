<?php 

include 'db_connect.php';
$username = $_POST['username'];
$password = $_POST['password'];

$query = "select * from student_registration where username = '$username' and password = '$password' ";

$result = mysqli_query($con, $query);
$userdata = $result -> fetch_assoc();
if($userdata['username'] === $username and $userdata['password'] === $password) {
	echo json_encode("Login Successfull");
} else if($userdata['username'] !== $username and $userdata['password'] === $password) {
	echo json_encode("Username is incorrect");
} else if($userdata['username'] === $username and $userdata['password'] !== $password) {
	echo json_encode("Password is incorrect");
} else {
	echo json_encode("Username does not exists... Please Do Sign Up!");
}

?>