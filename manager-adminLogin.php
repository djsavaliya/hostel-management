<?php 
  session_start();
  
  require 'config/db_connect.php';

  $error='';
  if(isset($_POST['login']))
  {
    $email=$_POST['email'];
    $password=$_POST['password'];

    if($conn)
    {
      $sql="SELECT is_admin FROM managers WHERE email='$email' AND password='$password' ";

      $result=mysqli_query($conn,$sql);
      if(mysqli_num_rows($result)>0)
      {
        $tuple=mysqli_fetch_all($result,MYSQLI_ASSOC);

        if($tuple[0]['is_admin']==0)
        {
          $_SESSION['username'] = $email;
          header("location: managers/profile.php");
        }
        else
        {
          $_SESSION['username'] = $email;
          header("location: admins/profile.php");
        }
        
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

	<h4 class="center blue-text">Manager/Admin Login</h4>
   
    <form class="white" action="manager-adminLogin.php" method="POST">




  <label><h5> Email ID : </h5></label>
	<input type="email" name="email">
	


	<label><h5>Password : </h5></label>
	<input type="password" name="password" >
	<div class="red-text"><?php echo $error ?></div>

  <div class="center" >
	<input type="submit" name="login" value="Login" class="btn brand z-depth-0">
	</div>

     

    </form>

  

  </section>

<?php include('templates/footer.php'); ?>

</html>
