<?php  
	//change your path here acc. to your PC
	//include('../config/db_connect.php');
	require 'session.php';

	$first_name=$last_name=$date_of_birth=$mobile=$email=$password=$hostel_id=$is_admin='';

	$errors = array('first_name'=> '','last_name'=> '','date_of_birth' => '','mobile'=> '','email'=> '','password'=> '','is_admin'=> '','hostel_id'=>'');

	if(isset($_POST['submit'])){
	    // echo $_POST['email'];
	    // echo $_POST['title'];
	    // echo $_POST['ingredients'];

	// Done with First Name
	    if(empty($_POST['first_name']))
	    {
	        $errors['first_name']='First Name is required <br/>';
	    }
	    else
	    {
	       // echo htmlspecialchars($_POST['first_name']) . '<br/>';
	        $first_name = $_POST['first_name'];
	        if(!preg_match('/^[a-zA-Z\s]+$/',$first_name))
	        {
	            $errors['first_name']='First Name should contain letters and spaces only';
	        }
	    
	    }
	// Done with Last Name
	if(empty($_POST['last_name']))
	{
		$errors['last_name']='Last Name is required <br/>';
	}
	else
	{
	   // echo htmlspecialchars($_POST['last_name']) . '<br/>';
		$last_name = $_POST['last_name'];
		if(!preg_match('/^[a-zA-Z\s]+$/',$last_name))
		{
			$errors['last_name']='Last Name should contain letters and spaces only';
		}

	}

	// Done with Mobile Number
	if(empty($_POST['mobile']))
	{
		$errors['mobile']='Mobile number is required <br/>';
	}
	else
	{
	   // echo htmlspecialchars($_POST['mobile']) . '<br/>';
		$mobile = $_POST['mobile'];
		if(!preg_match('/^[0-9\s]+$/',$mobile))
		{
			$errors['mobile']='Mobile Number must contain Numbers only';
		}

	}
	//Done with email ID	
	if(empty($_POST['email']))
	    {
	        $errors['email']='An Email is required <br/>';
	    }
	    else
	    {
	        $email= $_POST['email'];
	        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
	        {
	          $errors['email']='Email must be valid email address';  
	        }

		}
	//Done with Password	
	if(empty($_POST['password']))
	    {
	        $errors['password']='Password is required <br/>';
	    }
	    else
	    {
	        $password= $_POST['password'];
		}

	//Done with Is_admin	
	$is_admin=$_POST['is_admin'];

	if(empty($_POST['is_admin']))
			{
				$_POST['is_admin']=0;
			}
	// Done with Hostel ID
	if(empty($_POST['hostel_id']))
	{
		$errors['hostel_id']='Hostel ID is required <br/>';
	}
	else
	{
	   // echo htmlspecialchars($_POST['mobile']) . '<br/>';
		$hostel_id = $_POST['hostel_id'];
		if(!preg_match('/^[0-9\s]+$/',$hostel_id))
		{
			$errors['hostel_id']='Hostel ID must contain Numbers only';
		}

	}	

		



	if(array_filter($errors))
	{
	    echo 'Errors in the form.';
	}
	else 
	{
	    
		$first_name = mysqli_real_escape_string($conn,$_POST['first_name']); 
		$last_name = mysqli_real_escape_string($conn,$_POST['last_name']);
		$date_of_birth= mysqli_real_escape_string($conn,$_POST['date_of_birth']);
		$mobile = mysqli_real_escape_string($conn,$_POST['mobile']);
		$email = mysqli_real_escape_string($conn,$_POST['email']);
		$password= mysqli_real_escape_string($conn,$_POST['password']);
		$is_admin= mysqli_real_escape_string($conn,$_POST['is_admin']);
		$hostel_id= mysqli_real_escape_string($conn,$_POST['hostel_id']);
	echo $date_of_birth;
	    // create sql
	    $sql="INSERT INTO managers(first_name,last_name,date_of_birth,mobile,email,password,is_admin,hostel_id) VALUES('$first_name','$last_name','$date_of_birth','$mobile','$email','$password','$is_admin','$hostel_id')";

	    //Save to db and check
	    if(mysqli_query($conn,$sql)){
	    //returns true ,so Success
	//echo 'Form is Valid';
	        header('Location: hostels.php');
	    }
	    else {
	        // error
	   echo 'query Error ' . mysqli_error($conn);
	    }
	    
	}

}

?>

<!DOCTYPE HTML>
<html>
	<?php include('templates/header.php'); ?>

	<section class="container grey-text">	
	<h4 class="center blue-text">Appoint Hostel Manager</h4>
	<form class="white" action="appoint_manager.php" method="POST">

	<label>First Name : </label>
	<input type="text" name="first_name" value="<?php echo htmlspecialchars($first_name); ?>">
	<div class="red-text"><?php echo $errors['first_name']; ?></div>

	<label>Last Name : </label>
	<input type="text" name="last_name" value="<?php echo htmlspecialchars($last_name); ?>">
	<div class="red-text"><?php echo $errors['last_name']; ?></div>

	<!-- DOB is not a required field --> 
	<label>DOB : </label>
	<input type="date" name="date_of_birth" value="<?php echo htmlspecialchars($date_of_birth); ?>">
	<div class="red-text"><?php echo $errors['date_of_birth']; ?></div>

	<label>Mobile number : </label>
	<input type="text" name="mobile" value="<?php echo htmlspecialchars($mobile); ?>">
	<div class="red-text"><?php echo $errors['mobile']; ?></div>

	<label> Email ID : </label>
	<input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
	<div class="red-text"><?php echo $errors['email']; ?></div>

	<label>Password : </label>
	<input type="password" name="password" value="<?php echo htmlspecialchars($password); ?>">
	<div class="red-text"><?php echo $errors['password']; ?></div>

	<label>Manager(0) OR Admin(1) : </label>
	<input type="text" name="is_admin" value="<?php echo htmlspecialchars($is_admin); ?>">
	<div class="red-text"><?php echo $errors['is_admin']; ?></div>

	<label>Hostel ID : </label>
	<input type="number" name="hostel_id" value="<?php echo htmlspecialchars($hostel_id); ?>">
	<div class="red-text"><?php echo $errors['hostel_id']; ?></div>


	<div class="center">
	<input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
	</div>
	</form>
	</section>

	<?php include('templates/footer.php'); ?>

</html>

