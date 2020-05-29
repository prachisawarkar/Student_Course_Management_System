<?php 
session_start();
if(!isset($_SESSION['valid'])) {
	header("Location : login.html");
}
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

    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
	<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>


    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  	<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
  	<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet"> -->
 
</head>
<body>
	<table>
		<tr class="border-bottom">
			<th>Sr.No.</th>
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
				<form> 
					<td>
						<input type="text" name="id" id="id" value="<?php echo $row['id'] ?>">
					</td>

					<td class="border-right mr-5 border-primary">
						<?php echo $row['name']?>
					</td>
					<td class="border-right mr-5 border-primary">
						<input type="email" class="border-0 text-center" name="email" id="email" value="
						<?php echo $row['email']?>" >
					</td>
					<td class="border-right mr-5 border-primary">
						<?php echo $row['username']?>
					</td>
					<td class="border-right mr-5 border-primary">
						<input type="text" class="border-0 text-center" name="phone_no" id="phone_no" value="
						<?php echo $row['phone_no']?> " >
					</td>
					<td class="border-right mr-5 border-primary"><?php echo $row['address']?>
					</td>
					
					<!-- <a href="student_info3.php">
						<td class="border-right mr-5 border-primary" id="status"><?php echo $row['status']?>
						</td>
					</a> -->
					<?php $id = $row['id'] ?>
					<?php echo 'mybtn'.$id ?>
					<td>
						<button type="button" class="mybtn" id="<?php echo $row['id'] ?>"><?php echo $row['status'] ?> <?php echo $row['id'] ?></button>
					</td> 

					<!-- <td>
						<?php echo 
						"<button type='button' data-id='{{ $id }}'>". $row['status'] ." </button>";
						?>
					</td> -->

					<!-- <td>
					<?php
					echo "<a href='student_info3ajax.php?id=$row[id]'>" . $row['status'] . "</a>";

					?>
					</td> -->

					<!-- <?php
					$status = $row['status']; 
					print_r($status);
					?>
					<td>
						<input type="image" id="status" src="status_<?php if($status == '1') {echo 'green';} else {echo 'red';}?>.png" name = "status" value="<?php echo $status;?>" />
					</td> --> 

					<!-- <td>
						<input type="checkbox"  name="status" id="status" checked>
		    		</td>		
		    		<input type="hidden" name="hidden_status" id="hidden_status" checked data-toggle="toggle" value="1"/>	 -->	
					<?php
					echo "<td>
						<a href = 'student_info.php?id=$row[id]' onClick = \"return confirm('Are you sure you want to delete?')\" class = 'btn btn-danger' id = 'deletebtn' >Delete</a>	
					</td>"; ?>
				</form>
			<?php echo "</tr>";
		}		
		?>
		</table>

	<script type="text/javascript" 
            src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js">
    </script>
	<script type="text/javascript">
		$(document).ready(function() {
			/*$('#deletebtn').click(function() {
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
			});*/
			function autosave() {

				var email = $("#email").val();
				var phone_no = $("#phone_no").val();

				$.ajax({
					url : "autosave_stud_profile_data.php",
					method : "POST",
					data : {
						email : email,
						phone_no : phone_no
					},
					success : function(data) {
						//$('p').append(data);
						alert(data);
					}
				});
			}
			setInterval(function() {
				autosave();
			}, 10000);

			// bootstrap toggle
			/*$('#status').bootstrapToggle({
				on:'1',
				off : '0',
				onStyle : 'success',
				offStyle : 'danger'
			});
			$('#status').change(function() {
				if($(this).prop('checked')) {
					$('#hidden_status').val("1");
				} else {
					$('#hidden_status').val('0');
				}
			});

			$("#status").on('click', function(event) {
				$.ajax({
					url : "toggleStatus.php",
					method : "POST",
					data : {
						status : status
					},
					success : function(data) {
						if(data == 'done') {
							$('#status').bootstrapToggle('1');
							alert("data saved");
						} else {
							alert(data);
						}
					}
				});
			});*/
			/*$(".mybtn").click(function() {
				alert($(this).attr('id'));
				$.ajax({
					url : "toggleStatus.php",
					method : "post",
					success : function(data) {
						alert(data);
						document.location.href = "student_info3.php";
					}
				});
			});*/

			/*$(document).on('click', 'button[data-id]', function(e) {
				alert($(this).attr('data-id'));
				$.ajax({
					url : "toggleStatus.php",
					method : "post",
					success : function(data) {
						alert(data);
						document.location.href = "student_info3.php";
					}
				});
			});*/

			$(".mybtn").mouseover(function() {
				/*alert($(this).attr('id'));*/
				var id = $(this).attr('id');
				console.log("#"+id);

				$('#'+id).click(function(){
					$.ajax({
						url : "toggleStatus.php",
						method : "post",
						success : function(data) {
							alert(data);
							document.location.href = "student_info3.php";
						}
					});
				});
			});
		});
	</script>
</body>
</html>