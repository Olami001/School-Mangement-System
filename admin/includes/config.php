<?php
// connect to database
$hostname = 'localhost';
$username ='root';
$password ='root';
$database = 'mss';
$con = mysqli_connect($hostname,$username,$password,$database);
if (!$con) {
	echo "<script>alert('database Connectiom Fail. Contact Administartor')</script>";
	
}

?>