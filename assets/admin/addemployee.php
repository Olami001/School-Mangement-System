<?php
include('..\admin/includes/config.php');
session_start();
// if ($_SESSION['eid'] == '') {
//     header('location:../index.php');
// }

$succ_msg = ''; $err_msg =''; $msg = '';
$state_all = mysqli_query($con, "select DISTINCT Faculty from faculty_dept_tb where 1");
$lga_all = mysqli_query($con, "select * from faculty_dept_tb");

if(isset($_POST['add']))
{
$empid=$_POST['empcode'];
$fname=$_POST['firstName'];
$lname=$_POST['lastName'];   
$middleName=$_POST['middleName']; 
$password=md5($_POST['password']); 
$department=$_POST['department'];
$faculty = $_POST['faculty'];
$phoneNo = $_POST['phoneNo']; 
$confirmpassword = $_POST['confirmpassword'];
$CreationDate = date('Y-m-d G:i:s');
$status = 1;
        if (empty($fname) || empty($lname) || empty($empid)|| empty($password)||empty($faculty)|| empty($department) ||empty($confirmpassword) || empty($phoneNo)) {
        echo "<script>alert('All filed are required Please Kindly Refill')</script>";
        }
        
      
else{
    $check_query = mysqli_query($con, "Select * from employee_tb where EmpID = '$empid'");
    if (mysqli_num_rows($check_query) > 0) {
        $error = "Staff already exist";

                $msg =   '<div class ="alert alert-danger"><strong>'.$error.'</strong></div>';
    }
    else{
        //API code for sending sms
        // $a=urlencode('binraheem01@gmail.com'); //Note: urlencodemust be added forusername and
        // $b=urlencode('babatunde'); // passwordas encryption code for security purpose.
        // $pass = $_POST['password'];
        // $c="Congratulation Dear ".$fname." You have been employeed as a staff into Usmanu Danfodiyo Univerity sokoto. Your staff ID is".$empid. " ". " Your Password is" .$pass. " Vist http://uhrms/index.php to login";
        // $d= "UDUS JOB";
        // $e=$phoneNo;
        // $url = "http://portal.bulksmsnigeria.net/api/?username=".$a."&password=".$b."&message=".$c."&sender=".$d."&mobiles=".$e;
        // $ch = curl_init();
        // curl_setopt($ch,CURLOPT_URL, $url);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // curl_setopt($ch, CURLOPT_HEADER, 0);
        // $resp = curl_exec($ch);
        // echo $resp; // Add double slash or delete “echo”
        // echo "<br>Thank you for using Bulk SMS Nigeria API"; // Your notification message here
        // curl_close($ch);
        // if ($resp) {
             $sql = mysqli_query($con, "INSERT INTO employee_tb(EmpID, First_Name,Last_Name,Middle_Name,Password,Department,Faculty, PhoneNo, CreationDate, status) VALUES('$empid',
            '$fname','$lname','$middleName','$password','$department','$faculty','$phoneNo','$CreationDate','$status')");
         if (!$sql) {
             $error = "Error occur please Refill";

                $msg =   '<div class ="alert alert-danger"><strong>'.$error.'</strong></div>';
         }
         else
            $succ_msg = "New Staff added Successfully";                   
                $msg =   '<div class ="alert alert-success"><strong>'.$succ_msg.'</strong></div>';
            
        // }
        // else{
        //     $error = "No Network Detected. Check your connection";
        // }


    
    }
}


}

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
                    <h2 class="page-header" style="font-style: italic;color: black">Add employee</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
            <?php echo $msg; ?>
               <div class="panel panel-success">
                <div class="panel-heading">
                    <h4>Add New employee</h4>
                </div>
                <div class="panel-body">
                <div class="col-md-2"></div>
                    <div class="col-md-6">
                    <form method="post" action="" name="addemp">
                        <div class="form-group">
                            <label>Employee Code(Must be unique):</label>
                       <div class="input-group">             
                              <span class="input-group-addon">
                          <i class="fa fa-lock" aria-hidden="true"></i>
                          </span>
                            <input  name="empcode" id="empcode" onBlur="checkAvailabilityEmpid()" type="text" autocomplete="off"  class="form-control" placeholder="Example SP-001" required>
                            
                        </div>
                        <span id="empid-availability" style="font-size:12px;"></span> 
                        </div>

                        <div class="form-group">
                                    <label for="exampleInputPassword1">First Name:</label>
                                   <div class="input-group">             
                                      <span class="input-group-addon">
                                  <i class="fa fa-user" aria-hidden="true"></i>
                                  </span>
                                        <input id="firstName" name="firstName" onBlur="checkAvailabilityFname()" type="text"  class="form-control" required>
                                        
                                    </div>
                                    <span id="fnameid-availability" style="font-size:12px;"></span> 
                        </div>
                        <div class="form-group">
                                    <label for="exampleInputPassword1">Last Name:</label>
                                   <div class="input-group">             
                                          <span class="input-group-addon">
                                      <i class="fa fa-user" aria-hidden="true"></i>
                                      </span>
                                        <input id="lastName" name="lastName" type="text"  onBlur="checkAvailabilityLname()" class="form-control" autocomplete="off" required>
                                        
                                    </div>
                                    <span id="lnameid-availability" style="font-size:12px;"></span> 
                        </div>
                        <div class="form-group">
                                    <label for="exampleInputPassword1">Middle Name:</label>
                                   <div class="input-group">             
                                          <span class="input-group-addon">
                                      <i class="fa fa-user" aria-hidden="true"></i>
                                      </span>
                                        <input id="middleName" name="middleName" type="text" onBlur="checkAvailabilityMname()" class="form-control" autocomplete="off">
                                        
                                    </div>
                                    <span id="mnameid-availability" style="font-size:12px;"></span> 
                            </div>
                            <div class="form-group">
                                    <label for="exampleInputPassword1">Phone Number:</label>
                                   <div class="input-group">             
                                          <span class="input-group-addon">
                                      <i class="fa fa-mobile" aria-hidden="true"></i>
                                      </span>
                                        <input id="phoneNo" name="phoneNo" type="number" onBlur="checkAvailabilityPhoneNo()" class="form-control" autocomplete="off" required>
                                        
                                    </div>
                                    <span id="phoneid-availability" style="font-size:12px;"></span> 
                            </div>
                            <!--  -->
                            <div class="form-group">
                                    
              <label class="control-label"> Faculty/Collage <span class="required">*</span></label>
              <div class="input-group" id="state_fm_g">             
                  <span class="input-group-addon">
              <i class="fa fa-stumbleupon" aria-hidden="true"></i>
              </span>
              <select name="faculty" class="form-control" id="state_select">
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
                                            <option value="">Select Department/Unit</option>
                                            <?php while ($srow = mysqli_fetch_assoc($lga_all)) { ?>
                                                <option value="<?= $srow['Department'] ?>"
                                                        dir="<?= $srow['Faculty'] ?>"><?=  $srow['Department'] ?></option>
                                            <?php } ?>
                                            
                                        </select>
              </div>
              </div>
            
                            
                            <!--  -->
                              <div class="form-group">
                                    <label for="exampleInputPassword1">Password:</label>
                                   <div class="input-group">             
                                      <span class="input-group-addon">
                                  <i class="fa fa-eye" aria-hidden="true"></i>
                                  </span>
                                        <input id="password" name="password" type="password" class="form-control" autocomplete="off" required>
                                        
                                    </div>
                            </div>
                            <div class="form-group">
                                    <label for="exampleInputPassword1"> Confirm Password:</label>
                                  <div class="input-group">             
                                  <span class="input-group-addon">
                              <i class="fa fa-eye" aria-hidden="true"></i>
                              </span>
                                        <input id="confirm" name="confirmpassword" type="password" class="form-control" autocomplete="off" required>
                                        
                                    </div>
                            </div>
                            
                            <button type="submit" name="add" onclick="return valid();" id="add" style="float: right; width: 120px;" class="btn btn-success btn-lg">ADD</button>
                    </form>
                    </div>
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
