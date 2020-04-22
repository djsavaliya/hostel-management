<?php 
	include '../config/db_connect.php';

	$sql = 'SELECT first_name,last_name,mobile,email,hostels.hostel_name FROM managers,hostels WHERE managers.hostel_id=hostels.hostel_id';

	$result = mysqli_query($conn,$sql);

	$managers = mysqli_fetch_all($result,MYSQLI_ASSOC);

	mysqli_free_result($result);
	mysqli_close($conn);
 ?>

<!DOCTYPE HTML>
<html>
	<?php include('templates/header.php'); ?>

	<h4 class="center grey-text">Managers' Contact Info</h4>
	<div class="container">
		<div class="row">
			<?php foreach($managers as $manager):?>
				<div class="col s4 md3">
					<div class="card z-depth-0">
						<div class="card-content center">
							<h5><?php echo htmlspecialchars($manager['first_name']);echo(" ");echo htmlspecialchars($manager['last_name'])?></h5>
							<h6><?php echo htmlspecialchars($manager['mobile'])?></h6>
							<h6><?php echo htmlspecialchars($manager['email'])?></h6>
							<h6><?php echo htmlspecialchars($manager['hostel_name'])?></h6>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>

	<?php include('templates/footer.php'); ?>
</html>
