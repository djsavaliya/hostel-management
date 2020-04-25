<?php 
	require 'session.php';

	$sql = 'SELECT * FROM hostels';
	$result = mysqli_query($conn,$sql);
	$hostels = mysqli_fetch_all($result,MYSQLI_ASSOC);

	$error='';
	if($student['hostel_id']==NULL)
		$status='Not applied';
	else
		$status='You are a hostelite';

	
	foreach($hostels as $hostel):
		//echo 'happenin';
		if(isset($_POST[$hostel['hostel_id']])){
			$rooms = $hostel['no_of_rooms'];
			$students = $hostel['no_of_students'];
			if($students>=$rooms){
				$error = '*'.$hostel['hostel_name'].' is full';
			}
			else{
				if($conn)
				{
						$hid = $hostel['hostel_id'];
						$sid = $student['student_id'];

						$check=true;

						$sql_check= "SELECT * FROM applications WHERE student_id='$sid' ";
						$result = mysqli_query($conn,$sql_check);
						if(mysqli_num_rows($result)>0)
						{
							$check=false;
							if($student['hostel_id']==NULL)
								$status='Applied but not yet accepted';
							else
								$status='You are a hostelite';
						}

						if($check)
						{
							$sql1 = "INSERT INTO applications VALUES (NULL,'$sid','$hid')";
							$result1 = mysqli_query($conn,$sql1);
							//if($result1==true){$error='true';}else{$error='false';}
							if($result1)
							{
								$error = 'Applied for '.$hostel['hostel_name'].'.';
								$status='Applied but not yet accepted';
							}
							else
							{
								$error = 'Unknown Error occured.';
							}
				        }
				        else
				        {
				        	$error='Already applied for a hostel';
				        }
				}
				else{
					echo 'Unable to connect to the database.';
				}
			}
			break;
		}
	endforeach;

	mysqli_free_result($result);
	mysqli_close($conn);
 ?>


<!DOCTYPE HTML>
<html>
	
	<style>
		form{
			width: 100%;
			border-style: solid;
		}
	</style>

	<?php include('templates/header.php'); ?>
	<b style="color:red;"><?php echo $status; ?></b>
	<form action="apply.php" method="post">
		<h4 class="center grey-text">Apply For Hostels</h4>
		<div class="container">
			<div class="row">
				<div style="color:red;"><?php echo $error; ?></div>
				<?php foreach($hostels as $hostel):?>
					<div class="col s12 md3">
						<div class="card z-depth-0">
							<div class="card-content center">
								<h4><?php echo htmlspecialchars($hostel['hostel_name']);?></h4>
								<div class="center">
									<button type="submit" name="<?php echo htmlspecialchars($hostel['hostel_id']); ?>" class="btn brand z-depth-0">Apply</button>
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
