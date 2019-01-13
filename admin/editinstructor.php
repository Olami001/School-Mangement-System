<?php
include('..\admin/includes/config.php');
session_start();
error_reporting(0);

$id = $_GET['id'];

$succ_msg = ''; $err_msg =''; $msg = '';
$fname = $phoneNo = $username ='';

if(isset($_POST['add']))
{
    $fname= ucwords($_POST['fullname']);
    $phoneNo = $_POST['phoneNo']; 
    $username = $_POST['username']; 
   
    $status = 1;
    if (empty($fname) || empty($phoneNo) ||empty($username)) 
    {
      echo "<script>alert('All filed are required Please Kindly Refill')</script>";
    } 
    else
    {
     
         $sql = mysqli_query($con, "Update instructor_tb set instructor_name = '$fname', username='$username', phoneNo ='$phoneNo' where id = '$id'");
         if (!$sql) 
                {
                   $error = "Error occur please Try Again";
                   $_SESSION['er_msg'] =   '<div class ="alert alert-danger"><strong>'.$error.'</strong></div>';
                   header('location:manageinstructor.php');
                }
              else{
                $succ_msg = "Instructor Record Update Successfully";                   
                $_SESSION['suc_msg'] =   '<div class ="alert alert-success"><strong>'.$succ_msg.'</strong></div>';
                header('location:manageinstructor.php');

              }

          

    } //end of parent else

}



$select = mysqli_query($con, "select * from instructor_tb where id = '$id'");
if (mysqli_num_rows($select)>0) { 
  # code...
$rows = mysqli_fetch_assoc($select);

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
                      <label for="exampleInputPassword1">Username  <span class="required">*</span> </label>
                     <div class="input-group">             
                            <span class="input-group-addon">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        </span>
                          <input id="username" name="username" type="text" value="<?=$rows['username']?>" onBlur="checkAvailabilityusername()" class="form-control" autocomplete="off" required>
                          
                      </div>
                      <span id="username-availability" style="font-size:12px;"></span> 
                      </div>

                        <div class="form-group">
                                    <label for="exampleInputPassword1">Full Name <span class="required">*</span></label>
                                   <div class="input-group">             
                                      <span class="input-group-addon">
                                  <i class="fa fa-user" aria-hidden="true"></i>
                                  </span>
                                        <input id="firstName" name="fullname" onBlur="checkAvailabilityFname()" type="text" value="<?=$rows['instructor_name']?>" class="form-control" required>
                                        
                                    </div>
                                    <span id="fnameid-availability" style="font-size:12px;"></span> 
                        </div>

                        <div class="form-group">
                                    <label for="exampleInputPassword1">Phone Number <span class="required">*</span> </label>
                                   <div class="input-group">             
                                          <span class="input-group-addon">
                                      <i class="fa fa-mobile" aria-hidden="true"></i>
                                      </span>
                                        <input id="phoneNo" name="phoneNo" type="number" value="<?=$rows['phoneNo']?>"  onBlur="checkAvailabilityPhoneNo2()" class="form-control" required autocomplete="off">
                                        
                                    </div>
                                    <span id="phoneid-availability" style="font-size:12px;"></span> 
                            </div>
                         
            
                         <button type="submit" name="add" onclick="return valid();" id="add" style="float: right;  " class="btn btn-primary btn-lg">Update Instructor</button>
                    </form>

                       </div>

                            

                

              
                            
                           
                    </div>
                </div>
            </div>  
                
               
                
            </div>
          
           

    </div>
    <?php
    }
    ?>
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

  

</body>

</html>

