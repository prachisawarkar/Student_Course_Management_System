<?php

session_start();
if(!isset($_SESSION['valid'])) {
	header("Location : login.html");
}
//database connection file
include "db_connect.php";
//select dara
$query = "select * from courses group by name order by id asc;";
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
	                        <button type="button" class='btn-outline-primary rounded active'>Courses</button>
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
	<div class="container" id="show_courses">
		<!-- button to add courses -->
		<!-- <a href="add_course.php"> -->
			<button type="button" class="btn btn-lg btn-primary mb-5 add_course_btn" onclick="return goto_add_course()">ADD COURSES</button>
			<div id="add_course"></div>
		<!-- </a> -->
		<!-- display all the added courses -->
		<form method="post" id="created_courses">
			<table style="border : 1px solid black;">
				<p id="msg"></p>
				<thead>
					<th class="border border-dark">Sr.No.</th>
					<th class="border border-dark">Name of the Course</th>
					<th class="border border-dark">Summary</th>
					<th class="border border-dark">Start date</th>
					<th class="border border-dark">End date</th>
					<th class="border border-dark">Status</th>
					<th class="border border-dark">Action</th>
					<th class="border border-dark">Remove</th>
					<th class="border border-dark">Notes</th>
				</thead>
				<tbody>
					<?php
					if(mysqli_num_rows($result) > 0) { /* check the number of rows fetched by the result*/
						while($row = $result -> fetch_assoc()) { ?>
							<?php $course_id = $row['id']; ?>
							<tr>
								<td> <!-- id of the course -->
									<input type="text" class="form-control" name="id" value="<?php echo $row['id'] ?>">
								</td>
								<td> <!-- name of the student -->
									<!-- function called will save the data on getting change -->
									<input type="text" name="name" required class="form-control name" id="<?php echo $row['id'] ?>" value="<?php echo $row['name'] ?>" onchange="return autosave_name(this.id, this.value)" >
								</td>
							
								<td> <!-- summary of the course -->
									<!-- function called will save the data on getting change -->
									<input type="text" class="form-control summary" name="summary" id="<?php echo $row['id'] ?>" value="<?php echo $row['summary'] ?>" required onchange="return autosave_summary(this.id, this.value)">
								</td>
								<td> <!-- start date of the course -->
									<!-- function called will save the data on getting change -->
									<input type="date" class="form-control start_date" name="start_date" id="<?php echo $row['id'] ?>" value="<?php echo $row['start_date'] ?>" required onchange="return autosave_start_date(this.id, this.value)">
								</td>
								<td> <!-- end date of the course -->
									<span class="error_message" id="end_date_error" style="color : red;"></span>
									<!-- function called will save the data on getting change -->
									<input type="date" class="form-control end_date" name="end_date" id="<?php echo $row['id'] ?>" value="<?php echo $row['end_date'] ?>" required  onchange="return autosave_end_date(this.id, this.value)"> 
								</td>
								<td class="text-center mt-2"> <!-- status -->
									<button type="button" onclick = "return statusChange(this.id)" id="<?php echo $row['id'] ?>">
										<?php
										if($row['status'] == 0) { ?>
											<img src="status_red.png" alt="" width="18px;" height="18px;">
										<?php } else { ?>
											<img src="status_green.png" alt="" width="15px;" height="15px;"> 
										<?php } ?>
									</button>
								</td>



								<!-- bag icon to display the enrolled students in the course -->
								<td class="text-center"> 					
									<button type="button" id="<?php echo $row['id'] ?>" onclick = "return on_click(this.id)"> 
										<img src="bag.png" alt="bag" width="25px" height="25px">
									</button> 
								</td>
								<td>
									<input type="button" id="<?php echo $row['name']; ?>" name="delete_id" class="btn btn-sm btn-primary" value="DELETE" onclick="delete_course(this.id)">
								</td>
								<td class="text-center"> <!-- notes crud  -->
									<!-- <a href="add_delete_files.php?course_name=<?php echo $row['name'] ?>">
									
										<img src="notes_icon2.jpg" alt="" width="25px;" height="25px">
									</a> -->
									<button type="button" id="<?php echo $row['name'] ?>" onclick = "return goto_attachments(this.id)"> 
										<img src="notes_icon2.jpg" alt="" width="25px;" height="25px">
									</button> 
								</td>

							</tr>
							
							
						<?php }
					}
					?>
				</tbody>
			</table>
		</form>

		<div id="enrolled_students"></div>
		<div id="course_attachments"></div>

	</div>

	<!-- <script type="text/javascript" 
            src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js">
    </script> -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script  type="text/javascript">
		/*$(document).ready(function(){
			$("#bag_icon").click(function(){
				$("#enrolled_students").load('course_enrolled_students2.php')
			});
		});*/

		//got to add course
		function goto_add_course() {
			$.ajax({
				url : 'add_course.php',
				type : "POST",
				success : function(data) {
					$("#add_course").html(data);
					$("#navbar").hide();
					$(".add_course_btn").hide();
					$("#created_courses").hide();
				}
			});
		}

		//got to attachments 
		function goto_attachments(id) {
			var course_name = id;
			$.ajax({
				url : 'add_delete_files.php',
				type : "POST",
				data : {
					course_name : course_name
				},
				success : function(data) {
					$("#navbar").hide();
					$("#show_courses").html(data);
					
					$(".add_course_btn").hide();
					$("#created_courses").hide();
				}
			});
		}
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
							/*$("#msg").html("<div class='alert alert-danger'>" + Course not deleted. Please try again... + "</div>");*/
							/*alert("Course not deleted. Please try again...");*/
						} else {
							$("#msg").html("<div class='alert alert-danger'>" + data + "</div>");
							$("#navbar").hide();
							$(".add_course_btn").hide();
							$("#created_courses").load("#created_courses");
						}
					}
				});
			}
		}

		// update status - active or inactive
		function statusChange(id) {
			$id = id;
			var status_id = id; 
			console.log($id);
			$.ajax({
				url : "toggleCourseStatus.php",
				type : "POST",
				data : {
					status_id : status_id
				},
				success : function(data) {
					/*alert(data);*/
					$("#navbar").hide();
					$(".add_course_btn").hide();
					$('#created_courses').load('created_courses.php');
				}
			});
		}

		// bag icon
		/*function on_click(id) {
			$id = id;
			var get_course_id = id; 
			console.log($id);
			$.ajax({
				url : "course_enrolled_students.php",
				type : "POST",
				data : {
					get_course_id : get_course_id
				},
				success : function(data) {
					//$("#navbar").hide();
					//$(".add_course_btn").hide();
					//$('#created_courses').load('created_courses.php');
					document.location.href = 'course_enrolled_students.php';
				}
			});
		}*/

		// bag icon -> enrolled students
		function on_click(id) {
			$id = id;
			var get_course_id = id; 
			console.log($id);

			$.ajax({
				url : 'course_enrolled_students2.php',
				method : "POST",
				data : {
					get_course_id : get_course_id
				},
				success : function(data) {
					/*$("#enrolled_students").load("course_enrolled_students2.php");*/
					/*$("#enrolled_students").html(data);*/
					$("#navbar").hide();
					$("#show_courses").html(data);
					
					$(".add_course_btn").hide();
					$("#created_courses").hide();
				}
			});
		}
		
		//function to save the name
		function autosave_name(id, name) {
			//assign variables to parameter values
			var current_id = id;
			var updated_name = name;
			console.log(id);
			console.log(name);

			if('.name' != '') {
				$.ajax({
					url : "edit_courseDetails.php",
					method : "POST",
					data : {
						current_id : current_id,
						updated_name : updated_name
					},
					success : function(data) {
						$("#msg").html("<div class='alert alert-success'>" + data + "</div>");
					
					},
					error : function(xhr, status, message) {
						$("#err").html("<div class='alert alert-danger'>" + message + "</div>");
					}
				});
			}
		}

		//function to save the summary
		function autosave_summary(id, summary) {
			//assign variables to parameter values
			var current_id = id;
			var updated_summary = summary;

			if('.summary' != '') {
				$.ajax({
					url : "edit_courseDetails.php",
					method : "POST",
					data : {
						current_id : current_id,
						updated_summary : updated_summary
					},
					success : function(data) {
						$("#msg").html("<div class='alert alert-success'>" + data + "</div>");
					
					},
					error : function(xhr, status, message) {
						$("#err").html("<div class='alert alert-danger'>" + message + "</div>");
					}
				});
			}
		}

		//function to save the start date
		function autosave_start_date(id, start_date) {
			//assign variables to parameter values
			var current_id = id;
			var updated_start_date = start_date;

			if('.start_date' != '') {
				$.ajax({
					url : "edit_courseDetails.php",
					method : "POST",
					data : {
						current_id : current_id,
						updated_start_date : updated_start_date
					},
					success : function(data) {
						$("#msg").html("<div class='alert alert-success'>" + data + "</div>");
					
					},
					error : function(xhr, status, message) {
						$("#err").html("<div class='alert alert-danger'>" + message + "</div>");
					}
				});
			}
		}

		//function to save the end date
		function autosave_end_date(id, end_date) {
			//assign variables to parameter values
			var current_id = id;
			var updated_end_date = end_date;

			if('.start_date' > '.end_date') {
				$('#end_date_error').fadeIn().html("Please enter the valid End date");
				setTimeout(function() {
					$('#end_date_error').fadeOut();
				}, 3000);
				$('#end_date').focus();
				return false;
			}
			
			if('.end_date' != '') {
				$.ajax({
					url : "edit_courseDetails.php",
					method : "POST",
					data : {
						current_id : current_id,
						updated_end_date : updated_end_date
					},
					success : function(data) {
						$("#msg").html("<div class='alert alert-success'>" + data + "</div>");
					
					},
					error : function(xhr, status, message) {
						$("#err").html("<div class='alert alert-danger'>" + message + "</div>");
					}
				});
			}
		}
	</script> 
</body>
</html>