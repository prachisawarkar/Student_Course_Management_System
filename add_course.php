<?php
session_start();
if(!isset($_SESSION['valid'])) {
	header('Location : login.html');
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Add course</title>
	<link rel="stylesheet" type="text/css" href="style.css">
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
	</div>
	<div class="container">
		<h1>Add Courses</h1>
		<!-- form to add the course -->
		<form method="post" action="add_coursefile.php" name="course_form" id="course_add_form" enctype="multipart/form-data">
			<!-- name of the course -->
			<div class="form-group">
				<label for="course_name">Name of the course
				</label>
				<span class="required">*</span>
				<!-- to show the error -->
				<span class="error_message" id="course_name_error"></span>
				<input type="text" name="name" id="name" placeholder="Course Name" class="form-control">
			</div>
			<!-- summary of the course -->
			<div class="form-group">
				<label for="summary">
					Summary
				</label>
				<span class="required">*</span>
				<!-- to show the error -->
				<span class="error_message" id="summary_error"></span>
				<textarea name="summary" id="summary" placeholder="Summary" class="form-control"></textarea>
			</div>
			<!-- start date of the course -->
			<div class="form-group">
				<label for="start_date">
					Start Date
				</label>
				<span class="required">*</span>
				<!-- to show the error -->
				<span class="error_message" id="start_date_error"></span>
				<input type="date" name="start_date" id="start_date" placeholder="Start date" class="form-control">
			</div>
			<!-- end date of the course -->
			<div class="form-group">
				<label for="end_date">
					End Date
				</label>
				<span class="required">*</span>
				<!-- to show the error -->
				<span class="error_message" id="end_date_error"></span>
				<input type="date" name="end_date" id="end_date" placeholder="End date" class="form-control">
			</div>
			<!-- to upload the multiple notes -->
			<div class="form-group">
				<label for="notes">Upload Notes</label>
				<input type="file" name="notes[]" id="notes" class="form-control" multiple>
			</div>
			<br>
			<!-- button to submit the form -->
			<input type="submit" name="add" value="ADD" id="add" class="btn btn-primary">

		</form>
	</div>
	<!-- <script type="text/javascript" 
            src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js">
    </script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#add').click(function() {
				var name = $('#name').val();
				var summary = $('#summary').val();
				var start_date = $('#start_date').val();
				var end_date = $('#end_date').val();
				var file = $('#notes').val();

				if($.trim(name) == '') {
					$('#course_name_error').fadeIn().html("Please Enter the Course name");
					setTimeout(function() {
						$('#course_name_error').fadeOut();
					}, 3000);
					$('#name').focus();
					return false;
				}

				if($.trim(summary) == '') {
					$('#summary_error').fadeIn().html("Please enter the course summary");
					setTimeout(function() {
						$('#summary_error').fadeOut();
					}, 3000);
					$('#summary').focus();
					return false;
				}

				if($.trim(start_date) == '') {
					$('#start_date_error').fadeIn().html("Please enter the Start date");
					setTimeout(function() {
						$('#start_date_error').fadeOut();
					}, 3000);
					$('#start_date').focus();
					return false;
				}

				if($.trim(end_date) == '') {
					$('#end_date_error').fadeIn().html("Please enter the End date");
					setTimeout(function() {
						$('#end_date_error').fadeOut();
					}, 3000);
					$('#end_date').focus();
					return false;
				}

				/*var data = $('form').serialize();*/

				/*$('#add').attr('disabled', 'disabled');
				$.ajax({
					url : 'add_coursefile.php',
					type : "POST",
					data : {
						name : name,
						summary : summary,
						start_date : start_date,
						end_date : end_date
						notes : notes
					} $('#course_add_form').serialize(),
					success : function(data) {
						alert(data);
						document.location.href = "add_course.php";
					}
				});*/
			});
		});
	</script> -->
</body>
</html>