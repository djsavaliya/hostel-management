<?php 

$errors=array('fname'=>'','lname'=>'','RollNumber'=>'','password'=>'','cpassword'=>'');

/*

Some error in entering current time...will see that later

*/

if(isset($_POST['signup']))
{
	$fname=$_POST['fname'];
	$lname=$_POST['lname'];
	$rnumber=$_POST['RollNumber'];
	$password=$_POST['password'];
	$cpassword=$_POST['cpassword'];
	$dob=$_POST['DOB'];


	$valid=true;
	//Validate first name

	if(strlen($fname)==0)
	{
		$errors['fname']="*First Name can't be empty";
		$valid=false;
	}
	else
	{
		for($i=0;$i<strlen($fname);$i++)
		{
			if(!ctype_alpha($fname[$i]))
			{
				$errors['fname']='*First Name can contain only alphabets';
				$valid=false;
				break;
			}
		}
	}
	//Validate last name

	if(strlen($lname)==0)
	{
		$errors['lname']="*Last Name can't be empty";
		$valid=false;
	}
	else
	{
		for($i=0;$i<strlen($lname);$i++) 
		{
			if(!ctype_alpha($lname[$i]))
			{
				$errors['lname']='*Last Name can contain only alphabets';
				$valid=false;
				break;
			}
		}
	}

	//Validate rollnumber

	if(strlen($rnumber)==0)
	{
		$valid=false;
		$errors['RollNumber']="*Roll Number can't be empty";
	}
	else
	{
		if(strlen($rnumber)!=8 or $rnumber[0]!='U' or !ctype_digit($rnumber[1]) or !ctype_digit($rnumber[2]) or !ctype_upper($rnumber[3]) or !ctype_upper($rnumber[4]) or !ctype_digit($rnumber[5]) or !ctype_digit($rnumber[6]) or !ctype_digit($rnumber[7]))
		{
			$errors['RollNumber']='*Enter a valid roll number';
			$valid=false;
		}
	}

	//Validate password/confirm password

	if(strlen($password)==0)
	{
		$errors['password']="*Password can't be empty";
		$valid=false;
	}
	else
	{
		if($password!=$cpassword)
		{
			$errors['cpassword']='*Passwords do not match';
			$valid=false;
		}
	}
	if($valid)
	{



		$con=mysqli_connect('localhost','Dhruv','u18co019#hmsproject','hms');

		if($con)
		{
			$fullname=$fname.' '.$lname;
			$current_time=time();
			$sql="INSERT INTO users VALUES('$rnumber','$fullname','$password','$current_time')";
			if(mysqli_query($con,$sql)) 
			{
				echo 'Entry Successfully Entered';
			} 
		}

		mysqli_close($con);
	}


}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Student Signup</title>

	<style>

	body
	{
		background: #eee;
    }
    .Signup-form
    {
	      border :solid gray 1px;
	      width: 20%;
	      border-radius: 5px;
	      margin: 100px auto;
	      background: white;
    }
    #button
    {
	      color :#fff;
	      background : #337ab7;
	      padding: 5px;
	      margin-left:70%;
    }

	</style>

</head>
<body>

	<div class="Signup-form">

    <form action="signup.php" method="post">
      <p>
        <label>First Name: </label>
        <input type="text" name="fname" value="<?php echo isset($_POST["fname"]) ? $_POST["fname"] : ''; ?>">
      </p>
      <div style="color: red;"><?php echo $errors['fname']; ?></div>

      <p>
        <label>Last Name: </label>
        <input type="text" name="lname" value="<?php echo isset($_POST["lname"]) ? $_POST["lname"] : ''; ?>">
      </p>      
      <div style="color: red;"><?php echo $errors['lname']; ?></div>

      <p>
        <label>RollNumber: </label>
        <input type="text" name="RollNumber" value="<?php echo isset($_POST["RollNumber"]) ? $_POST["RollNumber"] : ''; ?>">
      </p>
      <div style="color: red;"><?php echo $errors['RollNumber']; ?></div>

      <p>
      	<label>Date of Birth: </label>
      	<input type="Date" name="DOB" value="<?php echo isset($_POST["DOB"]) ? $_POST["DOB"] : ''; ?>">
      </p>

      <p>
        <label>Password: </label>
        <input type="password" name="password" value="<?php echo isset($_POST["password"]) ? $_POST["password"] : ''; ?>">
      </p>
      <div style="color: red;"><?php echo $errors['password']; ?></div>

      <p>
      	<label>Confirm Password: </label>
      	<input type="password" name="cpassword" value="<?php echo isset($_POST["cpassword"]) ? $_POST["cpassword"] : ''; ?>">
      </p>
      <div style="color: red;"><?php echo $errors['cpassword']; ?></div>

      <div>
        <input type="submit" id="button" name="signup" value="Create">
      </div>

    </form>

  </div>

</body>
</html>