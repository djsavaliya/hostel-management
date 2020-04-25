<?php  

	//include('../config/db_connect.php');
	require 'session.php';

	if(isset($_POST['delete']))
	{
	    $id_to_delete=mysqli_real_escape_string($conn,$_POST['id_to_delete']);
	    // sql query to delete particular manager record with $id_to_delete ID
	    $sql="DELETE FROM managers WHERE hostel_id=$id_to_delete"; 
	    
	     if(mysqli_query($conn,$sql))
	     {
	             
	             header('Location: hostels.php');
	     } 
	     else
	     {
	             //error in query
	             echo 'Error in query'. mysqli_error($conn);
	     }
	     
	}




	$sql = 'SELECT * FROM hostels';
	$sql_manager='SELECT * FROM managers';
	// make query and get result
	$result=mysqli_query($conn,$sql);

	$result_manager=mysqli_query($conn,$sql_manager);
	//fetch the reulting rows as an array
	$hostels=mysqli_fetch_all($result,MYSQLI_ASSOC);

	$managers=mysqli_fetch_all($result_manager,MYSQLI_ASSOC);
	//free the result from memory
	mysqli_free_result($result);
	mysqli_free_result($result_manager);

	//closing the connection
	mysqli_close($conn);

	//print_r($managers);

?>
	


<!DOCTYPE HTML>
<html>

	<?php include('templates/header.php'); ?>

	<h4 class="center grey-text">Hostels</h4>

	<div class="container">
	<div class="row">

	<?php foreach($hostels as $hostel){ ?>
	<div class="col s6 md3">
	  <div class="card z-depth-0">
	  
	    <div class="card-content center">
	    <h6>Hostel ID : <?php echo htmlspecialchars($hostel['hostel_id']); ?></h6>
	    <h6>Hostel Name : <?php echo htmlspecialchars($hostel['hostel_name']); ?></h6>
		  <h6>No. of Rooms : <?php echo htmlspecialchars($hostel['no_of_rooms']); ?></h6>
		  <h6>No. of Students : <?php echo htmlspecialchars($hostel['no_of_students']); ?></h6>
	    </div>
	    <div class="card-action right-align">
	         <?php
	         $flag=0;
	             foreach($managers as $manager) {
	               if($manager['is_admin']==0)
	               {
	                   if($manager['hostel_id']==$hostel['hostel_id'])
	                   {
	                       $flag=1;
	                       break;
	                   }

	               }
	              } ?>
	            <?php
	              if($flag==0)
	              {  ?>
	                <p><a href="appoint_manager.php" class="btn brand z-depth-0">Appoint Manager</a></p> 
	              <?php
	              }
	              else
	              {
	                 ?>
	                <h6 class="brown-text text-darken-2" style="text-align:left"><?php echo $manager['first_name'].' '.$manager['last_name']; ?></h6>
	                <h6 class="brown-text text-darken-2" style="text-align:left"><?php echo 'Email ID :- '.$manager['email']; ?></h6>
	              <form action="hostels.php" method="POST">
	                <input type="hidden" name="id_to_delete" value="<?php echo $hostel['hostel_id']; ?>">
	                <input type="submit" name="delete" value="Remove Manager" class="btn brand z-depth-0"> 
	               </form>



	 
	                <?php
	              }
	              ?>
	    </div>
	  </div>
	</div>

	<?php   } ?>
	</div>

	</div>



<?php include('templates/footer.php'); ?>


</html>
