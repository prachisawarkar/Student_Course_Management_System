<?php

session_start();
if(!isset($_SESSION['valid'])) {
	header('Location : login.html');
}

include 'db_connect.php';
$query = "select * from teacher_info where id = " . $_SESSION['id'] ;
$result = mysqli_query($con, $query);
$row = $result -> fetch_assoc(); 
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Profile</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body style="background-color: black; color: white;">
	<div class="container">
		<nav class="navbar navbar-expand-lg navbar-light text-center">
            <a class="navbar-brand mr-4 text-" href="#"> <h1 class="text-primary"><?php echo $_SESSION['name'] ?></h1> </a>
            <button class="navbar-toggler alert-light" type="button" data-toggle = 'collapse' data-target = '#navbarTogglerDemo1' aria-controls = 'navbarTogglerDemo1'aria-expanded = 'false' aria-label = 'Toggle navigation'>
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse mb-4" id="navbarTogglerDemo1">
                <ul class="navbar-nav ml-auto mt-2 mt-lg-0 ">
                    <li class="navbar-item active mr-4 mb-1">
                        <a class="navbar-link" href="teacher_profile.php">
                            <button type="button" class='btn-outline-primary rounded'>Profile</button>
                        </a>
                    </li>
                    <li class="navbar-item mr-4 mb-1">
                        <a class="navbar-link" href="student_info.php">
                            <button type="button" class='btn-outline-primary rounded'>Students</button>
                        </a>
                    </li>
                    <li class="navbar-item mr-4 mb-1">
                        <a class="navbar-link" href="created_courses.php">
                            <button type="button" class='btn-outline-primary rounded'>Courses</button>
                        </a>
                    </li>
                    <li class="navbar-item mr-4 mb-1">
                        <a class="navbar-link" href="logout.php">
                            <button type="button" class='btn-outline-primary rounded'>Logout</button>    
                        </a>
                    </li>
                </ul>
                
            </div>
        </nav>

        <!-- profile page -->

        <div class="mt-5 text-justify">
        	<h5>Name : <?php echo $row['name'] ?></h5>
        	<br>
   			<h5>Email Id : <?php echo $row['email'] ?></h5>
   			<br>
   			<h5>Username : <?php echo $row['username'] ?></h5>
   			<br> 
   			<h5>Phone Number : <?php echo $row['phone_no'] ?></h5>
   			<br>
   			<h5>Address : <?php echo $row['address'] ?></h5>
   			<br>
   			<h5>Joining Date & Time : <?php echo $row['created'] ?></h5>
   			<br>
        </div>
	</div>
</body>
</html>