<?php
include('..\admin/includes/config.php');
session_start();
error_reporting(0);
// if ($_SESSION['eid'] == '') {
//     header('location:../index.php');
// }
$msg = '';

    $eid = ($_GET['EmpID']);

//echo "<script>alert('$eid')</script>";

$sql = mysqli_query($con, "Select * from employee_tb where EmpID = '$eid'");
$fetch = mysqli_fetch_assoc($sql);
$dept_name = $fetch['Department'];
$fname = $fetch['First_Name'] . " ". $fetch['Middle_Name']. " ". $fetch['Last_Name'];

if(isset($_POST['add']))
{
$post_name=$_POST['post_name'];
$dept=$_POST['dept'];

$sql = mysqli_query($con, "UPDATE employee_tb set post = '$post_name' where EmpID = '$eid' ") or die(mysqli_error($con));
    if (!$sql) {
       $error="Something went wrong. Please try again";
    }
    else
        $_SESSION['success_msg'] = $fname ." ". ' has been assigned'." ".$post_name. " of ". $dept. " ". 'Successfully';                   
                $msg =   '<div class ="alert alert-success"><strong>'.$_SESSION['success_msg'].'</strong></div>';
        header('location:manageemployee.php');


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

    <title>UHRMS</title>

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
    .card_form{
         width: 900px;
    height: 400px;
    padding: 15px;
   margin-left: 90px;
    background-color: #fafaff;
    box-shadow: 20px 12px 5px grey;

    }
    .control-label{
    color: rgb(0,0,0);
    font-weight: bold;
    font-style: italic;
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
                    <h2 class="page-header" style="font-style: italic;color: black">Assign Head of Department</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                
               <div class="card_form ">
               <div class="panel panel-success">
                   <div class="panel-heading"><strong>Assign New Hod</strong></div>
                   <div class="panle-body" style="height: 300px;">
                       <form class="form-horizontal" method="POST" action="" style="margin-top: 30px;"> 
                                            <div class="form-group"> 
                                            <label for="inputEmail3" class="col-sm-3 control-label">Post:</label> 
                                            <div class="col-sm-6"> 
                                            <input  type="text"  class="form-control" autocomplete="off" name="post_name" value="Head of Department" required readonly="">
                                             </div> 
                                             </div> 
                                             <div class="form-group"> 
                                             <label for="inputPassword3" class="col-sm-3 control-label">Department:</label> 
                                             <div class="col-sm-6"> 
                                             <input  type="text"  class="form-control" autocomplete="off" name="dept" value="<?php echo $dept_name;?>"  required readonly>
                                             </div> 
                                             </div> 
                                             

                                             <div class="col-sm-offset-2">
                                              <button type="submit" name="add" class="btn btn-primary" style="float: right; margin-right: 80px; height: 50px; width: 120px; margin-top: ">Assign</button> 
                                              
                                              </div>
                        </form>
                   </div>
               </div>
               </div>
               
                
            </div>
          
           

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../vendor/raphael/raphael.min.js"></script>
    <script src="../vendor/morrisjs/morris.min.js"></script>
    <script src="../data/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
