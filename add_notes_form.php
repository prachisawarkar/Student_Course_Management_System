<?php
session_start();
if(!isset($_SESSION['valid'])) {
	header("Location : login.html");
}
include 'db_connect.php';
/*$course_name = $_POST['course_name'];*/
$course_name = $_SESSION['id'];
?>

<!DOCTYPE html>
<html>
<head>
	<title>Add Notes</title>
</head>
<body>
	<form method="post" class="rounded add_notes_form mt-5" enctype="multipart/form-data" id="addNotes">
		<div class="form-group">
			<label for="notes" class="ml-3">Upload Notes</label>
			<p  class="text-danger mt-0 ml-3">Note: File extension must be .pdf, .docx, .jpeg, .jpg or .png</p>
			<input type="text" class="text-white h4" name="course_name" value="<?php echo $course_name ?>" id="course_name" style="display: none;"> <!-- give the course name in add_notes.php file -->
			<input type="file" name="notes[]" id="notes" class="form-control" multiple required>
		</div>
		<br>
		<input type="submit" name="submit" value="ADD" id="submit" class="btn btn-primary ml-3">
	</form>

	<!-- <script type="text/javascript" 
            src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js">
    </script> -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script>
		$('#addNotes').submit(function(e) {
			e.preventDefault();
			var file = $('#notes').val();
			var course_name = $("#course_name").val();
			console.log(course_name);
			console.log(file);
			var formdata = new FormData(this);
			console.log(formdata);
			/*$('#submit').attr('disabled', 'disabled');*/
			$.ajax({
				url : 'add_notes.php',
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
						$('#addNotes').load('add_delete_files1.php');

						/*$('#addNotes').load(add_delete_files.php);*/
						/*document.location.href = 'add_delete_files.php';*/
				},
				error : function(e) {
					$("#err").html(e).fadeIn();
				}
			});
		});
	</script>
</body>
</html>