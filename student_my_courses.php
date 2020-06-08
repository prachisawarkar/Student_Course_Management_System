<?php
session_start();
if(!isset($_SESSION['valid'])) {
	header('Location : login.php');
}
$id = $_SESSION['id']; //fetch the id of the current student
include 'db_connect.php';
//select the data to display
$query = "select * from my_courses where student_id = '$id'";
$result = mysqli_query($con, $query);

//select the data to display the data disable or enable according to the student status and course status of the student
$student_status_query = "select * from users where id = '$id'";
$status_result = mysqli_query($con, $student_status_query);
$status_row = $status_result -> fetch_assoc();
$student_status = $status_row['status'];

/*$expired_courses = "select * from courses";
$result1 = mysqli_query($con, $expired_courses);*/
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>My Courses</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <style>
    	body {
            background: linear-gradient(rgba(255,255,255,.5), rgba(255,255,255,.7)), url("bgimage.jpg");
            background-size: cover;
            z-index: 1;
            background-repeat: no-repeat;
            margin-top :  100px;
            margin-bottom: 100px;
        }
        .top-section {
            background-color: #293946 ;
            z-index: 1;
            background-repeat: no-repeat;
            margin-top :  100px;
            margin-bottom: 100px;
        }
    </style>
</head>
<body>
	<div class="container top-section">
		<!-- navigation bar -->
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
	                        <button type="button" class='btn-outline-primary rounded active'>My Courses</button>
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
	</div>
	<!-- show all the enrolled courses -->
	<div class="container" id="my_courses" >
		<h1 class="text-primary">My Courses</h1>
		<?php
		if($result->num_rows > 0) {
			while($row = mysqli_fetch_array($result)) {
				//enable the course
			
				if($student_status == 1 && $row['status'] == 1 && $row['end_date'] > date('Y-m-d')) { ?>
					<p id="attachments"></p>
					<div class="row mb-5" style="border : 2px solid #293946;">
						<div class="col-md-6">
							<h3> <?php echo $row['name'] ?> </h3>
							<p> <?php echo $row['summary'] ?> </p>
							<p> <?php echo $row['start_date'] . " to " . $row['end_date'] ?> </p>
						</div>
						<!-- to download the notes -->
						<div class="col-md-3">
							<!-- <a href="download_notes.php?course_name=<?php echo $row['name'] ?>">
								<h4>Download Notes</h4>
								<img src="notes_icon2.jpg" alt="" width="45px;" height="45px">
							</a> -->
							<button type="button" id="<?php echo $row['name']; ?>" onclick="return show_notes(this.id)">
								<hs4>Download Notes</h4>
								<img src="notes_icon2.jpg" alt="" width="45px;" height="45px">
							</button>
						</div>
						<!-- <div id="attachments"></div> -->
						<div class="col-md-3"> <!-- enroll now button -->
							<input type="button" name="enroll_now" value="ENROLLED" class="btn btn-primary mt-3">
						</div>
					</div>

				<?php } else if($student_status == 1 && $row['status'] == 1 && $row['end_date'] < date('Y-m-d')) { ?>
					<!-- disable the course -->
					<div class="row mb-5" style="border : 2px solid #293946;">
						<div class="col-md-6">
							<h3> <?php echo $row['name'] ?> </h3>
							<p> <?php echo $row['summary'] ?> </p>
							<p> <?php echo $row['start_date'] . " to " . $row['end_date'] ?> </p>
						</div>
						<div class="col-md-3"></div>
						<div class="col-md-3">
							<input type="button" name="enroll_now" value="ENROLLED" disabled="true" class="btn btn-primary mb-3 mt-3">
						</div>
					</div>
				<?php } else if($student_status == 1 && $row['status'] == 0) { ?> 
					<!-- unable to view the course -->
					<?php echo " "; ?>
				<?php } else if($student_status == 0 && $row['status'] == 1) { ?>
					<!-- unable to view the course -->
					<?php echo " " ?>
				<?php } else if($student_status == 0 && $row['status'] == 0) { ?>
					<!-- unable to view the course -->
					<?php echo " " ?>
				<?php } else { ?>
					<h3>No course is enrolled!</h3>
				<?php }
			} 
		} else { 
			echo "You have not enrolled in any course!";
		}?>
	</div>
	<script type="text/javascript" 
            src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js">
    </script>
    <script type="text/javascript">
    	function show_notes(id) {
    		var course_name = id;
    		$.ajax({
    			url : 'download_notes.php',
    			type : "POST",
    			data : {
    				course_name : course_name
    			},
    			success : function(data) {
    				/*$("#my_courses").load('student_my_courses.php');*/
    				$("#attachments").html(data);
    			}
    		});
    	}
    </script>
</body>
</html>
