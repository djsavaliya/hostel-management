<?php 

//Student login

$error='';
if(isset($_POST['login']))
{
  $rno=$_POST['RollNumber'];
  $psw=$_POST['password'];
  $con=mysqli_connect('localhost','Dhruv','u18co019#hmsproject','hms');

  if($con)
  {
    $sql="SELECT * FROM students WHERE college_id='$rno' AND password='$psw' ";

    $result=mysqli_query($con,$sql);
    if(mysqli_num_rows($result)>0)
    {
      //code
      echo 'Login Success';
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
  <title>Student Login Page</title>

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
        <u>Student Login</u>
  </h1>

  <div class="login-form">



    <form action="student_login.php" method="post">



      <p>
        <label>RollNumber:</label>
        <input type="text" name="RollNumber" placeholder="eg. U18CO019">
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
    <p>
      Don't have an account yet?
      <a href="http://localhost/HMS/student_signup.php">Signup</a>
    </p>

  </div>


  <h2 style="text-align: center;">

  Not a student? Click <a href="http://localhost/HMS/manager-adminLogin.php">here</a> to login    

  </h2>

</body>
</html>
