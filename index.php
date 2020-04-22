<?php 

	require 'config/db_connect.php';

	if(isset($_POST['login']))
	{

		$uname=$_POST['username'];
		$psw=$_POST['password'];
		$error='';

		if($conn)
		{
			$sql="SELECT * FROM users WHERE Username='$uname' AND Password='$psw' ";

			$result=mysqli_query($conn,$sql);
			if(mysqli_num_rows($result)>0)
			{
				//code
			}
			else
			{
				$error= "* Incorrect username or password";
			}
		}
	}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Login Page</title>

  <style>

  	body
  	{
  		background: #eee;
  	}
  	.login-form
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

	<div class="login-form">

		<form action="login.php" method="post">
			<p>
				<label>Username:</label>
				<input type="text" name="username" placeholder="eg. U18CO019/u18co019">
			</p>

			<p>
				<label>Password:</label>
				<input type="password" name="password">
				<div style="color:red;"><?php echo $error; ?></div>
			</p>

			<div>
				<input type="submit" id="button" name="login" value="Login">
			</div>

		</form>

	</div>

</body>
</html>