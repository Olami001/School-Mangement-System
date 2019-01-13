<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$dbname = 'db';

$con = mysqli_connect($hostname,$username,$password,$dbname);
if(!$con){
	echo "Not Connected";
}
else{
	echo "connection Successfully";
}
?>

<!-- login -->
<?php
include('connection.php');

if (isset($_POST['login_btn'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	if (empty($username)) {
		$msg = 'username can not be empty';
	}
	elseif (empty($password)) {
		$msg = "password Can't be empty";
	}
	else{
		$query = mysqli_query($con,"Select all from user_tb where username = '$username' and password = '$password'");
		if (mysqli_num_rows($query)  < 0) {
			$msg = "Wrong Username Or Password";
		}
		else{
			header('location:home.php');
		}
	}
	
}
?>