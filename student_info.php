<?php 
session_start();

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
	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
	<table>
		<tr class="border-bottom">
			<th class="border-right">Name</th>
			<th>Email</th>
			<th>Username</th>
			<th>Phone No.</th>
			<th>Address</th>
			<th>Status</th>
			<th>Delete</th>
		</tr>
		<?php 
		while($row = mysqli_fetch_array($result)) { ?>
			<tr class="border-bottom"> 
			<td class="border-right mr-5 border-primary"><?php echo $row['name']?></td>
			<td class="border-right mr-5 border-primary"><?php echo $row['email']?></td>
			<td class="border-right mr-5 border-primary"><?php echo $row['username']?></td>
			<td class="border-right mr-5 border-primary"><?php echo $row['phone_no']?></td>
			<td class="border-right mr-5 border-primary"><?php echo $row['address']?></td>
			<td class="border-right mr-5 border-primary">  
				<img src = 'green.png' alt = "<?php echo $row['status'] ?>" > 
			</td>
			<?php
			echo "<td>
				<a href = 'student_info.php?id=$row[id]' onClick = \"return confirm('Are you sure you want to delete?')\" class = 'btn btn-danger' id = 'deletebtn' >Delete</a>	
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
				$.ajax({
					url : 'student_delete.php',
					type : 'POST',
					data : {
						id : id
					},
					success : function(data) {
						alert(data);
					}

				});
			});
		});
	</script>
</body>
</html>