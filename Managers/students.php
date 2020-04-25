<?php 
	require 'session.php';

	$hid = $manager['hostel_id'];
	$sql1 = "SELECT * FROM students WHERE hostel_id = '$hid'";
	$result1 = mysqli_query($conn,$sql1);
	$students = mysqli_fetch_all($result1,MYSQLI_ASSOC);

	$sql2 = "SELECT * FROM hostels WHERE hostels.hostel_id = '$hid'";
	$result2 = mysqli_query($conn,$sql2);
	$hostel = mysqli_fetch_assoc($result2);
	//print_r($hostel);

	if($conn)
	{
		$delete_success=false;
		if(isset($_POST['delete']))
		{
			$c = 0;
			foreach($students as $student)
			{
				if(isset($_POST[$student['college_id']]))
				{
					$c++;

					$id_to_delete=$student['college_id'];
					$sql_to_delete = " DELETE FROM students WHERE college_id='$id_to_delete' ";
					$result4 = mysqli_query($conn,$sql_to_delete);
				}
			}
			$number = $hostel['no_of_students'];
			$number = $number - $c;
			$sql3 = "UPDATE hostels SET no_of_students = '$number' WHERE hostels.hostel_id = '$hid'";
			$result3 = mysqli_query($conn,$sql3);
		}
		$hid = $manager['hostel_id'];
		$sql_q1="SELECT * FROM students WHERE hostel_id = '$hid'";
		$result1=mysqli_query($conn,$sql_q1);
		$students=mysqli_fetch_all($result1,MYSQLI_ASSOC);

		$sql2 = "SELECT * FROM hostels WHERE hostel_id = '$hid'";
		$result2 = mysqli_query($conn,$sql1);
		$hostel = mysqli_fetch_all($result1,MYSQLI_ASSOC);
		
	}

	mysqli_close($conn);

?>

<!DOCTYPE html>
<html>
	<?php include('templates/header.php'); ?>

	<style>
		span{
			font-size: 20px !important;
			color: black;
		}
	</style>

	<h4 class="center grey-text">Students</h4>
	<div class="z-depth=0">
		<form action="students.php" method="post">
				<?php foreach($students as $student): ?>
					<p>
						<label for="<?php echo $student['college_id'];?>">
							<tr>
								<td><input type="checkbox" id="<?php echo $student['college_id'];?>" name="<?php echo $student['college_id'];?>"></td>
								<td><span><?php echo $student['first_name'].'	'.$student['last_name'] ?></span></td>
								<td><span><?php echo '('.$student['college_id'].')'.'['.$student['mobile'].']'?></span></td>
							</tr>
						</label>
					</p>
				<?php endforeach; ?>
			<center><button type="submit" name="delete" class="btn brand z-depth-0">Remove Students</button></center>
		</form>
	</div>

	<?php include('templates/footer.php'); ?>
</html>
