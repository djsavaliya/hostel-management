<?php 
	session_start();

	require 'config/db_connect.php';

	$errors=array('fname'=>'','lname'=>'','RollNumber'=>'','password'=>'','cpassword'=>'','email'=>'','phone'=>'','dob'=>'');

	if(isset($_POST['signup']))
	{
		$fname=$_POST['fname'];
		$lname=$_POST['lname'];
		$rnumber=$_POST['RollNumber'];
		$dob=$_POST['DOB'];
		$email=$_POST["email"];
		$phone=$_POST["phone"];
		$password=$_POST['password'];
		$cpassword=$_POST['cpassword'];


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

		//Validate rollnumber//college_id

		if(strlen($rnumber)==0)
		{
			$valid=false;
			$errors['RollNumber']="*Roll Number can't be empty";
		}
		else
		{
			/*if(strlen($rnumber)!=8 or $rnumber[0]!='U' or !ctype_digit($rnumber[1]) or !ctype_digit($rnumber[2]) or !ctype_upper($rnumber[3]) or !ctype_upper($rnumber[4]) or !ctype_digit($rnumber[5]) or !ctype_digit($rnumber[6]) or !ctype_digit($rnumber[7]))*/
			if(strlen($rnumber)<6)
			{
				$errors['RollNumber']='*Enter a valid roll number';
				$valid=false;
			}
		}

		//Validate Date of Birth

		if(strlen($dob)!=10)
		{
			$errors['dob']="*Enter a valid date and in valid format";
			$valid=false;
		}
		else
		{

			function check_leap_year($year)
			{
				return ($year%4==0) and ($year%100!=0) or ($year%400==0);
			}

			$date=substr($dob,0,2);
			$month=substr($dob,3,2);
			$year=substr($dob,6,4);
			if(ctype_digit($date) and ctype_digit($month) and ctype_digit($year) and $dob[2]=='-' and $dob[5]=='-')
			{
				$date=(int)$date;
				$month=(int)$month;
				$year=(int)$year;
				if($month<1 or $month>12)
				{
					$errors['dob']="*Enter a valid date and in valid format";
					$valid=false;
				}
				else
				{
					if($month==1)
					{
						if($date<1 or $date>31)
						{
							$errors['dob']="*Enter a valid date and in valid format";
							$valid=false;
						}
					}
					elseif($month==2) 
					{
						if(check_leap_year($year))
						{
							if($date<1 or $date>29)
						    {
								$errors['dob']="*Enter a valid date and in valid format";
								$valid=false;
						    }
						}
						else
						{
							if($date<1 or $date>28)
						    {
								$errors['dob']="*Enter a valid date and in valid format";
								$valid=false;
						    }
						}
					}
					elseif($month==3) 
					{
					    if($date<1 or $date>31)
						{
							$errors['dob']="*Enter a valid date and in valid format";
							$valid=false;
						}	
					}
					elseif($month==4) 
					{
						if($date<1 or $date>30)
						{
							$errors['dob']="*Enter a valid date and in valid format";
							$valid=false;
						}
					}
					elseif($month==5) 
					{
						if($date<1 or $date>31)
						{
							$errors['dob']="*Enter a valid date and in valid format";
							$valid=false;
						}
					}
					elseif($month==6) 
					{
						if($date<1 or $date>30)
						{
							$errors['dob']="*Enter a valid date and in valid format";
							$valid=false;
						}
					}
					elseif($month==7) 
					{
						if($date<1 or $date>31)
						{
							$errors['dob']="*Enter a valid date and in valid format";
							$valid=false;
						}
					}
					elseif($month==8) 
					{
						if($date<1 or $date>31)
						{
							$errors['dob']="*Enter a valid date and in valid format";
							$valid=false;
						}
					}
					elseif($month==9) 
					{
						if($date<1 or $date>30)
						{
							$errors['dob']="*Enter a valid date and in valid format";
							$valid=false;
						}
					}
					elseif($month==10) 
					{
						if($date<1 or $date>31)
						{
							$errors['dob']="*Enter a valid date and in valid format";
							$valid=false;
						}
					}
					elseif($month==11) 
					{
						if($date<1 or $date>30)
						{
							$errors['dob']="*Enter a valid date and in valid format";
							$valid=false;
						}
					}
					else 
					{
					    if($date<1 or $date>31)
						{
							$errors['dob']="*Enter a valid date and in valid format";
							$valid=false;
						}	
					}
				}
			}
			else
			{
				$errors['dob']="*Enter a valid date and in valid format";
				$valid=false;
			}
		}

		//Validate Email

		if(strlen($email)==0)
		{
			$errors['email']="*Email can't be empty";
			$valid=false;
		}
		else if(!filter_var($email,FILTER_VALIDATE_EMAIL)) 
		{
			$errors["email"]="*Invalid email format";
			$valid=false;
		}

		//Validate phone

		if(strlen($phone)==0)
		{
			$errors['phone']="*Phone number can't be empty";
			$valid=false;
		}
		else if(strlen($phone)!=10)
		{
			$errors['phone']="*Invalid phone number";
			$valid=false;
		}
		else
		{
			for($i=0;$i<strlen($phone);$i++)
			{
				if(!ctype_digit($phone[$i]))
				{
					$errors['phone']="*Invalid phone number";
					$valid=false;
					break;
				}
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

		//If everything is valid

		if($valid)
		{

			if($conn)
			{
				$sql="INSERT INTO students(college_id,first_name,last_name,date_of_birth,mobile,email,password) VALUES('$rnumber',
				'$fname','$lname','$dob','$phone','$email','$password')";
				if(mysqli_query($conn,$sql)) 
				{
					echo 'Account Successfully Created';
					$_SESSION['username'] = $rnumber;
					header("location: students/profile.php");
				} 
			}

			mysqli_close($conn);
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

    <form action="student_signup.php" method="post">
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
        <label>College Id: </label>
        <input type="text" name="RollNumber" value="<?php echo isset($_POST["RollNumber"]) ? $_POST["RollNumber"] : ''; ?>">
      </p>
      <div style="color: red;"><?php echo $errors['RollNumber']; ?></div>

      <p>
      	<label>Date of Birth: </label>
      	<input type="text" name="DOB" placeholder="dd-mm-yyyy format" 
      	value="<?php echo isset($_POST["DOB"]) ? $_POST["DOB"] : ''; ?>">
      </p>
      <div style="color:red;"><?php echo $errors['dob']; ?></div>

      <p>
      	<label>Email: </label>
      	<input type="email" name="email" value="<?php echo isset($_POST["email"]) ? $_POST["email"]: ''; ?>">
      </p>
      <div style="color:red;"><?php echo $errors['email']; ?></div>

      <p>
      	<label>Phone: </label>
      	<input type="text" name="phone" value="<?php echo isset($_POST["phone"]) ? $_POST["phone"]: '';?>">
      </p>
      <div style="color:red;"><?php echo $errors['phone']; ?></div>

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
