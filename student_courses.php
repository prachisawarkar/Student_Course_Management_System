<?php
session_start();
if(!$_SESSION['valid']) {
	header("Location:login.html");
}
include 'db_connect.php';
$query = "select * from add_course";
$result = mysqli_query($con, $query);

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
	<h1 class="text-primary">All Courses</h1>
	<?php
	/*echo date('yy-m-d');*/ 

	while($row = mysqli_fetch_array($result)) {
		if($row['start_date'] > date('yy-m-d')) { ?>
			<form method="post">
				<div class="form-group border">
					<input type="text" name="id" disabled="true" id="id" class="form-control course_id bg-white" value="<?php echo $row['id']?>">

					<input type="text" name="name" disabled="true" id="name" class="form-control course_title bg-white" value="<?php echo $row['name']?>">
					
					<textarea name="summary" disabled="true" id="summary" class="form-control bg-white float-left">
						<?php echo $row['summary'] ?>
					</textarea>
					<br>
					<input type="date" name="start_date" disabled="true" id="start_date" class="form-control bg-white" value="<?php echo $row['start_date'] ?>">
					
					<input type="date" name="end_date" disabled="true" class="form-control bg-white" id="end_date" value="<?php echo $row['end_date'] ?>">	

					<!--<?php echo "<div class='col-md-4'>
						<a href=\"add_mycourses.php?id=$row[id]\">ENROLL NOW
						</a>
					</div>" ?> -->
					<br>
					<input type="button" name="enroll_now" id="enroll_now" value="ENROLL NOW" class="btn btn-primary mb-3">
				</div>
				
			</form>
			<br>
		<?php } else { ?>
			<div class="row border disabled">
				<div class="col-md-8">
					<h3> <?php echo $row['name'] ?> </h3>
					<p> <?php echo $row['summary'] ?> </p>
					<p> <?php echo $row['start_date'] . " to " . $row['end_date'] ?> </p>
				</div>
				<div class="col-md-4">
					<input type="button" name="enroll_now" value="ENROLL NOW" class="btn btn-primary mb-3" disabled="true">
				</div>
			</div>
		<?php }
	} ?>

	<script type="text/javascript" 
            src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js">
    </script>
    <script type="text/javascript">
		$(document).ready(function() {
			$('#enroll_now').click(function() {
				var id = $('#id').val();
				var name = $('#name').val();
				var summary = $('#summary').val();
				var start_date = $('#start_date').val();
				var end_date = $('#end_date').val();

				$.ajax({
					url : 'insert_mycourses.php',
					type : "POST",
					data : {
						id : id,
						name : name,
						summary : summary,
						start_date : start_date,
						end_date : end_date
					},
					success : function(data) {
						alert(data);
						document.location.href = "student_my_courses.php";
					}
				});
			});
		});
	</script>
</body>
</html>
