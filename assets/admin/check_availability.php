<?php 
require_once("includes/config.php");
// code for empid availablity
if(!empty($_POST["empcode"])) {
	$empid=$_POST["empcode"];
	
$sql ="SELECT EmpID FROM employee_tb WHERE EmpID = '$empid'";
$query = mysqli_query($con,$sql);
if (mysqli_num_rows($query) > 0) 

{
echo "<span style='color:red'> Employee id already exists .</span>";
 echo "<script>$('#add').prop('disabled',true);</script>";
} else{
	
echo "<span style='color:green'> Employee id available for Registration .</span>";
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
	
$sql ="SELECT PhoneNo FROM employee_tb WHERE PhoneNo = '$phoneNo'";
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

//chechk if leavetype exist in database
if (!empty($_POST['leavetype'])) {
	$leavetype = $_POST['leavetype'];
	$upper_leavetype = ucwords($leavetype);
	$sql = mysqli_query($con, "SELECT LeaveType FROM leavetype_tb WHERE LeaveType = '$upper_leavetype'");
	if (mysqli_num_rows($sql) > 0) 

{
echo "<span style='color:red'> Leave Type  already exists .</span>";
 echo "<script>$('#add').prop('disabled',true);</script>";
} else{
	
echo "<span style='color:green'> Leave Type is Good to go .</span>";
echo "<script>$('#add').prop('disabled',false);</script>";
}
}

?>
