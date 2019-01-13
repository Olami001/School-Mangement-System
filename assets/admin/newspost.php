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
$new_head=$_POST['new_head'];
$newsto = $_POST['newsto'];
$description=$_POST['description'];
$CreationDate = date('Y-m-d G:i:s');
// change each word to uppercase
$new_head_cas = ucwords($new_head);
//echo "<script>alert('$newsto')</script>";
$sql = mysqli_query($con, "INSERT INTO notice_tb(notice_heading,notice_body,distr_to, CreationDate, distr_by) 
    VALUES('$new_head_cas','$description','$newsto','$CreationDate','Register')");
    if (!$sql) {
       $error="Something went wrong. Please try again";

    $msg =   '<div class ="alert alert-danger"><strong>'.$error.'</strong></div>';
    }
    else
        $succ_msg="News Posted  Successfully";
    $msg =   '<div class ="alert alert-success"><strong>'.$succ_msg.'</strong></div>';


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
                    <h2 class="page-header" style="font-style: italic;color: black"> Information Dessimination</h2>
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
                   <div class="panel-heading"><strong>Post Information</strong></div>
                   <div class="panle-body" style="height: 300px;">
                       <form class="form-horizontal" method="POST" action="" style="margin-top: 30px;"> 
                                            <div class="form-group"> 
                                            <label for="inputEmail3" class="col-sm-3 control-label">New Heading:</label> 
                                            <div class="col-sm-6"> 
                                            <input id="leavetype" type="text"  class="form-control" autocomplete="off" name="new_head"required>
                                             </div> 
                                             </div> 
                                             <div class="form-group"> 
                                             <label for="inputPassword3" class="col-sm-3 control-label">New To :</label> 
                                             <div class="col-sm-6"> 
                                            

                                                <select  name="newsto" autocomplete="off"  class="form-control">                                          
                                                <option value="All Faculty">All Faculty</option>
                                                
                                                </select>
                                             </div> 
                                             </div>

                                             <div class="form-group"> 
                                            <label for="inputEmail3" class="col-sm-3 control-label">Description</label> 
                                            <div class="col-sm-6"> 
                                            <textarea id="textarea1" name="description" class="form-control" name="description" length="600"></textarea>
                                             </div> 
                                             </div> 
                                             

                                             <div class="col-sm-offset-2">
                                              <button type="submit" name="add" class="btn btn-primary" style="float: right; margin-right: 80px; height: 50px; width: 120px; margin-top: ">Post New</button> 
                                              
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
