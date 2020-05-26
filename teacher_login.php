<?php 
session_start();
include 'db_connect.php';
$username = $_POST['tusername'];
$password = $_POST['tpassword'];

$query = "select * from teacher_info where username = '$username' and password = '$password' ";

$result = mysqli_query($con, $query);
$userdata = $result -> fetch_assoc();
if(is_array($userdata) && !empty($userdata)) {
	$validuser = $userdata['username'];
	$_SESSION['valid'] = $validuser;
	$_SESSION['name'] = $userdata['name'];
	$_SESSION['id'] = $userdata['id'];
	if($validuser === $username and $userdata['password'] === $password) {
		echo ($validuser . " logged in successfully");
	}
} else {
	echo json_encode('Invalid Username or Password. Please do Sign Up!');
}
/*
if($userdata['username'] === $username and $userdata['password'] === $password) {
	echo json_encode("Login Successfull");
} else if($userdata['username'] !== $username and $userdata['password'] === $password) {
	echo json_encode("Username is incorrect");
} else if($userdata['username'] === $username and $userdata['password'] !== $password) {
	echo json_encode("Password is incorrect");
} else {
	echo json_encode("Username does not exists... Please Do Sign Up!");
}*/

?>