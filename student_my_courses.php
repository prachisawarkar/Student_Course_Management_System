<?php
session_start();
if(!isset($_SESSION['valid'])) {
	header('Location : login.php');
}
$id = $_SESSION['id'];
include 'db_connect.php';
$query = "select * from student_my_courses where student_id = '$id'";
$result = mysqli_query($con, $query);

/*$expired_courses = "select * from add_course";
$result1 = mysqli_query($con, $expired_courses);*/
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Courses</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->

	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light text-center">
        <a class="navbar-brand mr-4 text-" href="#"> <h1 class="text-primary"><?php echo $_SESSION['name'] ?></h1> </a>
        <button class="navbar-toggler" type="button" data-toggle = 'collapse' data-target = '#navbarTogglerDemo1' aria-controls = 'navbarTogglerDemo1'aria-expanded = 'false' aria-label = 'Toggle navigation'>
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse mb-4" id="navbarTogglerDemo1">
            <ul class="navbar-nav ml-auto mt-2 mt-lg-0 ">
                <li class="navbar-item active mr-4 mb-1">
                    <a class="navbar-link" href="profile.php">
                        <button type="button" class='btn-outline-primary rounded'>Profile</button>
                    </a>
                </li>
                <li class="navbar-item mr-4 mb-1">
                    <a class="navbar-link" href="student_courses.php">
                        <button type="button" class='btn-outline-primary rounded'>Courses</button>
                    </a>
                </li>
                <li class="navbar-item mr-4 mb-1">
                    <a class="navbar-link" href="student_my_courses.php">
                        <button type="button" class='btn-outline-primary rounded'>My Courses</button>
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
	<h1 class="text-primary">My Courses</h1>
	<?php
	/*echo date('yy-m-d');*/ 

	while($row = mysqli_fetch_array($result)) {
		if($row['start_date'] >= date('yy-m-d')) { ?>
			<div class="row border">
				<div class="col-md-8">
					<h3> <?php echo $row['name'] ?> </h3>
					<p> <?php echo $row['summary'] ?> </p>
					<p> <?php echo $row['start_date'] . " to " . $row['end_date'] ?> </p>
				</div>
				<div class="col-md-4">
					<input type="button" name="enroll_now" value="ENROLLED" class="btn btn-primary mb-3">
				</div>
			</div>
		<?php } else { ?>
			<div class="row border disabled">
				<div class="col-md-8">
					<h3> <?php echo $row['name'] ?> </h3>
					<p> <?php echo $row['summary'] ?> </p>
					<p> <?php echo $row['start_date'] . " to " . $row['end_date'] ?> </p>
				</div>
				<div class="col-md-4">
					<input type="button" name="enroll_now" value="ENROLLED" disabled="true" class="btn btn-primary mb-3">
				</div>
			</div>
		<?php }
	} ?>



	<!-- <?php
	while($row1 = mysqli_fetch_array($result1)) {
		if($row1['start_date'] < date('yy-m-d')) { ?>
			<div class="row border disabled">
				<div class="col-md-8">
					<h3> <?php echo $row1['name'] ?> </h3>
					<p> <?php echo $row1['summary'] ?> </p>
					<p> <?php echo $row1['start_date'] . " to " . $row1['end_date'] ?> </p>
				</div>
				<div class="col-md-4">
					<input type="button" name="enroll_now" value="ENROLLED" class="btn btn-primary mb-3" disabled="true">
				</div>
			</div>
		<?php } 
	}
	?> -->
</body>
</html>
