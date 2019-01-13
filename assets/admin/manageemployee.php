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
                    <h2 class="page-header" style="font-style: italic;color: black">Manage employee</h2>
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
                       <div class="panel panel-success">
                           <div class="panel-heading">
                               Employees Info
                           </div>
                           <div class="panel-body">
                                 
                                <table id="example" class="table table-striped " >
                                    <thead>
                                        <tr>
                                            <th>S/No</th>
                                            <th>Emp Id</th>
                                            <th>Full Name</th>
                                            <th>Department</th>
                                             <th>Status</th>
                                             <th>Appoinment Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                 
                                    <tbody>
<?php $sql = "SELECT * from  employee_tb";
$query = mysqli_query($con,$sql);

if (mysqli_num_rows($query)> 0) {
    # code...
    $cnt=1;
    while ($row = mysqli_fetch_assoc($query)) {
        # code...
    
// $query = $dbh -> prepare($sql);
// $query->execute();
// $results=$query->fetchAll(PDO::FETCH_OBJ);
// 
// if($query->rowCount() > 0)
// {
// foreach($results as $result)
// {               ?>  
                                        <tr>
                                            <td> <?=$cnt;?></td>
                                            <td><?= $row['EmpID']?></td>
                                            <td><?= $row['First_Name']?>&nbsp;<?= $row['Middle_Name']?>&nbsp; <?= $row['Last_Name']?></td>
                                            <td><?= $row['Department']?></td>
                                             <td><?php $stats=$row['status'];
if($stats){
                                             ?>
                                                 <a class="btn btn-success btn-xs">Active</a>
                                                 <?php } elseif($stats == 1) { ?>
                                                 <a class="btn btn-success btn-xs">Active</a>
                                                 <?php }
                                                 else{ 
                                                 echo '<a class="btn btn-danger btn-xs">Inactive</a>';
                                                 }?>

                                             </td>
                                              <td><?= $row['CreationDate']?></td>
                                           
                                            <td>
<a href="assignemployee.php?EmpID=<?php echo htmlentities($row['EmpID']);?>"  title="Assign" value = ''><i class="fa fa-plus"></i></a>&nbsp;&nbsp;
<a href="view_employee.php ?EmpID=<?php echo htmlentities($row['EmpID']);?>"  title="View Full Details"><i class="fa fa-desktop"></i></a>&nbsp;&nbsp;
<a href="editemployee.php?EmpID=<?php echo htmlentities($row['EmpID']);?>"  title="Edit staff"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
<a href="delete.php?del=<?php echo $row['EmpID'];?>" title="Delete Record" onclick="return confirm('Do you want to delete');"><i class="fa fa-close"></i></a></td>
                                        </tr>
                                         <?php $cnt++;} }?>
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
<?php 
unset($_SESSION['success_msg']);
unset($_SESSION['suc_msg']);
unset($_SESSION['er_msg']);
 ?>
