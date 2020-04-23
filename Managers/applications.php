<?php 
	require 'session.php';

	$sql = 'SELECT * FROM applications,students,hostels WHERE (applications.student_id = students.student_id) AND (applications.hostel_id = hostels.hostel_id)';
	$result = mysqli_query($conn,$sql);
	$applications = mysqli_fetch_all($result,MYSQLI_ASSOC);

	$error = '';
	foreach($applications as $application):
		//echo 'happenin';
		if(isset($_POST[$application['student_id']])){
			$students = $application['no_of_students']+1;
			$hid = $application['hostel_id'];
			$sid = $application['student_id'];
			$aid = $application['application_id'];
			$sql1 = "UPDATE hostels SET no_of_students = '$students' WHERE hostels.hostel_id = '$hid'";
			$result1 = mysqli_query($conn,$sql1);
			//if($result1==true){$error='true';}else{$error='false';}
			$sql2 = "UPDATE students SET hostel_id = '$hid' WHERE students.student_id = '$sid'";
			$result2 = mysqli_query($conn,$sql2);
			//if($result1==true){$error='true';}else{$error='false';}
			$sql3 = "DELETE FROM applications WHERE applications.application_id = '$aid'";
			$result3 = mysqli_query($conn,$sql3);
			//if($result1==true){$error='true';}else{$error='false';}
			break;
		}
		if(isset($_POST[$application['hostel_id']])){
			$aid = $application['application_id'];
			$sql4 = "DELETE FROM applications WHERE applications.application_id = '$aid'";
			$result4 = mysqli_query($conn,$sql4);
			//if($result1==true){$error='true';}else{$error='false';}
			break;
		}
	endforeach;

	$sql = 'SELECT * FROM applications,students,hostels WHERE (applications.student_id = students.student_id) AND (applications.hostel_id = hostels.hostel_id)';
	$result = mysqli_query($conn,$sql);
	$applications = mysqli_fetch_all($result,MYSQLI_ASSOC);

	mysqli_free_result($result);
	mysqli_close($conn);
 ?>

<!DOCTYPE HTML>
<html>
	<?php include('templates/header.php'); ?>

	<form action="applications.php" method="post">
		<h4 class="center grey-text">Applications</h4>
		<div class="container">
			<div class="row">
				<div style="color:red;"><?php echo $error; ?></div>
				<?php foreach($applications as $application):?>
					<div class="col s12 md3">
						<div class="card z-depth-0">
							<div class="card-content center">
								<h5><?php echo htmlspecialchars($application['first_name'].' '.$application['last_name']);?></h5>
								<h6><?php echo htmlspecialchars($application['hostel_name'])?></h6>
								<div class="center">
									<button type="submit" name="<?php echo htmlspecialchars($application['student_id']); ?>" class="btn brand z-depth-0">Accept</button>
									<button type="submit" name="<?php echo htmlspecialchars($application['hostel_id']); ?>" class="btn brand z-depth-0">Reject</button>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</form>

	<?php include('templates/footer.php'); ?>
</html>