<?php
session_start();
if(!$_SESSION['valid']) {
	header("Location:login.html");
}
//database connection file
include 'db_connect.php';
//select data
$query = "select * from add_course group by name order by id asc";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Courses</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
	</div>
	<!-- display all the added courses -->
	<div class="container">
		<h1 class="text-primary mb-3">All Courses</h1>

		<form method="post" action="student_courses.php" id="student_courses">
			<div class="row">
				<?php
				if($result->num_rows > 0) {
					while($row = $result ->fetch_assoc()) {
						//if the start date of the course has gone then it will show disable otherwise enable
						if($row['start_date'] > date('yy-m-d')) { ?> 
					
							<div class="form-group border bg-dark text-white text-justify col-md ml-5">
								<!-- id of the course -->
								<input type="text" name="id" disabled="true" id="id" class="course_id border-0 bg-dark text-white ml-5" value="<?php echo $row['id']?>">

								<br>
								<!-- name of the course -->
								<input type="text" name="name" disabled="true" id="name" class="course_title border-0 bg-dark h3 text-white ml-5" value="<?php echo $row['name']?>">
								
								<br>
								<!-- summary of the course(hidden) -->
								<textarea name="summary" disabled="true" id="summary" class="border-0 float-left summary bg-dark text-white ml-5" style="display: none;" >
									<?php echo $row['summary'] ?>
								</textarea>

								<br>
								<!-- start date of the course -->
								<span class="ml-5">Start date: </span>
								<input type="date" name="start_date" disabled="true" id="start_date" class="form-control border-0 bg-dark text-white text-center" value="<?php echo $row['start_date'] ?>">
								
								<!-- end date of the course -->
								<span class="ml-5">End date:</span>
								<input type="date" name="end_date" disabled="true" class="form-control border-0 bg-dark text-center text-white" id="end_date" value="<?php echo $row['end_date'] ?>">

								<br>
								<!-- button to enroll in the course -->
								<input type="button" class="btn btn-outline-primary font-weight-bold mb-3 ml-5" name="enroll_id" id="<?php echo $row['id']; ?>" value="ENROLL NOW" onclick = "return on_click(this.id)" >
							</div>
							<br>
						<?php } else { ?>

							<div class="form-group border bg-dark text-white text-justify col-md ml-5">
								<!-- id of the course -->
								<input type="text" name="id" disabled="true" id="id" class="course_id border-0 bg-dark text-white" value="<?php echo $row['id']?>">

								<br>
								<!-- nam eof the course -->
								<input type="text" name="name" disabled="true" id="name" class="course_title border-0 bg-dark text-white" value="<?php echo $row['name']?>">
								
								<br>
								<!-- summary of the course(hidden) -->
								<textarea name="summary" disabled="true" id="summary" class="border-0 bg-dark text-white float-left summary" style="display: none;" >
									<?php echo $row['summary'] ?>
								</textarea>
								
								<br>
								<!-- start date of the course -->
								<p class="m-0">Start date:</p>
								<input type="date" name="start_date" disabled="true" id="start_date" class="form-control bg-dark text-white border-0" value="<?php echo $row['start_date'] ?>">
								
								<!-- end date of the course -->
								<p class="m-0">End date:</p>
								<input type="date" name="end_date" disabled="true" class="form-control border-0 bg-dark text-white" id="end_date" value="<?php echo $row['end_date'] ?>">	

								<br>
								<!-- button to enroll is disable -->
								<input type="button" class="btn btn-outline-primary font-weight-bold disabled mb-3" name="enroll_id" id="<?php echo $row['id'] ?>" value="ENROLL NOW">

								<p style="color: red;">Registration Ends <br>Course Expired</p>
							</div>
						<?php }
					} 
				} else {
					echo "No course is created!";
				} ?>
			</div>
		</form> 
	</div>

	<script type="text/javascript" 
            src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js">
    </script>
    <script type="text/javascript">
    	//function to execute on click of the enroll button
		function on_click(id) {
			$id = id;
			var enroll_id = id;
			var id = $('#id').val();
			var name = $('#name').val();
			var summary = $('#summary').val();
			var start_date = $('#start_date').val();
			var end_date = $('#end_date').val();
			console.log($id, name, summary, start_date, end_date);
			$.ajax({
				url : 'insert_mycourses.php',
				type : "POST",
				data : {
					enroll_id : enroll_id
				},
				success : function(data) {
					alert(data);
					document.location.href = "student_my_courses.php";
				}
			});
		}
	</script>
	
</body>
</html>
