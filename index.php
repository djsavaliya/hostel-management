<?php 
	session_start();

	require 'config/db_connect.php';

	$error='';
	if(isset($_POST['login']))
	{
	  $rno=$_POST['RollNumber'];
	  $psw=$_POST['password'];

	  if($conn)
	  {
	    $sql="SELECT * FROM students WHERE college_id='$rno' AND password='$psw'";

	    $result=mysqli_query($conn,$sql);
	    if(mysqli_num_rows($result)>0)
	    {
	      $_SESSION['username'] = $rno;
	      header("location: students/profile.php");
	    }
	    else
	    {
	      $error="*Incorrect username or password";
	    }
	  }
	  mysqli_close($conn);
	}
?>

<!DOCTYPE html>
<html>
<?php include('templates/header.php'); ?>

<section class="container grey-text">	
	<h4 class="center blue-text">Student Login</h4>
 
    <form class="white" action="index.php" method="POST">

        <label><h5>Roll Number : </h5></label>
  	    <input type="text" name="RollNumber" >

        <label><h5>Password :</h5></label>
        <input type="password" name="password">
        <div class="red-text"><?php echo $error; ?></div>
      

      <div class="left">
        <input type="submit" class="btn brand z-depth-0" name="login" value="Login">
      </div>
<br><br>
      <h6>
      <span style="margin-left:120px;"> Don't have an account yet?
      <a href="http://localhost/amoc/student_signup.php" class="btn brand z-depth-0">Signup</a>
      </span>
    </h6>
    </form>

    

  </section>

   
  <h5 style="text-align: center;">
  Not a student? Click <a href="http://localhost/amoc/manager-adminLogin.php" class="blue-text text-darken-2 z-depth-0">HERE</a> to login 
  </h5>

  <?php include('templates/footer.php'); ?>
</html>
