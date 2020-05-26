<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Student Information</title>
	<link rel="stylesheet" href="">
</head>
<body>
	<table>
		<tr>
			<th>Name</th>
			<th>Status</th>
			<th>Delete</th>
		</tr>
		<?php 
		include 'db_connect.php';

		$query = 'select * from student_registration';
		$result = mysqli_query($con, $query);
		while($row = mysqli_fetch_array($result)) {
			echo "<tr>";
			echo "<td>" . $row['name'] . "</td>";
			echo "<td>" ?>  
				<img src = 'green.png' alt = "echo $row['status'] " > 
			<?php echo "</td>";
			echo "<td>
				<a href = 'student_info1.php?id=$row[id]' class = 'btn btn-danger' id = 'deletebtn' >Delete</a>	
				</td>";
			echo "</tr>";
		}		
		?>
	</table>

	<script type="text/javascript" 
            src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js">
    </script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#deletebtn').click(function() {
				alert(confirm('Are you sure you want to delete?'));
				$.ajax({
					url : 'student_delete.php',
					type : 'POST',
					data : {
						id : id
					},

					success : function(data) {
						alert(data);
						console.log(id);
						console.log(data);
					}

				});
			});
		});
	</script>
</body>
</html>