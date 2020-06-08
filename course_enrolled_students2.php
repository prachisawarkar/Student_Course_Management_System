<?php

session_start();
if(!isset($_SESSION['valid'])) {
	header("Location : login.html");
}
//database connection file
include "db_connect.php";
//get the course id
$course_id = $_POST['get_course_id'];
$_SESSION['id'] = $course_id;
//select data to display the enrolled students in the selected course
$query = "select sc.id as id, sr.name as name, sr.email as email, sr.username as username, sr.phone_no as phone_no, sc.status as status from users sr join my_courses sc on sr.id = sc.student_id where course_id = '$course_id'";
$result = mysqli_query($con, $query); 

?>
<!-- navigation bar -->
<nav class="navbar navbar-expand-lg navbar-light text-center" id="navigation_bar">
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

<!-- enrolled students -->
<div class="container" id="course_enrolled">
	<?php
	if(mysqli_num_rows($result) > 0) { ?>
		<h2 class="text-primary" id="heading">Enrolled Students : </h2>
		<form method="post" id="course_enrolled_students">
			<table class="students_enrolled">
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
							<button type="button" onclick = "return statusChange(this.id)" id="<?php echo $row['id'] ?>" class = 'status_button'>
								<?php 
								if($status == 1) { ?>
									<img src="status_green.png" alt="" width="15px" height="15px">
								<?php } else { ?>
									<img src="status_red.png" alt="" width="18px" height="18px">
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
	<style>
		#navigation_bar {
            background-color: #293946 ;
            z-index: 1;
            background-repeat: no-repeat;
            margin-top :  100px;
            margin-bottom: 100px;
        }
		tr {
			border: 1px solid white;
		}
	</style>
</head>
<body>
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
					$('#course_enrolled').load('course_enrolled_students.php');
					$("#navigation_bar").hide();
				}
			});
		}		
	</script>
</body>
</html>