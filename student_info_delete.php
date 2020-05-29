<?php 
/*session_start();
if(!isset($_SESSION['valid'])) {
	header("Location : login.html");
}*/
include 'db_connect.php';

$query = 'select * from student_registration';
$result = mysqli_query($con, $query);
/*$row = $result -> fetch_assoc();*/

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Student Information</title>
	<link rel="stylesheet" href=""> 
</head>
<body>
	<form action="student_info_submit" method="post" accept-charset="utf-8" id="student_info">
		<table style="border:1px solid:red">
			<thead class="text-white">
				<th>Id</th>
				<th>Name</th>
				<th>Email</th>
				<th>Phone No.</th>
				<th>Status</th>
				<th>Action</th>
			</thead>
			<tbody>
				<?php 
				$count = 0;
				if($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) { ?>
						<tr class="">
							<td>
								<input type="text" name="id" value="<?php echo $row['id']; ?>" >
							</td>
							<td>
								<input type="text" name="name" value="<?php echo $row['name']; ?>" >
							</td>
							<td>
								<input type="email" name="email" value="<?php echo $row['email']; ?>" >
							</td>
							<td>
								<input type="text" name="phone_no" value="<?php echo $row['phone_no'] ?>" >
							</td>
							<td>
								<input type="text" name="address" value="<?php echo $row['address'] ?>" >
							</td>
							<td>
								<input type="text" name="status" value="<?php $row['status'] ?>" >
							</td>
							<td>
								<input type="button" name="delete_id" id="<?php echo $row['id'] ?>" value = "DELETE" onclick = "return on_click(this.id)" >
							</td>
						</tr>
						<?php
					}
				} else {
					echo "No students have registered yet!";
				}
				?>
			</tbody>
		</table>
	</form>

	<script type="text/javascript" 
            src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js">
    </script>
	<script type="text/javascript">
		function on_click(id) {
			$id = id;
			var delete_id = id;
			console.log($id);
			$.ajax({
				type : "POST",
				url : "student_delete.php",
				data : {delete_id : delete_id},
				success : function(data) {
					if(data == 1) {
						alert("Student record not deleted");
					} else {
						confirm("Are you sure you want to delete ?");
						//remove from the table
						$('#student_info').load('student_info_delete.php');
					}
				}
			});
		}
	</script>
</body>
</html>