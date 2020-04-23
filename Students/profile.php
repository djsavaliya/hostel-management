<?php
	require 'session.php';
?>


<!DOCTYPE HTML>
<html>
	<?php include('templates/header.php'); ?>

	<div class="z-depth-0 center">
			<h4><?php echo htmlspecialchars($student['first_name']);echo(" ");echo htmlspecialchars($student['last_name']);?></h4>
			<h5><?php echo htmlspecialchars($student['college_id'])?></h5>
			<h5><?php echo htmlspecialchars($student['mobile'])?></h5>
			<h5><?php echo htmlspecialchars($student['email'])?></h5>
	</div>
	<div class="center">
		<a href="../logout.php"><button type="submit" name="logout" class="btn brand z-depth-0">Log Out</button></a>
	</div>

	<?php include('templates/footer.php'); ?>
</html>