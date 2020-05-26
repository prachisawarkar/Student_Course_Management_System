<?php
session_start();
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
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
	<h1 class="text-primary">All Courses</h1>
	<?php
	/*echo date('yy-m-d');*/ 

	while($row = mysqli_fetch_array($result)) {
		if($row['start_date'] > date('yy-m-d')) { ?>
			<div class="row border">
				<div class="col-md-8">
					<h3> <?php echo $row['name'] ?> </h3>
					<p> <?php echo $row['summary'] ?> </p>
					<p> <?php echo $row['start_date'] . " to " . $row['end_date'] ?> </p>
				</div>

				<?php echo "<div class='col-md-4'>
					<a href=\"add_mycourses.php?id=$row[id]\">ENROLL NOW
					</a>
				</div>" ?>

				<!-- <div class="col-md-4">
					<input type="button" name="enroll_now" value="ENROLL NOW" class="btn btn-primary mb-3">
				</div> -->
			</div>
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

	<script></script>
</body>
</html>
