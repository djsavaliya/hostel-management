<?php
	session_start();// Starting Session
	// Establishing Connection with Server by passing server_name, user_id and password as a parameter
	//$conn = mysql_connect("localhost", "root", "");
	require '../config/db_connect.php';
	// Selecting Database
	//$db = mysqli_select_db($conn , "hms");
	// Storing Session
	$user_check=$_SESSION['username'];
	//echo ($user_check);
	// SQL Query To Fetch Complete Information Of User
	$sql = "SELECT * FROM managers WHERE email='$user_check'";
	$result = mysqli_query($conn,$sql);
	$admin = mysqli_fetch_assoc($result);
	$name = $admin['first_name'];
	if(!isset($name)){
		//echo 'not set';
		mysqli_close($conn); // Closing Connection
		header('Location: index.php'); // Redirecting To Home Page
	}
?>