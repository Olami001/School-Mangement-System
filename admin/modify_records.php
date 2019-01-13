<?php
include('..\admin/includes/config.php');
if(isset($_POST['edit_row']))
{
 $row=$_POST['row_id'];
 $name=$_POST['name_val'];
 $collection=$_POST['collection'];
 $description = $_POST['description'];

 mysqli_query($con,"update fee_type_tb set fee_name='$name',collection='$collection',description='$description' where id='$row'");
 echo "success";
 exit();
}

if(isset($_POST['delete_row']))
{
 $row_no=$_POST['row_id'];
 $get_name = mysqli_query($con, "select * from fee_type_tb where id = '$row_no'");
 $fetch = mysqli_fetch_assoc($get_name);
 $name_got = $fetch['fee_name'];
 $upp_name = ucwords($name_got);
 mysqli_query($con,"delete from fee_type_tb where id='$row_no'");
 mysqli_query($con, "delete from fee_details_tb where fee_type ='$upp_name'");
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

//query for second tab
if(isset($_POST['edit_row2']))
{
 $row=$_POST['row_id'];
 $amount=$_POST['amount'];
 $period=$_POST['period'];
 mysqli_query($con,"update fee_details_tb set amount='$amount',period='$period' where id='$row'");
 echo "success";
 exit();
}

?>