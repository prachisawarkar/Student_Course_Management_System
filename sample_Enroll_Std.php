<!-- <td class="text-center"> 
		<?php
		echo "<a href=\"course_enrolled_students.php?id=$row[id]\">"; ?>
			<img src="bag.png" alt="bag" width="25px" height="25px">
		<?php echo "</a>";
		?>	
	</td> -->


#########################################


<!-- <div id="enrolled_students">
		<?php 
		$course_id = $row['id'];
		echo $course_id;
		$query = "select sc.id as id, u.name as name, u.email as email, u.username as 1 u.phone_no as phone_no, sc.status as status from users u join my_courses sc on u.id = sc.student_id where course_id = 9";
		$result = mysqli_query($con, $query); 
		?>
		<p><?php echo $row['id'] ?></p>
		<table>
			<thead>
				<tr>
					<td>
						Id
					</td>
					<td>
						Name 
					</td>
					<td>
						Email
					</td>
					<td>
						Username
					</td>
					<td>
						Phone Number
					</td>
					<td>
						Status
					</td>
				</tr>
			</thead>
			<tbody>
		<?php while($row = $result -> fetch_assoc()) { ?>
				<tr> // student information 
					<td>
						<?php echo $row['id']; ?>
					</td>
					<td>
						<?php echo $row['name']; ?>
					</td>
					<td>
						<?php echo $row['email']; ?>
					</td>
					<td>
						<?php echo $row['username']; ?>
					</td>
					<td>
						<?php echo $row['phone_no']; ?>
					</td>

					<?php $status = $row['status']; ?> 

					<td class="text-center"> // status of the course for the student 
						<button type="button" onclick = "return statusChange(this.id)" id="<?php echo $row['id'] ?>">
							<?php 
							if($status == 1) { ?>
								<img src="status_green.png" alt="" width="15px" height="15px">
							<?php } else { ?>
								<img src="status_red.png" alt="" width="18px" height="18px">
							<?php } ?>
						</button>
					</td>
				</tr>
		<?php } ?>
			</tbody>
		</table>
	</div> -->