<?php 
session_start();
include 'db_connect.php';
$username = $_POST['username']; //fetch username
$password = $_POST['password']; //fetch password

//select the data from where the username and password matches 
$query = "select * from users where username = '$username' and password = '$password' and role_id = '2' ";

$result = mysqli_query($con, $query);
$userdata = $result -> fetch_assoc();


//teachers
$query1 = "select * from users where username = '$username' and password = '$password' and role_id = '1' ";
$result1 = mysqli_query($con, $query1);
$userdata1 = $result1 -> fetch_assoc();

//check whether userdata contains anything or empty
if(is_array($userdata) && !empty($userdata)) {
	$validuser = $userdata['username']; //username
	$_SESSION['valid'] = $validuser; //session username
	$_SESSION['name'] = $userdata['name']; //session name
	$_SESSION['id'] = $userdata['id']; //session id

	if($userdata['username'] === $username and $userdata['password'] === $password) {
		echo ("student login successfully");
	}
} else if(is_array($userdata1) && !empty($userdata1)) {
	$validuser = $userdata1['username']; //username
	$_SESSION['valid'] = $validuser; //session username
	$_SESSION['name'] = $userdata1['name']; //session name
	$_SESSION['id'] = $userdata1['id']; //session id

	if($userdata1['username'] === $username and $userdata1['password'] === $password) {
		echo ("teacher login successfully");
	}
} else {
	echo ('Invalid Username or Password. Please do Sign Up!');
}
?>