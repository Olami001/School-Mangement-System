<?php
include('..\admin/includes/config.php');
session_start(); error_reporting(0);
if (empty($_SESSION['user']) || $_SESSION['user'] == '') {
    header('location:../index.php');
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

    <title>Manage Instructor</title>

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
    <link href="../vendor/datatables/css/dataTables.bootstrap.css" rel="stylesheet" type="text/css">
    
    <!-- custom css -->
    <link rel="stylesheet" type="text/css" href="../assets/css/custom.css">

<style type="text/css">
    .img h4,h5,p{
        text-align: center; font-weight: bold;
    }
    #side-menu li a{
         color: rgb(51,122,183);
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
                    <h2 class="page-header" style="font-style: italic;color: black">Manage Instructor</h2>
                </div>

                <!-- /.col-lg-12 -->
            </div>
            <div>
               <?php
                if (isset($msg) and !empty($msg)) {
                  echo $msg;
                }
                if (isset($_SESSION['suc_msg']) and !empty($_SESSION['suc_msg'])) {
                  echo $_SESSION['suc_msg'];
                }
                if (isset($_SESSION['er_msg']) and !empty($_SESSION['er_msg'])) {
                  echo $_SESSION['er_msg'];
                }
                ?>
            </div>
            <!-- /.row -->
            <div class="row">
           
               
                 <div class="col-md-12">
                       <div class="panel panel-info">
                           <div class="panel-heading">
                               <strong> <i class="fa fa-group"> </i> Instructors Info</strong>
                               <a href="addinstructor.php"><strong style="float: right;"> <i class="fa fa-user-plus"> </i> Add New Instructor </strong> </a>
                           </div>
                           <div class="panel-body">
                                 
                                <table id="example" class="table table-striped " >
                                    <thead>
                                        <tr>
                                            <th>S/No</th>
                                            <th>Full Name</th>
                                            <th>Phone Number</th>
                                             <th>Usernamen</th>
                                             <th>Date Added</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                 
                                    <tbody>
<?php $sql = "SELECT * from  instructor_tb order by id desc";
$query = mysqli_query($con,$sql);

if (mysqli_num_rows($query)> 0) {
    # code...
    $cnt=1;
    while ($row = mysqli_fetch_assoc($query)) {

         ?>  
                                        <tr>
                                            <td> <?=$cnt;?></td>
                                            <td><?= $row['instructor_name']?></td>
                                            <td><?= $row['phoneNo']?></td>
                                            <td><?= $row['username']?></td>
                                              <td><?= $row['date_create']?></td>
                                           
                                            <td>

<a href="view_instructor.php ?id=<?php echo htmlentities($row['id']);?>"  title="View Full Details"><i class="fa fa-desktop"></i></a>&nbsp;&nbsp;
<a href="editinstructor.php?id=<?php echo htmlentities($row['id']);?>"  title="Edit staff"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
<a href="delete_instructor.php?del=<?php echo $row['id'];?>" title="Delete Record" onclick="return confirm('Do you want to delete');"><i class="fa fa-close"></i></a></td>
                                        </tr>
                                         <?php $cnt++;} }
                                         else{
                                            }?>
                                    </tbody>
                                </table>
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
    <script src="../assets/js/pages/table-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
<?php 
unset($_SESSION['success_msg']);
unset($_SESSION['suc_msg']);
unset($_SESSION['er_msg']);
 ?>
