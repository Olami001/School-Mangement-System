<?php 
error_reporting(0);
require_once("includes/config.php");
// code for empid availablity
if(!empty($_POST["stud_id"])) {
	$stud_id=$_POST["stud_id"];
	
$sql ="SELECT student_adm FROM student_tb WHERE student_adm = '$stud_id'";
$query = mysqli_query($con,$sql);
if (mysqli_num_rows($query) > 0) 
{
echo "<span style='color:red'> Admission Number is taken. Kindly Refresh the system .</span>";
 echo "<script>$('#add').prop('disabled',true);</script>";
} 
else
{
	
echo "<span style='color:green'> Admission Number is available .</span>";
echo "<script>$('#add').prop('disabled',false);</script>";
}
}

// code for white space and symbol in Names availablity
// 

if (!empty($_POST['firstName'])) {
	$fname = $_POST['firstName'];
	if (!preg_match("/^[a-zA-Z ]*$/",$fname)) {
     echo "<span style='color:red'>Name can not contain white space or symbol or Numbers</span>";
 echo "<script>$('#add').prop('disabled',true);</script>"; 
        }
        else{
	
echo "<span style='color:green'> Valid Name Passed .</span>";
echo "<script>$('#add').prop('disabled',false);</script>";
}
}

if (!empty($_POST['lastName'])) {
	$lname = $_POST['lastName'];
	if (!preg_match("/^[a-zA-Z ]*$/",$lname)) {
     echo "<span style='color:red'> Name can not contain white space or symbol or Numbers</span>";
 echo "<script>$('#add').prop('disabled',true);</script>"; 
        }
        else{
	
echo "<span style='color:green'> Valid Name Passed .</span>";
echo "<script>$('#add').prop('disabled',false);</script>";
}
}

if (!empty($_POST['middleName'])) {
	$mname = $_POST['middleName'];
	if (!preg_match("/^[a-zA-Z ]*$/",$mname)) {
     echo "<span style='color:red'> Name can not contain white space or symbol or Numbers</span>";
 echo "<script>$('#add').prop('disabled',true);</script>"; 
        }
        else{
	
echo "<span style='color:green'> Valid Name Passed .</span>";
echo "<script>$('#add').prop('disabled',false);</script>";
}
}

//Check phone Number is exist
if (!empty($_POST['phoneNo'])) {
	$phoneNo=$_POST["phoneNo"];
	
$sql ="SELECT phoneNo FROM student_tb WHERE phoneNo = '$phoneNo'";
$query = mysqli_query($con,$sql);
if (mysqli_num_rows($query) > 0) 

{
echo "<span style='color:red'> PhoneNumber  already exists .</span>";
 echo "<script>$('#add').prop('disabled',true);</script>";
} else{
	
echo "<span style='color:green'> PhoneNumber available for Registration .</span>";
echo "<script>$('#add').prop('disabled',false);</script>";
}
}

//Check Instructor phone Number is exist
if (!empty($_POST['phoneNo'])) {
	$phoneNo=$_POST["phoneNo"];
	
$sql ="SELECT phoneNo FROM instructor_tb WHERE phoneNo = '$phoneNo'";
$query = mysqli_query($con,$sql);
if (mysqli_num_rows($query) > 0) 

{
echo "<span style='color:red'> PhoneNumber  already exists .</span>";
 echo "<script>$('#add').prop('disabled',true);</script>";
} else{
	
echo "<span style='color:green'> PhoneNumber available for Registration .</span>";
echo "<script>$('#add').prop('disabled',false);</script>";
}
}

// check email
if (!empty($_POST['email'])) {
	$email = $_POST['email'];
	if (!preg_match("/^[a-zA-Z ]*$/",$email)) {
     echo "<span style='color:red'> wrong format email</span>";
 echo "<script>$('#add').prop('disabled',true);</script>"; 
        }
        else{
	
echo "<span style='color:green'> Valid Name Passed .</span>";
echo "<script>$('#add').prop('disabled',false);</script>";
}
}

//Check u Nusername is exist
if (!empty($_POST['username'])) {
	$phoneNo=$_POST["username"];
	
$sql ="SELECT username FROM instructor_tb WHERE username = '$username'";
$query = mysqli_query($con,$sql);
if (mysqli_num_rows($query) > 0) 

{
echo "<span style='color:red'> username  already exists .</span>";
 echo "<script>$('#add').prop('disabled',true);</script>";
} else{
	
echo "<span style='color:green'> username available for Registration .</span>";
echo "<script>$('#add').prop('disabled',false);</script>";
}
}

if (!empty($_POST['fee_type'])) {
	$fee_type = $_POST['fee_type'];
	$select = mysqli_query($con, "select * from fee_details_tb where fee_type = '$fee_type'");
	$fetch = mysqli_fetch_assoc($select);
	$amount = $fetch['amount'];
	echo $amount;
}

?>
