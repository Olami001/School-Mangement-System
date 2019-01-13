<?php
include 'connection.php';
if(isset($_POST['edit_row']))
{
 $row=$_POST['row_id'];
 $name=$_POST['name_val'];
 $age=$_POST['age_val'];

 mysqli_query($con,"update fee_type_tb set fee_name='$name',collection='$age' where id='$row'");
 echo "success";
 exit();
}

if(isset($_POST['delete_row']))
{
 $row_no=$_POST['row_id'];
 mysqli_query($con,"delete from fee_type_tb where id='$row_no'");
 echo "success";
 exit();
}

if(isset($_POST['insert_row']))
{
 $name=$_POST['name_val'];
 $age=$_POST['age_val'];
 $inst = mysqli_query($con,"insert into testing values('','$name','$age')");
 if ($inst) {
 	echo "insted";
 }
 else{
 	echo "not inserted";
 }
 echo mysqli_insert_id($con);
 exit();
}
?>