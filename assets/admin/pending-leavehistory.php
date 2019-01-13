<?php
include('..\admin/includes/config.php');
session_start();
// if ($_SESSION['eid'] == '') {
//     header('location:../index.php');
// }

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
    <link href="../vendor/datatables/css/dataTables.bootstrap.css" rel="stylesheet" type="text/css">
    <!-- <link href="../assets/plugins/datatables/css/jquery.dataTables.min.css" rel="stylesheet"> -->

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
                    <h2 class="page-header" style="font-style: italic;color: black">Leave History</h2>
                </div>

                <!-- /.col-lg-12 -->
            </div>
            <div>
               
            </div>
            <!-- /.row -->
            <div class="row">
           
               
                 <div class="col-md-12">
                       <div class="panel panel-success">
                           <div class="panel-heading">
                               Pending Leave History
                           </div>
                           <div class="panel-body">
                                 
                                <table id="example" class="table table-striped " >
                                    <thead>
                                        <tr>
                                            <th>S/No</th>
                                            <th>Employe Name</th>
                                            <th >Leave Type</th>

                                             <th >Posting Date</th>                 
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                 
                                    <tbody>
<?php $cnt = 1;
$sql = mysqli_query($con, "select * from tblleaves where  Status = 0 or Status = 1");
while ($result = mysqli_fetch_assoc($sql)) {
    # code...
              ?>  
                                        <tr>
                                            <td> <b><?php echo htmlentities($cnt);?></b></td>
                                              <td><?php echo $result['EmpID'];?></a></td>
                                            <td><?php echo $result['LeaveType'];?></td>
                                            <td><?php echo $result['Date_apply'];?></td>
                                                                       <td><?php 
if($result['Status']==0){
                                             ?>
                                                 <span style="color: orange">pending</span>
                                                 <?php
                                                    }
                                                    if($result['Status']==1){
                                                 ?>
                                                    <span style="color: blue">To Approval</span>
                                                    <?php  }?>
                                             </td>

          
           <td ><a href="leave_details.php?id=<?php echo $result['id'];?>" title="Approval"><i class="fa fa-desktop"></i></a></td>
                                        </tr>
                                         <?php $cnt++; }?>
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

