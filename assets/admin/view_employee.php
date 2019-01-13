<?php
include('..\admin/includes/config.php');
session_start();
// if ($_SESSION['eid'] == '') {
//     header('location:../index.php');
// }

$succ_msg = ''; $err_msg =''; $msg = '';
$state_all = mysqli_query($con, "select DISTINCT Faculty from faculty_dept_tb where 1");
$lga_all = mysqli_query($con, "select * from faculty_dept_tb");


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
                    <h2 class="page-header" style="font-style: italic;color: black">Staff Record</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
            <?php 

                $eid=$_GET['EmpID'];
//echo "<script>alert('$eid')</script>";
$sql = "SELECT * from  employee_tb where EmpID= '$eid'";

$query = mysqli_query($con, $sql);
$cnt=1;

if(mysqli_num_rows($query)<1)
{
header('location:manageemployee.php');
}
$result = mysqli_fetch_assoc($query)
              ?> 

           
               <div class="panel panel-success">
                <div class="panel-heading">
                    <h4>View Staff Record</h4>
                </div>
                <div class="panel-body">
               <!--  <div class="col-md-2"></div> -->
                    <div class="col-md-6">
                   <form>
                   <div class="row">
        <div class="col-m12">
        
            <label style="font-weight: bold; font-size: 1em; color: rgb(40,40,80);">Employee Number :</label>
        <div>
            <input type="text" name="" class="form-control" value="<?php echo htmlentities($result['EmpID']);?>" readonly style="padding-top: 1px; padding-left: 7px;" >
        </div>
        </div>

        <div class="col-m12">
        
            <label >First Name :</label>
        <div>
            <input type="text" name="" class="form-control" value="<?php echo htmlentities($result['First_Name']);?>" readonly style=" padding-top: 1px; padding-left: 7px;" >
        </div>
        </div>

        <div class="col-m12">
        
            <label >Last Name :</label>
        <div>
            <input type="text" name="" class="form-control" value="<?php echo htmlentities($result['Last_Name']);?>" readonly style=" padding-top: 1px; padding-left: 7px;" >
        </div>
        </div>

        <div class="col-m12">
        
            <label >Middle Name :</label>
        <div>
            <input type="text" name="" class="form-control" value="<?php echo htmlentities($result['Middle_Name']);?>" readonly style=" padding-top: 1px; padding-left: 7px;" >
        </div>
        </div>

            <?php
    $emaill = mysqli_query($con, "SELECT * FROM personaldata_tb where EmpID = '$eid'");
    $emaill_fetch = mysqli_fetch_assoc($emaill);
?>

         <div class="col-m12">
        
            <label >Email Address :</label>
        <div>
            <input type="text" name="" class="form-control" value="<?php echo htmlentities($emaill_fetch['email']);?>" readonly style=" padding-top: 1px; padding-left: 7px;" >
        </div>
        </div>

        <div class="col-m12">
<label for="phone">Phone Number</label>
<input id="phone" name="mobileno" class="form-control" type="tel" value="<?php echo htmlentities($result['PhoneNo']);?>" maxlength="10" readonly autocomplete="off" required>
 </div>

 <div class="col-m12">
<label for="phone">Faculty/College</label>
<input id="phone" name="mobileno" class="form-control" type="tel" value="<?php echo htmlentities($result['Faculty']);?>" maxlength="10" readonly autocomplete="off" required>
 </div>

 <div class="col-m12">
<label for="phone">Department</label>
<input id="phone" name="mobileno" class="form-control" type="tel" value="<?php echo htmlentities($result['Department']);?>" maxlength="10" readonly autocomplete="off" required>
 </div>

 </div>




    </form>
 
                    </div>

                    <div class="col-md-6">
                    <div class="col-md-4"></div>
                        <div class="col-md-12">
        
            <label >Staff Image :</label>
        <div>
           <img src="<?=$emaill_fetch['user_image']?>" class="img img-thumbnail" width="210px;">
        </div>
        </div>
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
