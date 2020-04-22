<?php 
$conn = mysqli_connect('127.0.0.1:3307','darshil','djsavaliya','hms');

	if(!$conn){
		echo 'Connection Error : '.mysqli_connect_error();
	}
 ?>