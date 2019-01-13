<?php
include('..\admin/includes/config.php');
session_start();
// if ($_SESSION['eid'] == '') {
//     header('location:../index.php');
// }
$msg ='';

$eid=$_GET['EmpID'];
if(isset($_POST['update']))
{

$fname=$_POST['firstName'];
$lname=$_POST['lastName'];   
$gender=$_POST['gender']; 
$dob=$_POST['dob']; 
$department=$_POST['department']; 
$email=$_POST['email']; 
$middlename=$_POST['middlename']; 
$country=$_POST['country']; 
$mobileno=$_POST['mobileno'];
$faculty = $_POST['faculty'] ;
// $sql="update tblemployees set First_Name=:fname,Last_Name=:lname,Gender=:gender,Dob=:dob,Department=:department,Address=:address,City=:city,Country=:country,Phonenumber=:mobileno where EmpID=:'$eid'";

$sql = mysqli_query($con, "UPDATE employee_tb set First_Name='$fname',Last_Name= '$lname', Middle_Name = '$middlename',Faculty ='$faculty', Department ='$department', PhoneNo = '$mobileno' where EmpID = '$eid'") or die(mysqli_error($con));
    if ($sql) {
        $update = mysqli_query($con, "UPDATE personaldata_tb set sex ='$gender', dob = '$dob', email = '$email',nationality = '$country'") or die(mysqli_error($con));
        if ($update) {
            $msg="Employee record updated Successfully";
        }
        else{
            echo "<script>alert('Sorry Error Encounter')</script>";
        }
    }
}

$sql = "SELECT * from  employee_tb where EmpID= '$eid'";

$query = mysqli_query($con, $sql);
$cnt=1;

if(mysqli_num_rows($query)<1)
{
header('location:manageemployee.php');
}
    $result = mysqli_fetch_assoc($query);


    $emaill = mysqli_query($con, "SELECT * FROM personaldata_tb where EmpID = '$eid'");
    $emaill_fetch = mysqli_fetch_assoc($emaill);

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Add Staff</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

<style type="text/css">
    .img h4,h5,p{
        text-align: center; font-weight: bold;
    }
    #side-menu li a{
        color: seagreen;
    }
</style>
    <script type="text/javascript">
function valid()
{
if(document.addemp.password.value!= document.addemp.confirmpassword.value)
{
alert(" Password and Confirm Password does not match  !!");
document.addemp.confirmpassword.focus();
return false;
}
var x = $('#password').val().length;
if(x< 8){
    alert("Passwords must be More than eight character.");
    return false;
}
// var emp_id = $('#empcode').val().length;
// if (emp_id <8) {
//     alert("Employee ID cannot be less eight");
//     return false;
// }
}
</script>

<script>
function checkAvailabilityEmpid() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'empcode='+$("#empcode").val(),
type: "POST",
success:function(data){
$("#empid-availability").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>

<script>
function checkAvailabilityFname() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'firstName='+$("#firstName").val(),
type: "POST",
success:function(data){
$("#fnameid-availability").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>

<script>
function checkAvailabilityLname() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'lastName='+$("#lastName").val(),
type: "POST",
success:function(data){
$("#lnameid-availability").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}

function checkAvailabilityMname() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'middleName='+$("#middleName").val(),
type: "POST",
success:function(data){
$("#mnameid-availability").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}

function checkAvailabilityPhoneNo() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'phoneNo='+$("#phoneNo").val(),
type: "POST",
success:function(data){
$("#phoneid-availability").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><span style="font-size: 22px; font-weight: bold; color: green">UDUS-HRMS</span></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                
                
               
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <?php include 'includes/sidebar.php' ?>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
            <!-- php user process request -->
                

                <div class="col-lg-12">
                    <h2 class="page-header" style="font-style: italic;color: black">Update Staff</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
            <?php echo $msg; ?>
               <div class="panel panel-success">
                <div class="panel-heading">
                    <h4>Update Staff Record</h4>
                </div>
                <div class="panel-body">
                <!-- <div class="col-md-2"></div> -->
                    
                    <form method="post" action="" name="addemp">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Employee Code(Must be unique):</label>
                       <div class="input-group">             
                              <span class="input-group-addon">
                          <i class="fa fa-lock" aria-hidden="true"></i>
                          </span>
                            <input  name="empcode" id="empcode" onBlur="checkAvailabilityEmpid()" type="text" autocomplete="off"  class="form-control" value="<?php echo htmlentities($result['EmpID']);?>" required>
                            
                        </div>
                        <span id="empid-availability" style="font-size:12px;"></span> 
                        </div>

                        <div class="form-group">
                                    <label for="exampleInputPassword1">First Name:</label>
                                   <div class="input-group">             
                                      <span class="input-group-addon">
                                  <i class="fa fa-user" aria-hidden="true"></i>
                                  </span>
                                        <input id="firstName" name="firstName" value="<?php echo htmlentities($result['First_Name']);?>" onBlur="checkAvailabilityFname()" type="text"  class="form-control" required>
                                        
                                    </div>
                                    <span id="fnameid-availability" style="font-size:12px;"></span> 
                        </div>
                        <div class="form-group">
                                    <label for="exampleInputPassword1">Last Name:</label>
                                   <div class="input-group">             
                                          <span class="input-group-addon">
                                      <i class="fa fa-user" aria-hidden="true"></i>
                                      </span>
                                        <input id="lastName" name="lastName" type="text" value="<?php echo htmlentities($result['Last_Name']);?>" onBlur="checkAvailabilityLname()" class="form-control" autocomplete="off" required>
                                        
                                    </div>
                                    <span id="lnameid-availability" style="font-size:12px;"></span> 
                        </div>
                        <div class="form-group">
                                    <label for="exampleInputPassword1">Middle Name:</label>
                                   <div class="input-group">             
                                          <span class="input-group-addon">
                                      <i class="fa fa-user" aria-hidden="true"></i>
                                      </span>
                                        <input id="middleName" name="middleName" type="text" onBlur="checkAvailabilityMname()" value="<?php echo htmlentities($result['Middle_Name']);?>" class="form-control" autocomplete="off">
                                        
                                    </div>
                                    <span id="mnameid-availability" style="font-size:12px;"></span> 
                            </div>
                            <div class="form-group">
                                    <label for="exampleInputPassword1">Phone Number:</label>
                                   <div class="input-group">             
                                          <span class="input-group-addon">
                                      <i class="fa fa-mobile" aria-hidden="true"></i>
                                      </span>
                                        <input id="phoneNo" name="mobileno" type="number" onBlur="checkAvailabilityPhoneNo()" value="<?php echo htmlentities($result['PhoneNo']);?>" class="form-control" autocomplete="off" required>
                                        
                                    </div>
                                    <span id="phoneid-availability" style="font-size:12px;"></span> 
                            </div>
                            <!--  -->
                            
                            
                            
                              </div>
                              
                                <div class="form-group">
                                    
              <label class="control-label"> Faculty/Collage <span class="required">*</span></label>
              <div class="input-group" id="state_fm_g">             
                  <span class="input-group-addon">
              <i class="fa fa-stumbleupon" aria-hidden="true"></i>
              </span>
              <select name="faculty" class="form-control" id="state_select">
              <option value="<?php echo htmlentities($result['Faculty']);?>"><?php echo htmlentities($result['Department']);?></option>
                                            <option>Select Faculty/Collage</option>
                                           <?php while ($srow = mysqli_fetch_assoc($state_all)) { ?>
                                                <option value="<?= $srow['Faculty'] ?>"><?= $srow['Faculty'] ?></option>
                                            <?php } ?>
                                 
                                            
                                        </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label">Department/Unit: <span class="required">*</span></label>
              <div class="input-group"  id="lga_fm_g">             
                  <span class="input-group-addon">
              <i class="fa fa-stumbleupon-circle" aria-hidden="true"></i>
              </span>
              <select name="department" class="form-control" id="lga_select">
                                            <option value="<?php echo htmlentities($result['Department']);?>"><?php echo htmlentities($result['Department']);?></option>
                                            <option>Select department/Unit</option>
                                            <?php while ($srow = mysqli_fetch_assoc($lga_all)) { ?>
                                                <option value="<?= $srow['Department'] ?>"
                                                        dir="<?= $srow['Faculty'] ?>"><?=  $srow['Department'] ?></option>
                                            <?php } ?>
                                            
                                        </select>
              </div>
              </div>

    <div class="form-group">
              <label class="control-label">Gender: <span class="required">*</span></label>
              <div class="input-group"  id="lga_fm_g">             
                  <span class="input-group-addon">
              <i class="fa fa-stumbleupon-circle" aria-hidden="true"></i>
              </span>
              <select  name="gender" autocomplete="off" class="form-control" required>
<option value="<?php echo htmlentities($emaill_fetch['sex']);?>"><?php echo htmlentities($emaill_fetch['sex']);?></option>                                          
<option value="Male">Male</option>
<option value="Female">Female</option>
<option value="Other">Other</option>
</select>
              </div>
              </div>

            
                            
                            <!--  -->
                              <div class="form-group">
                                    <label for="exampleInputPassword1">Email:</label>
                                   <div class="input-group">             
                                      <span class="input-group-addon">
                                  <i class="fa fa-eye" aria-hidden="true"></i>
                                  </span>
                                        <input id="email" name="email" type="email" value="<?php echo htmlentities($emaill_fetch['email']);?>" class="form-control" autocomplete="off" required>
                                        
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label for="exampleInputPassword1"> Country:</label>
                                  <div class="input-group">             
                                  <span class="input-group-addon">
                              <i class="fa fa-stumbleupon-circle" aria-hidden="true"></i>
                              </span>
                                        <input id="country" name="country" value="<?php echo htmlentities($emaill_fetch['nationality']);?>" type="text" class="form-control" autocomplete="off" required>
                                        
                                    </div>
                            </div>


                              </div>

                              <button type="submit" name="update"  id="add" style="float: right; margin-right: 120px; width: 120px;" class="btn btn-success btn-lg">UPDATE</button>

                    </form>
                  
                </div>
            </div>  
                
               
                
            </div>
          
           

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.js"></script>
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../vendor/raphael/raphael.min.js"></script>
    <script src="../vendor/morrisjs/morris.min.js"></script>
    <script src="../data/morris-data.js"></script>

    <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <script type="text/javascript">
        $('#lga_fm_g').show();
        
    $('#lga_select option').hide();
    $('#state_select').change(function () {
        $('#lga_select option').hide();
        var this_val = $(this).val();
        $('#lga_select option[dir=' + this_val + ']').show();
        $('#lga_fm_g').show();
        // alert('hey');
    });
</script>

</body>

</html>
