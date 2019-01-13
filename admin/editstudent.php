<?php
include('..\admin/includes/config.php');
session_start();
error_reporting(0);
$getid = trim($_GET['id']);

$succ_msg = ''; $err_msg =''; $msg = '';
$state_all = mysqli_query($con, "select DISTINCT name from lga where 1");
$lga_all = mysqli_query($con, "select * from lga");
$fname = $lname = $middleName =$state = $lga = $dob =$phoneNo = $p_phoneNo =$nationality =$address ='';

if(isset($_POST['add']))
{
$stud_id=$_POST['stud_id'];
$fname= ucwords($_POST['firstName']);
$lname= ucwords($_POST['lastName']);   
$middleName=ucwords($_POST['middleName']); 
$state=$_POST['state'];
$lga = $_POST['lga'];
$dob = $_POST['dob'];
$phoneNo = $_POST['phoneNo']; 
$p_phoneNo = $_POST['p_phoneNo']; 
$nationality = $_POST['nationality'];
$address = ucwords($_POST['address']);
$CreationDate = date('Y-m-d G:i:s');
$status = 1;
        if (empty($fname) || empty($lname) || empty($state)|| empty($dob) || empty($lga) ||empty($p_phoneNo)||empty($nationality) || empty($address)) {
        echo "<script>alert('All filed are required Please Kindly Refill')</script>";
        }
        
      
else{
          // insert new student record;
               $sql = mysqli_query($con, "UPDATE student_tb SET  fname = '$fname',lname = '$lname',mname = '$middleName',dob = '$dob',phone_no = '$phoneNo',parent_no = '$p_phoneNo', state = '$state', lga = '$lga', nationality = '$nationality', address = '$address', date_create = '$CreationDate' where student_adm ='$getid'") or die( mysqli_error($con));

                if (!$sql) 
                {
                   $error = "Error occur please Refill";
                   $_SESSION['er_msg'] =   '<div class ="alert alert-danger"><strong>'.$error.'</strong></div>';
                   header('location:managestudent.php');
                }
              else{
                $succ_msg = "Student Record Update Successfully";                   
                $_SESSION['suc_msg'] =   '<div class ="alert alert-success"><strong>'.$succ_msg.'</strong></div>';
                header('location:managestudent.php');

              }

        }
       
    
    }



// fetching all in array
$fetch = mysqli_query($con, "select * from student_tb where student_adm ='$getid'");
if (mysqli_num_rows($fetch)<1) {
    header('location:managestudent.php');
}
else{
$rows = mysqli_fetch_assoc($fetch);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Add Student</title>

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

    <!-- custom css -->
    <link rel="stylesheet" type="text/css" href="../assets/css/custom.css">

<style type="text/css">
    .img h4,h5,p{
        text-align: center; font-weight: bold;
    }
    #side-menu li a{
         color: rgb(51,122,183);
    }
    .required{
      color: red; font-size: 1.1em;
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
data:'stud_id='+$("#stud_id").val(),
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
                <a class="navbar-brand" href="index.php"><span style="font-size: 22px; font-weight: bold; color: rgb(51,122,183);">MSS</span></a>
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
                    <h2 class="page-header" style="font-style: italic;color: black">Update Student</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
           
               <div class="panel panel-info">
                <div class="panel-heading">
                    <h4> <i class="fa fa-user-plus"> </i> Update Student Info</h4>
                </div>
                <div class="panel-body">
                <h5 style="text-align: left; font-family: all;">All Asterisk (<span class="required">*</span>) field Must be fill</h5>
                <!-- colum 1 -->
                <div class="col-md-6">
                 
                 <form method="post" action="" name="addemp" enctype="multipart/form-data">
                 <div class="form-group">
                            <label>Student Admission <span class="required">*</span></label>
                       <div class="input-group">             
                              <span class="input-group-addon">
                          <i class="fa fa-lock" aria-hidden="true"></i>
                          </span>
                            <input  name="stud_id" id="stud_id" type="text" onBlur="checkAvailabilityEmpid()" value="<?=$rows['student_adm'];?>"  class="form-control" >
                            
                        </div>
                        
                        </div>

                        <div class="form-group">
                                    <label for="exampleInputPassword1">First Name <span class="required">*</span></label>
                                   <div class="input-group">             
                                      <span class="input-group-addon">
                                  <i class="fa fa-user" aria-hidden="true"></i>
                                  </span>
                                        <input id="firstName" name="firstName" onBlur="checkAvailabilityFname()" type="text" value="<?=$rows['fname'];?>"  class="form-control" required>
                                        
                                    </div>
                                    <span id="fnameid-availability" style="font-size:12px;"></span> 
                        </div>
                        <div class="form-group">
                                    <label for="exampleInputPassword1">Last Name <span class="required">*</span></label>
                                   <div class="input-group">             
                                          <span class="input-group-addon">
                                      <i class="fa fa-user" aria-hidden="true"></i>
                                      </span>
                                        <input id="lastName" name="lastName" type="text" value="<?=$rows['lname'];?>" onBlur="checkAvailabilityLname()" class="form-control" autocomplete="off" required>
                                        
                                    </div>
                                    <span id="lnameid-availability" style="font-size:12px;"></span> 
                        </div>

                        <div class="form-group">
                                    <label for="exampleInputPassword1">Middle Name </label>
                                   <div class="input-group">             
                                          <span class="input-group-addon">
                                      <i class="fa fa-user" aria-hidden="true"></i>
                                      </span>
                                        <input id="middleName" name="middleName" type="text" value="<?=$rows['mname'];?>" onBlur="checkAvailabilityMname()" class="form-control" autocomplete="off">
                                        
                                    </div>
                                    <span id="mnameid-availability" style="font-size:12px;"></span> 
                            </div>

                            <div class="form-group">
                                    <label for="exampleInputPassword1">Date of Birth <span class="required">*</span></label>
                                   <div class="input-group">             
                                          <span class="input-group-addon">
                                      <i class="fa fa-user" aria-hidden="true"></i>
                                      </span>
                                        <input id="dob" name="dob" type="date" class="form-control" value="<?=$rows['dob'];?>" required="">
                                        
                                    </div>
                                    
                            </div>

                            <div class="form-group">
                                    <label for="exampleInputPassword1">Address <span class="required">*</span> </label>
                                   <div class="input-group">             
                                          <span class="input-group-addon">
                                      <i class="fa fa-user" aria-hidden="true"></i>
                                      </span>
                                        <textarea class="form-control" required name="address" value="<?=$rows['address'];?>"></textarea>
                                        
                                    </div>
                                    
                            </div>

                </div>

                <!-- colum 2 -->
                    <div class="col-md-6">
                    
                        
                            <div class="form-group">
                                    <label for="exampleInputPassword1">Phone Number </label>
                                   <div class="input-group">             
                                          <span class="input-group-addon">
                                      <i class="fa fa-mobile" aria-hidden="true"></i>
                                      </span>
                                        <input id="phoneNo" name="phoneNo" type="number" value="<?=$rows['phone_no']?>" onBlur="checkAvailabilityPhoneNo()" class="form-control" autocomplete="off">
                                        
                                    </div>
                                    <span id="phoneid-availability" style="font-size:12px;"></span> 
                            </div>

                            <div class="form-group">
                                    <label for="exampleInputPassword1"> Parent or Guardian Phone Number <span class="required">*</span></label>
                                   <div class="input-group">             
                                          <span class="input-group-addon">
                                      <i class="fa fa-mobile" aria-hidden="true"></i>
                                      </span>
                                        <input id="p_phoneNo" name="p_phoneNo" type="number" value="<?=$rows['parent_no'];?>" onBlur="checkAvailabilityPhoneNo()" class="form-control" autocomplete="off" required>
                                        
                                    </div>
                                    <span id="phoneid-availability" style="font-size:12px;"></span> 
                            </div>

                            <!--  -->
                            <div class="form-group">
                                    
              <label class="control-label"> State of Origin <span class="required">*</span></label>
              <div class="input-group" id="state_fm_g">             
                  <span class="input-group-addon">
              <i class="fa fa-stumbleupon" aria-hidden="true"></i>
              </span>
              <select name="state" class="form-control" id="state_select">
                                            <option><?=$rows['state']?></option>
                                            <option value=""> </option>
                                           <?php while ($srow = mysqli_fetch_assoc($state_all)) { ?>
                                                <option value="<?= $srow['name'] ?>"><?= $srow['name'] ?></option>
                                            <?php } ?>
                                 
                                            
                                        </select>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label">Local Gov't: <span class="required">*</span></label>
              <div class="input-group"  id="lga_fm_g">             
                  <span class="input-group-addon">
              <i class="fa fa-stumbleupon-circle" aria-hidden="true"></i>
              </span>
              <select name="lga" class="form-control" id="lga_select" required>
                                            <option><?=$rows['lga']?></option>
                                            <option value=""> </option>
                                            <?php while ($srow = mysqli_fetch_assoc($lga_all)) { ?>
                                                <option value="<?= $srow['lga'] ?>"
                                                        dir="<?= $srow['name'] ?>"><?= $srow['name']." ". $srow['lga'] ?></option>
                                            <?php } ?>
                                            
                                        </select>
              </div>
              </div>

               <div class="form-group">
                                    
              <label class="control-label"> Nationality <span class="required">*</span></label>
              <div class="input-group" id="state_fm_g">             
                  <span class="input-group-addon">
              <i class="fa fa-stumbleupon" aria-hidden="true"></i>
              </span>
              <select name="nationality" class="form-control" id="state_select" required>
                                            <option><?=$rows['nationality']; ?></option>
                                            <option value=" "> </option>
                                            <option value="Nigeria">Nigeria</option>
                                          
                                 
                                            
                                        </select>
              </div>
            </div>
            
                            
                            <!--  -->
                              
                            
                            <button type="submit" name="add" onclick="return valid();" id="add" style="float: right; width: 150px;" class="btn btn-primary btn-lg">Update Student</button>
                    </form>
                    </div>
                </div>
            </div>  
                
               
                <?php }?>
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
