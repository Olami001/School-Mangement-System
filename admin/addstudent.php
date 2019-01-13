<?php
include('..\admin/includes/config.php');
session_start();
error_reporting(0);

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
        if (empty($fname) || empty($lname) || empty($stud_id)|| empty($state)|| empty($dob) || empty($lga) ||empty($p_phoneNo)  ||empty($nationality) || empty($address)) {
        echo "<script>alert('All filed are required Please Kindly Refill')</script>";
        }
        
      
else{
    $check_query = mysqli_query($con, "Select * from student_tb where student_adm = '$stud_id'");
    if (mysqli_num_rows($check_query) > 0) {
        $error = "student already exist";

                $msg =   '<div class ="alert alert-danger"><strong>'.$error.'</strong></div>';
    }
    else{



        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["passport"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        // Check if image file is a actual image or fake image
        // if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["passport"]["tmp_name"]);
            if($check !== false) {
                //echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                $error = "File is not an image. Please select Image file";
                $msg =   '<div class ="alert alert-danger"><strong>'.$error.'</strong></div>';
                $uploadOk = 0;
            }
        // }
        // Check if file already exists
        if (file_exists($target_file)) {
            // $error = "Sorry, file already exists.";
            // $msg =   '<div class ="alert alert-danger"><strong>'.$error.'</strong></div>';
            // $uploadOk = 0;

          // insert new student record;
               $sql = mysqli_query($con, "INSERT INTO student_tb(student_adm, fname,lname,mname,dob,phone_no,parent_no, state, lga, nationality, address,passport , date_create) VALUES('$stud_id',
              '$fname','$lname','$middleName','$dob','$phoneNo','$p_phoneNo','$state','$lga','$nationality','$address','$target_file','$CreationDate')") or die( mysqli_error($con));

                if (!$sql) 
                {
                   $error = "Error occur please Refill";

                    $msg =   '<div class ="alert alert-danger"><strong>'.$error.'</strong></div>';
                }
              else{
            $succ_msg = "New student added Successfully";                   
                $msg =   '<div class ="alert alert-success"><strong>'.$succ_msg.'</strong></div>';
              }

        }
        else
        {


          // Check file size
          if ($_FILES["passport"]["size"] > 5000000) 
          {
              $error = "Sorry, your file is too large. Must not be more than 5MB";
              $msg =   '<div class ="alert alert-danger"><strong>'.$error.'</strong></div>';
              $uploadOk = 0;
          }
          // Allow certain file formats
          if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) 
          {
              $error =  "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $msg =   '<div class ="alert alert-danger"><strong>'.$error.'</strong></div>';
              $uploadOk = 0;
          }
        // Check if $uploadOk is set to 0 by an error
          if ($uploadOk == 0) 
          {
              $error =  "Sorry, your file was not uploaded. Please retry";
          // if everything is ok, try to upload file
          } 
          else {
            if (move_uploaded_file($_FILES["passport"]["tmp_name"], $target_file)) 
            {
                //echo "The file ". basename( $_FILES["passport"]["name"]). " has been uploaded.";

                  // insert new student record;
               $sql = mysqli_query($con, "INSERT INTO student_tb(student_adm, fname,lname,mname,dob,phone_no,parent_no, state, lga, nationality, address,passport , date_create) VALUES('$stud_id',
              '$fname','$lname','$middleName','$dob','$phoneNo','$p_phoneNo','$state','$lga','$nationality','$address','$target_file','$CreationDate')") or die( mysqli_error($con));

                if (!$sql) 
                {
                   $error = "Error occur please Refill";

                    $msg =   '<div class ="alert alert-danger"><strong>'.$error.'</strong></div>';
                }
              else{
            $succ_msg = "New student added Successfully";                   
                $msg =   '<div class ="alert alert-success"><strong>'.$succ_msg.'</strong></div>';
              }

            } else {
                $error =  "Sorry, there was an error uploading your file.";
                $msg =   '<div class ="alert alert-danger"><strong>'.$error.'</strong></div>';
            }
        }
      }


        
        


    
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
                    <h2 class="page-header" style="font-style: italic;color: black">Add Student</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
            <?php echo $msg; ?>
               <div class="panel panel-info">
                <div class="panel-heading">
                    <h4> <i class="fa fa-user-plus"> </i> Add New Student</h4>
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
                            <input  name="stud_id" id="stud_id" type="text" onBlur="checkAvailabilityEmpid()"  class="form-control" required>
                            
                        </div>
                        <span id="empid-availability" style="font-size:12px;"></span> 
                        </div>

                        <div class="form-group">
                                    <label for="exampleInputPassword1">First Name <span class="required">*</span></label>
                                   <div class="input-group">             
                                      <span class="input-group-addon">
                                  <i class="fa fa-user" aria-hidden="true"></i>
                                  </span>
                                        <input id="firstName" name="firstName" onBlur="checkAvailabilityFname()" type="text" value="<?=$fname?>"  class="form-control" required>
                                        
                                    </div>
                                    <span id="fnameid-availability" style="font-size:12px;"></span> 
                        </div>
                        <div class="form-group">
                                    <label for="exampleInputPassword1">Last Name <span class="required">*</span></label>
                                   <div class="input-group">             
                                          <span class="input-group-addon">
                                      <i class="fa fa-user" aria-hidden="true"></i>
                                      </span>
                                        <input id="lastName" name="lastName" type="text" value="<?=$lname?>" onBlur="checkAvailabilityLname()" class="form-control" autocomplete="off" required>
                                        
                                    </div>
                                    <span id="lnameid-availability" style="font-size:12px;"></span> 
                        </div>

                        <div class="form-group">
                                    <label for="exampleInputPassword1">Middle Name </label>
                                   <div class="input-group">             
                                          <span class="input-group-addon">
                                      <i class="fa fa-user" aria-hidden="true"></i>
                                      </span>
                                        <input id="middleName" name="middleName" type="text" value="<?=$middleName?>" onBlur="checkAvailabilityMname()" class="form-control" autocomplete="off">
                                        
                                    </div>
                                    <span id="mnameid-availability" style="font-size:12px;"></span> 
                            </div>

                            <div class="form-group">
                                    <label for="exampleInputPassword1">Date of Birth <span class="required">*</span></label>
                                   <div class="input-group">             
                                          <span class="input-group-addon">
                                      <i class="fa fa-user" aria-hidden="true"></i>
                                      </span>
                                        <input id="dob" name="dob" type="date" class="form-control" value="<?=$dob?>" required="">
                                        
                                    </div>
                                    
                            </div>

                            <div class="form-group">
                                    <label for="exampleInputPassword1">Address <span class="required">*</span> </label>
                                   <div class="input-group">             
                                          <span class="input-group-addon">
                                      <i class="fa fa-user" aria-hidden="true"></i>
                                      </span>
                                        <textarea class="form-control" required="" name="address" value="<?=$address?>"></textarea>
                                        
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
                                        <input id="phoneNo" name="phoneNo" type="number" value="<?=$phoneNo?>" onBlur="checkAvailabilityPhoneNo()" class="form-control" autocomplete="off">
                                        
                                    </div>
                                    <span id="phoneid-availability" style="font-size:12px;"></span> 
                            </div>

                            <div class="form-group">
                                    <label for="exampleInputPassword1"> Parent or Guardian Phone Number <span class="required">*</span></label>
                                   <div class="input-group">             
                                          <span class="input-group-addon">
                                      <i class="fa fa-mobile" aria-hidden="true"></i>
                                      </span>
                                        <input id="p_phoneNo" name="p_phoneNo" type="number" value="<?=$p_phoneNo?>" onBlur="checkAvailabilityPhoneNo()" class="form-control" autocomplete="off" required>
                                        
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
                                            <option>Select state of Origin</option>
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
              <select name="lga" class="form-control" id="lga_select">
                                            <option value="">Select Local Gov't</option>
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
              <select name="nationality" class="form-control" id="state_select">
                                            <option>Select country</option>
                                            <option value="Nigeria">Nigeria</option>  
                                        </select>
              </div>
            </div>

            <div class="form-group">
                                    
              <label class="control-label"> Passport <span class="required">*</span></label>
              <div class="input-group" id="state_fm_g">             
                  <span class="input-group-addon">
              <i class="fa fa-camera" aria-hidden="true"></i>
              </span>
              <input type="file" name="passport"  required="" class="form-control" />
              </div>
            </div>
            
                            
                            <!--  -->
                              
                            
                            <button type="submit" name="add" onclick="return valid();" id="add" style="float: right; width: 150px;" class="btn btn-primary btn-lg">ADD Student</button>
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
