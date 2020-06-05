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
		<h1>Add Course</h1>
		<!-- form to add the course -->
		<form method="post" name="course_form" id="course_add_form" enctype="multipart/form-data">
			<p id="msg"></p>
			<!-- name of the course -->
			<div class="form-group">
				<label for="course_name">Name of the course
				</label>
				<span class="required">*</span>
				<!-- to show the error -->
				<span class="error_message" id="course_name_error"></span>
				<input type="text" name="name" id="name" placeholder="Course Name" class="form-control" required>
			</div>
			<!-- summary of the course -->
			<div class="form-group">
				<label for="summary">
					Summary
				</label>
				<span class="required">*</span>
				<!-- to show the error -->
				<span class="error_message" id="summary_error"></span>
				<textarea name="summary" id="summary" placeholder="Summary" class="form-control" required></textarea>
			</div>
			<!-- start date of the course -->
			<div class="form-group">
				<label for="start_date">
					Start Date
				</label>
				<span class="required">*</span>
				<!-- to show the error -->
				<span class="error_message" id="start_date_error"></span>
				<input type="date" name="start_date" id="start_date" placeholder="Start date" class="form-control" required>
			</div>
			<!-- end date of the course -->
			<div class="form-group">
				<label for="end_date">
					End Date
				</label>
				<span class="required">*</span>
				<!-- to show the error -->
				<span class="error_message" id="end_date_error"></span>
				<input type="date" name="end_date" id="end_date" placeholder="End date" class="form-control" required>
			</div>
			<!-- to upload the multiple notes -->
			<div class="form-group">
				<label for="notes" class="mb-0">Upload Notes</label>
				<p  class="text-danger mt-0">Note: File extension must be .pdf, .docx, .jpeg, .jpg or .png</p>
				<span class="error_message" id="file_error"></span> <!-- to show the error -->
				<input type="file" name="notes[]" id="notes" class="form-control" multiple>
			</div>
			<br>
			<!-- button to submit the form -->
			<input type="submit" name="submit" value="ADD" id="submit" class="btn btn-primary">

		</form>
	</div>
	<script type="text/javascript" 
            src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js">
    </script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#course_add_form').submit(function(e) {
				e.preventDefault();
				var name = $('#name').val();
				var summary = $('#summary').val();
				var start_date = $('#start_date').val();
				var end_date = $('#end_date').val();
				var file = $('#notes').val();
				var filename_pattern = /^\S*$/;
				if(start_date > end_date) {
					$('#end_date_error').fadeIn().html("Please enter the valid End date");
					setTimeout(function() {
						$('#end_date_error').fadeOut();
					}, 3000);
					$('#end_date').focus();
					return false;
				}

				if(!filename_pattern.test(file)) {
                    $('#file_error').fadeIn().html('File name should not contain spaces');
                    setTimeout(function() {
                        $('#file_error').fadeOut();
                    }, 3000);
                    $('#notes').focus();
                    return false;
                }

				var formdata = new FormData(this);

				$('#submit').attr('disabled', 'disabled');
				$.ajax({
					url : 'add_coursefile.php',
					type : "POST",
					data : formdata,
					contentType : false,
					processData : false,
					cache : false,
					beforeSend : function() {
						$("#err").fadeOut();
					},
					success : function(data) {
						$("#msg").html("<div class='alert alert-danger'>" + data + "</div>");
						$('#course_add_form').load('created_courses.php');
					},
					error : function(e) {
						$("#err").html(e).fadeIn();
					}
				});
			});
		});
	</script> 
</body>
</html>