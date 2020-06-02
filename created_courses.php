<?php

session_start();
if(!isset($_SESSION['valid'])) {
	header("Location : login.html");
}
//database connection file
include "db_connect.php";
//select dara
$query = "select * from add_course group by name order by id asc;";
$result = mysqli_query($con, $query);

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Courses</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
</head>
<body style="background-color: black; color: white;">
	<div class="container">
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
	<div class="container">
		<!-- button to add courses -->
		<a href="add_course.php">
			<button class="btn btn-lg btn-primary mb-5 add_course_btn">ADD COURSES</button>
		</a>
		<!-- display all the added courses -->
		<form action="created_course.php" method="post" id="created_courses">
			<table style="border : 1px solid black;">
				<thead>
					<th>Sr.No.</th>
					<th>Name</th>
					<th>Summary</th>
					<th>Start date</th>
					<th>End date</th>
					<th>Status</th>
					<th>Action</th>
					<th>Notes</th>
				</thead>
				<tbody>
					<?php
					if(mysqli_num_rows($result) > 0) { /* check the number of rows fetched by the result*/
						while($row = $result -> fetch_assoc()) { ?>
							<tr>
								<td> <!-- id of the course -->
									<input type="text" name="id" value="<?php echo $row['id'] ?>">
								</td>
								<td> <!-- name of the course -->
									<input type="text" name="name" value="<?php echo $row['name'] ?>">
								</td>
								<td> <!-- summary of the course -->
									<input type="text" name="summary" value="<?php echo $row['summary'] ?>">
								</td>
								<td> <!-- start date of the course -->
									<input type="date" name="start_date" value="<?php echo $row['start_date'] ?>">
								</td>
								<td> <!-- end date of the course -->
									<input type="date" name="end_date" value="<?php echo $row['end_date'] ?>">
								</td>
								<td> <!-- status -->
									<?php
									if($row['status'] == 0) { ?>
										<img src="status_red.png" alt="" width="25px;" height="25px;">
									<?php } else { ?>
										<img src="status_green.png" alt="" width="25px;" height="25px;"> 
									<?php } ?>
								</td>

								<td class="bg-light"> <!-- bag icon to display the enrolled students in the course -->
									<?php
									echo "<a href=\"course_enrolled_students.php?id=$row[id]\">"; ?>
										<img src="bag.png" alt="bag" width="25px" height="25px">
									<?php echo "</a>";
									?>	
									<input type="button" id="<?php echo $row['name']; ?>" name="delete_id" class="btn btn-sm btn-primary" value="DELETE" onclick="delete_course(this.id)">
								</td>
								<td> <!-- notes crud  -->
									<a href="add_delete_files.php?course_name=<?php echo $row['name'] ?>">
									
										<img src="notes_icon2.jpg" alt="" width="45px;" height="45px">
									</a>
								</td>

							</tr>
						<?php }
					}
					?>
				</tbody>
			</table>
		</form>
	</div>

	<script type="text/javascript" 
            src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js">
    </script>
	<script  type="text/javascript">
		// function to delete the course
		function delete_course(id) {
			var course_id = id;
			//confirm before deleting
			if(confirm("Are you sure you want to delete?")) {
				$.ajax({
					url : "delete_course.php",
					method : 'POST',
					data : {
						course_id : course_id
					},
					success : function(data) {
						if(data == 1) {
							alert("Course not deleted. Please try again...");
						} else {
							alert(data);
							$("#navbar").hide();
							$(".add_course_btn").hide();
							$("#created_courses").load("created_courses.php");
						}
					}
				});
			}
			
		}

		/*function enrolled_students(id) {
			var course_id = id;
			console.log(id);
			$.ajax({
				url : "course_enrolled_students.php",
				method : "POST",
				data : {
					course_id : course_id
				},
				success : function(data) {
					alert(data);
				}
			})
		}*/
	</script> 
</body>
</html>