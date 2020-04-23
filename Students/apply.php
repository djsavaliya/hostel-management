<?php 
	include '../config/db_connect.php';

	$sql = 'SELECT hostel_name FROM hostels';

	$result = mysqli_query($conn,$sql);

	$hostels = mysqli_fetch_all($result,MYSQLI_ASSOC);

	mysqli_free_result($result);
	mysqli_close($conn);
 ?>


<!DOCTYPE HTML>
<html>
	<?php include('templates/header.php'); ?>

	<h4 class="center grey-text">Apply For Hostels</h4>
	<div class="container">
		<div class="row">
			<?php foreach($hostels as $hostel):?>
				<div class="col s4 md3">
					<div class="card z-depth-0">
						<div class="card-content center">
							<h4><?php echo htmlspecialchars($hostel['hostel_name'])?></h4>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>


	<?php include('templates/footer.php'); ?>
</html>
