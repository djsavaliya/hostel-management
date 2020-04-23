<?php 

//Manager Admin login

$error='';
if(isset($_POST['login']))
{
  $email=$_POST['email'];
  $password=$_POST['password'];
  $con=mysqli_connect('localhost','Dhruv','u18co019#hmsproject','hms');

  if($con)
  {
    $sql="SELECT is_admin FROM managers WHERE email='$email' AND password='$password' ";

    $result=mysqli_query($con,$sql);
    if(mysqli_num_rows($result)>0)
    {
      $tuple=mysqli_fetch_all($result,MYSQLI_ASSOC);

      if($tuple[0]['is_admin']==0)
      {
           // Redirect to manager page
      }
      else
      {
           // Redirect to admin page
      }
      
    }
    else
    {
      $error="*Incorrect username or password";
    }
  }
  mysqli_close($con);
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Manager-Admin Login Page</title>

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

  <h1 style="text-align: center;">
        <u>Manager/Admin Login</u>
  </h1>

  <div class="login-form">



    <form action="manager-adminLogin.php" method="post">



      <p>
        <label>Email:</label>
        <input type="email" name="email">
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
