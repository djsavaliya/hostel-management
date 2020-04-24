<?php
	require 'session.php';
	$hid = $student['hostel_id'];
	if($hid==NULL){
		$hostel = ['hostel_name' => '(Not A Hostelite.)'];
	}
	else{
		$sql = "SELECT * FROM hostels WHERE hostel_id='$hid'";
		$result = mysqli_query($conn,$sql);
		$hostel = mysqli_fetch_assoc($result);
	}
?>


<!DOCTYPE HTML>
<html>
	<?php include('templates/header.php'); ?>

	<div class="z-depth-0 center">
			<h3><?php echo htmlspecialchars($student['first_name']);echo(" ");echo htmlspecialchars($student['last_name']);?></h3>
			<h5><?php echo htmlspecialchars($hostel['hostel_name'])?></h5>
			<h6><?php echo htmlspecialchars($student['college_id'])?></h6>
			<h6><?php echo htmlspecialchars($student['mobile'])?></h6>
			<h6><?php echo htmlspecialchars($student['email'])?></h6>
	</div>
	<div class="center">
		<a href="../logout.php"><button type="submit" name="logout" class="btn brand z-depth-0">Log Out</button></a>
	</div>

	<?php include('templates/footer.php'); ?>
</html>
