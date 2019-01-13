<?php
include('..\admin/includes/config.php');
session_start();
error_reporting(0);

$succ_msg = ''; $err_msg =''; $msg = '';
$fname = $phoneNo = $username ='';

if(isset($_POST['add']))
{
    $fname= ucwords($_POST['fullname']);
    $phoneNo = $_POST['phoneNo']; 
    $username = $_POST['username']; 
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];
    $CreationDate = date('Y-m-d G:i:s');
    $status = 1;
    if (empty($fname) || empty($phoneNo) ||empty($username) || empty($password) || empty($confirmpassword)) 
    {
      echo "<script>alert('All filed are required Please Kindly Refill')</script>";
    } 
    else
    {
      $check_query = mysqli_query($con, "Select * from instructor_tb where username = '$username'");
      if (mysqli_num_rows($check_query) > 0)
      {
          $error = "username already exist";
          $msg =   '<div class ="alert alert-danger"><strong>'.$error.'</strong></div>';
      }
      else
      {
          $check_phone = mysqli_query($con, "select * from instructor_tb where phoneNo = '$phoneNo'");
          if (mysqli_num_rows($check_phone)>0)
          {
            $error = "Phone Number Already Exist";
            $msg = '<div class ="alert alert-danger"><strong>'.$error.'</strong></div>';
          }
          else
          {
              $target_dir = "uploads/instructor/";
              $target_file = $target_dir . basename($_FILES["passport"]["name"]);
              $uploadOk = 1;
              $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
              // Check if image file is a actual image or fake image
              $check = getimagesize($_FILES["passport"]["tmp_name"]);

               if($check == false) 
              {
                $error = "File is not an image. Please select Image file";
                $msg =   '<div class ="alert alert-danger"><strong>'.$error.'</strong></div>';
                $uploadOk = 0;
              }
              else 
              {
               if (file_exists($target_file)) 
              {
                $sql = mysqli_query($con, "INSERT INTO instructor_tb(instructor_name, phoneNo,username,password,passport, date_create) VALUES(
                      '$fname','$phoneNo','$username','$password','$target_file','$CreationDate')") or die( mysqli_error($con));
                if (!$sql) 
                  {
                      $error = "Error occur please Refill";

                      $msg =   '<div class ="alert alert-danger"><strong>'.$error.'</strong></div>';
                  }
                  else
                  {
                      $succ_msg = "New Instructor added Successfully";                   
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

                       $sql = mysqli_query($con, "INSERT INTO instructor_tb(instructor_name, phoneNo,username,password,passport, date_create) VALUES(
                      '$fname','$phoneNo','$username','$password','$target_file','$CreationDate')") or die( mysqli_error($con));

                      if (!$sql) 
                      {
                        $error = "Error occur please Refill";

                        $msg =   '<div class ="alert alert-danger"><strong>'.$error.'</strong></div>';
                      }
                      else{
                        $succ_msg = "New Instructor added Successfully";                   
                        $msg =   '<div class ="alert alert-success"><strong>'.$succ_msg.'</strong></div>';
                      }

                      } else {
                        $error =  "Sorry, there was an error uploading your file.";
                        $msg =   '<div class ="alert alert-danger"><strong>'.$error.'</strong></div>';
                      }
                    } 
              } //end of second child



              } 
          }
         
          

      } //end of first child

    } //end of parent else

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

    <title>Add Instructor</title>

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
if(x< 4)
{
    alert("Passwords must be More than four character.");
    return false;
}

}
</script>

<script>
function checkAvailabilityusername() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'username='+$("#username").val(),
type: "POST",
success:function(data){
$("#username-availability").html(data);
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
                    <h2 class="page-header" style="font-style: italic;color: black">Add Instructor</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
            <?php echo $msg; ?>
               <div class="panel panel-info">
                <div class="panel-heading">
                    <h4> <i class="fa fa-user-plus"> </i> Add New Instructor</h4>
                </div>
                <div class="panel-body">
                <h5 style="text-align: left; font-family: all;">All Asterisk (<span class="required">*</span>) field Must be fill</h5>
                <!-- colum 1 -->
                <div class="col-md-6">
                 
                 <form method="post" action="" name="addemp" enctype="multipart/form-data">
                

                        <div class="form-group">
                                    <label for="exampleInputPassword1">Full Name <span class="required">*</span></label>
                                   <div class="input-group">             
                                      <span class="input-group-addon">
                                  <i class="fa fa-user" aria-hidden="true"></i>
                                  </span>
                                        <input id="firstName" name="fullname" onBlur="checkAvailabilityFname()" type="text" value="<?=$fname?>" class="form-control" required>
                                        
                                    </div>
                                    <span id="fnameid-availability" style="font-size:12px;"></span> 
                        </div>

                        <div class="form-group">
                                    <label for="exampleInputPassword1">Phone Number <span class="required">*</span> </label>
                                   <div class="input-group">             
                                          <span class="input-group-addon">
                                      <i class="fa fa-mobile" aria-hidden="true"></i>
                                      </span>
                                        <input id="phoneNo" name="phoneNo" type="number" value="<?=$phoneNo?>"  onBlur="checkAvailabilityPhoneNo2()" class="form-control" required autocomplete="off">
                                        
                                    </div>
                                    <span id="phoneid-availability" style="font-size:12px;"></span> 
                            </div>
                          <div class="form-group">
                                    
              <label class="control-label"> Passport <span class="required">*</span></label>
              <div class="input-group">             
                  <span class="input-group-addon">
              <i class="fa fa-camera" aria-hidden="true"></i>
              </span>
              <input type="file" name="passport"  required="" class="form-control" />
              </div>
            </div>
            
                        

                       </div>

                            

                

                <!-- colum 2 -->
            
                <div class="col-md-6">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Username  <span class="required">*</span> </label>
                     <div class="input-group">             
                            <span class="input-group-addon">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        </span>
                          <input id="username" name="username" type="text" value="<?=$username?>" onBlur="checkAvailabilityusername()" class="form-control" autocomplete="off" required>
                          
                      </div>
                      <span id="username-availability" style="font-size:12px;"></span> 
                      </div>

                      <div class="form-group">
                      <label for="exampleInputPassword1">Password <span class="required">*</span> </label>
                     <div class="input-group">             
                            <span class="input-group-addon">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                          <input id="password" name="password" type="password"  onBlur="checkAvailabilitypassword()" class="form-control" autocomplete="off" required>
                          
                      </div>
                      <span id="password-availability" style="font-size:12px;"></span> 
                      </div>

                      <div class="form-group">
                      <label for="exampleInputPassword1">Confirm Password <span class="required">*</span>  </label>
                     <div class="input-group">             
                            <span class="input-group-addon">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                          <input id="confirmpassword" name="confirmpassword" type="password"  onBlur="checkAvailabilityconpassword()" class="form-control" autocomplete="off" required>
                          
                      </div>
                      <span id="conpassword-availability" style="font-size:12px;"></span> 
                      </div>

                </div>
                            
                            <button type="submit" name="add" onclick="return valid();" id="add" style="float: right; width: 150px;" class="btn btn-primary btn-lg">ADD Instructor</button>
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

