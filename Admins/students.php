<?php 

$con=mysqli_connect('localhost','Dhruv','u18co019#hmsproject','hms');

$display=array();

if($con)
{
	
	$sql_q1="SELECT * FROM students ORDER BY hostel_id";
	$sql_q2="SELECT * FROM hostels";

	$result1=mysqli_query($con,$sql_q1);
	$result2=mysqli_query($con,$sql_q2);

	$students=mysqli_fetch_all($result1,MYSQLI_ASSOC);
	$hostels=mysqli_fetch_all($result2,MYSQLI_ASSOC);

	foreach($hostels as $hostel)
	{
		if(isset($_POST[$hostel['hostel_id']]))
		{
			foreach($students as $student)
			{
				if($student['hostel_id']==$hostel['hostel_id'])
				{
					$to_push=array("name"=>$student['first_name'].' '.$student['last_name'],"hostel_name"=>$hostel['hostel_name'],"email"=>$student['email'],"mobile"=>$student['mobile'],"college_id"=>$student['college_id'],
						"dob"=>$student['date_of_birth']);

					$display[]=$to_push;
				}
			}
			break;
		}
	}
	
}

mysqli_close($con);

?>

<!DOCTYPE html>

    <?php require('header.php'); ?>

	<div style="text-align: center;">

		<h1>
			<u>Student Details</u>
		</h1>

	</div>

	<form action="adminStudentinfo.php" method="post">

		<?php foreach($hostels as $hostel){ ?>

			<div>

				<input style="float: left;" type="submit" value="<?php echo htmlspecialchars($hostel['hostel_name']); ?>" 
				name="<?php echo htmlspecialchars($hostel['hostel_id']); ?>">

			</div>


		<?php } ?>

	</form>
	<div style="text-align: center;">

		<?php if(count($display)>0){ ?>
			<table>
				<tr rowspan=2>
					<td><b>CollegeId</b></td>
					<td><b>Name</b></td>
					<td><b>Email</b></td>
					<td><b>Phone</b></td>
					<td><b>Date Of Birth</b></td>
				</tr>


				<?php foreach($display as $student) {?>

						<tr>
							<td><?php echo $student['college_id']; ?></td>
							<td><?php echo $student['name']; ?></td>
							<td><?php echo $student['email']; ?></td>
							<td><?php echo $student['mobile']; ?></td>
							<td><?php echo $student['dob']; ?></td>
						</tr>

				<?php } ?>
			</table>
		<?php } ?>
	</div>

	<?php require('footer.php'); ?>
	
</html>
