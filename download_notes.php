<?php
//database connection file
include 'db_connect.php';
//get the course name
$course_name = $_GET['course_name'];
//fetch the data of the given course name
$query = "select * from courses where name = '$course_name'";
$result = mysqli_query($con, $query); 
$row = $result -> fetch_assoc();
$course_id = $row['id'];

$sel_query = "select * from course_attachments where course_id = '$course_id'";
$result1 = mysqli_query($con, $sel_query);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Download Notes</title>
</head>
<style>
	td {
		border: 1px solid black;
	}
</style>
<body>
	<table>
		<thead>
			<tr>
				<th>Notes</th>
				<th>Download</th>
			</tr>
		</thead>
		<tbody>
		<?php
		//checking the number of rows
		if($result1->num_rows > 0) { 
			while($row1 = mysqli_fetch_array($result1)) { ?>
				<tr>
					<td>
						<p class="text-white"><?php echo $row1['notes'] ?></p>
					</td>
					<td>
						<a href="file_download.php?file_id=<?php echo $row1['id'] ?>">Download</a> 
					</td>
				</tr>
			<?php }
		} else { ?>
			<h3>No notes are available for this course.</h3>
		<?php } ?>
	</tbody>
</body>
</html>

