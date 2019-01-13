<?php
include('..\admin/includes/config.php');
session_start();
error_reporting(0);
// if ($_SESSION['eid'] == '') {
//     header('location:../index.php');
// }
//else{
$msg = '';
if(isset($_POST['add']))
{
$deptname=$_POST['departmentname'];
$factname=$_POST['factname'];
$deptcode=$_POST['deptcode']; 
//fetch and see if department exist
if (empty($deptname) || empty($factname)|| empty($deptcode)) {
    # code...
    echo "<script>alert('All Field are required')</script>";
}
$fetch = mysqli_query($con, "Select * from faculty_dept_tb where Department = '$deptname'");
if (mysqli_num_rows($fetch) > 1) {
      //$error = "Department Already Exist !!!"
      echo "<script>alert('Department Already Exist !!!')</script>";
  }
  else{  
$sql="INSERT INTO faculty_dept_tb(Faculty,Department,Department_shot_Name, CreationDate) VALUES('$factname','$deptname','$deptcode',CURDATE())";
$query = mysqli_query($con, $sql);
if (!$query) {
    $error = "Sorrry an error occur, Please try again!!" or die(mysql_error());
}
else
    $msg="Faculty and Department Created Successfully";

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
                    <h2 class="page-header" style="font-style: italic;color: black">Faculty/ Department Records</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <div>
                <?php
                    if (isset($msg) || !empty($msg)) {
                        echo $msg;
                    }
                ?>
            </div>
            <!-- /.row -->
            <div class="row">
                
               <div class="card_form ">
               <div class="panel panel-success">
                   <div class="panel-heading"><strong>Add Faculty or Department</strong></div>
                   <div class="panle-body" style="height: 300px;">
                       <form class="form-horizontal" method="POST" action="" style="margin-top: 30px;"> 
                                            <div class="form-group"> 
                                            <label for="inputEmail3" class="col-sm-3 control-label">Faculty Name:</label> 
                                            <div class="col-sm-6"> 
                                            <input id="departmentname" type="text"  class="form-control" autocomplete="off" name="factname"  required>
                                             </div> 
                                             </div> 
                                             

                                             <div class="form-group"> 
                                            <label for="inputEmail3" class="col-sm-3 control-label">Department Name:</label> 
                                            <div class="col-sm-6"> 
                                            <input id="departmentshortname" type="text"  class="form-control" autocomplete="off" name="departmentname"  required>
                                                
                                             </div> 
                                             </div> 


                                             <div class="form-group"> 
                                            <label for="inputEmail3" class="col-sm-3 control-label">Department Short Name:</label> 
                                            <div class="col-sm-6"> 
                                            <input id="deptcode" type="text" name="deptcode" class="form-control" autocomplete="off" required>
                                                
                                             </div> 
                                             </div> 

                                             

                                             <div class="col-sm-offset-2">
                                              <button type="submit" name="add" class="btn btn-primary" style="float: right; margin-right: 80px; height: 50px; width: 120px; margin-top: ">ADD </button> 
                                              
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
