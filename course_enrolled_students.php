<?php

session_start();
if(!isset($_SESSION['valid'])) {
	header("LOcation : login.html");
}
//database connection file
include "db_connect.php";
//get the course id
$course_id = $_GET['id'];

//select data to display the enrolled students in the selected course
$query = "select sc.id as id, sr.name as name, sr.email as email, sr.username as username, sr.phone_no as phone_no, sc.status as status from student_registration sr join my_courses sc on sr.id = sc.student_id where course_id = '$course_id'";
$result = mysqli_query($con, $query); 

?>
<!-- enrolled students -->
<div class="container" id="course_enrolled">
	<?php
	if(mysqli_num_rows($result) > 0) { ?>
		<h2 class="text-primary" id="heading">Enrolled Students : </h2>
		<form method="post" action="course_enrolled_students.php" id="course_enrolled_students">
			<table>
				<thead>
					<tr>
						<td>
							Id
						</td>
						<td>
							Name 
						</td>
						<td>
							Email
						</td>
						<td>
							Username
						</td>
						<td>
							Phone Number
						</td>
						<td>
							Status
						</td>
					</tr>
				</thead>
				<tbody>
			<?php while($row = $result -> fetch_assoc()) { ?>
					<tr> <!-- student information -->
						<td>
							<?php echo $row['id']; ?>
						</td>
						<td>
							<?php echo $row['name']; ?>
						</td>
						<td>
							<?php echo $row['email']; ?>
						</td>
						<td>
							<?php echo $row['username']; ?>
						</td>
						<td>
							<?php echo $row['phone_no']; ?>
						</td>

						<?php $status = $row['status']; ?> 

						<td> <!-- status of the course for the student -->
							<button type="button" onclick = "return statusChange(this.id)" id="<?php echo $row['id'] ?>">
								<?php 
								if($status == 1) { ?>
									<img src="status_green.png" alt="" width="25px" height="25px">
								<?php } else { ?>
									<img src="status_red.png" alt="" width="25px" height="25px">
								<?php } ?>
							</button>
						</td>
					</tr>
			<?php } ?>
				</tbody>
			</table>
		</form>
	<?php } else {
		echo "No students have enrolled yet in this course";
	} ?>
</div> 

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<style>
        .top_section {
            background-color: #293946 ;
            z-index: 1;
            background-repeat: no-repeat;
            margin-top :  100px;
            margin-bottom: 100px;
        }
        body {
            background: linear-gradient(rgba(255,255,255,.5), rgba(255,255,255,.7)), url("bgimage.jpg");
            background-size: cover;
            z-index: 1;
            background-repeat: no-repeat;
            margin-top :  100px;
            margin-bottom: 100px; 
        }
    </style>
</head>
<body>
	<div class="container top_section">
		<!-- navigation bar -->
		<nav class="navbar navbar-expand-lg navbar-light text-center" id="navbar">
	        <a class="navbar-brand mr-4 text-" href="#"> <h1 class="text-primary">
	        	<?php echo $_SESSION['name'] ?></h1> </a>
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
	</div>
	<script type="text/javascript" 
            src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js">
    </script>
	<script type="text/javascript">
		// update status - active or inactive
		function statusChange(id) {
			var status_id = id; 
			console.log(id);
			$.ajax({
				url : "student_course_status.php",
				type : "POST",
				data : {
					status_id : status_id
				},
				success : function(data) {
					alert(data);
					/*window.location.reload();*/
					$("#heading").hide();
					$('#course_enrolled_students').load('#course_enrolled_students');
				}
			});
		}		
	</script>
</body>
</html>