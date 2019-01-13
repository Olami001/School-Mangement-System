<?php
include('..\admin/includes/config.php');
session_start();
// if ($_SESSION['eid'] == '') {
//     header('location:../index.php');
// }

$succ_msg = ''; $err_msg =''; $msg = '';
$state_all = mysqli_query($con, "select DISTINCT Faculty from faculty_dept_tb where 1");
$lga_all = mysqli_query($con, "select * from faculty_dept_tb");
$query = mysqli_query($con, "select * from leavetype_tb");

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
                    <h2 class="page-header" style="font-style: italic;color: black">View All Leave</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
            <?php echo $msg; ?>
               <div class="panel panel-success">
                <div class="panel-heading">
                    <h4> <strong>Generate Report on Leaves </strong></h4>
                </div>
                <div class="panel-body">
                <div class="col-md-2">
                    <input type="checkbox" value="" id="dept_check" onclick="reload()"  style="height: 20px; width: 40px; float: right; margin-top: 180px; margin-right: -30px;">
                </div>
                    <div class="col-md-6">
                    <form method="post" action="" name="addemp">
                       
                         <div class="form-group">
                                    
              <label class="control-label">  Leave Type</label>
              <div class="input-group" id="state_fm_g">             
                  <span class="input-group-addon">
              <i class="fa fa-stumbleupon" aria-hidden="true"></i>
              </span>
              <select class="form-control" name="leave_select" required>
                            <option>Select Leave Type</option>
                            <?php while($lrow= mysqli_fetch_assoc($query)) { ?>
                                                <option value="<?= $lrow['LeaveType']?>"><?=$lrow['LeaveType']?></option>
                                            <?php } ?>
                                
                            </select>
              </div>
            </div>
                            <!--  -->
                            <div class="form-group">
                                    
              <label class="control-label"> Faculty/Collage </label>
              <div class="input-group" id="state_fm_g">             
                  <span class="input-group-addon">
              <i class="fa fa-stumbleupon" aria-hidden="true"></i>
              </span>
              <select name="fact" class="form-control" id="state_select">
                                            <option>Select Faculty/Collage</option>
                                           <?php while ($srow = mysqli_fetch_assoc($state_all)) { ?>
                                                <option value="<?= $srow['Faculty'] ?>"><?= $srow['Faculty'] ?></option>
                                            <?php } ?>
                                 
                                            
                                        </select>
              </div>
            </div>

            
            <div class="form-group">

              <label class="control-label">Department/Unit: </label>

              <div class="input-group"  id="lga_fm_g">   

                  <span class="input-group-addon">
              <i class="fa fa-stumbleupon-circle" aria-hidden="true"></i>
              </span>

              <select name="deppt" class="form-control" id="lga_select" disabled="">
                                            <option value="">Select Department/Unit</option>
                                            <?php while ($srow = mysqli_fetch_assoc($lga_all)) { ?>
                                                <option value="<?= $srow['Department'] ?>"
                                                        dir="<?= $srow['Faculty'] ?>"><?=  $srow['Department'] ?></option>
                                            <?php } ?>
                                            
                                        </select>
              </div>
              </div>
            
                            
                           
                            
                            <button type="submit" class="btn btn-success" name="view_btn"> <i class="fa fa-arrow-down"> </i> View Leave</button>
                    </form>
                    </div>
                    <!--  -->
                        <div class="col-md-12">
                            <table id="example" class="table table-striped " >
                                    <thead>
                                        <tr>
                                            <th>S/No</th>
                                            <th>Leave Type</th>
                                            <th>Description</th>
                                            <th>Creation Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                                                     <?php
    if (isset($_POST['view_btn'])) {
        $leave_select = $_POST['leave_select'];
        $faculty = $_POST['fact'];
        $deppt = $_POST['deppt'];
        $_SESSION['leave_select'] = $leave_select;
        $get = $_SESSION['leave_select'];

        if (!empty($faculty) ) {
            $queryy = mysqli_query($con, "select * from tblleaves where LeaveType = '$get' and Status = 2 and faculty = '$faculty' ") or die(mysqli_error($con));
            $_SESSION['facc_name'] = $faculty;
            $_SESSION['dept_name'] = '';
        }
        elseif (!empty($deppt) ) {
           $queryy = mysqli_query($con, "select * from tblleaves where LeaveType = '$get' and Status = 2 and faculty = '$faculty' and department = '$deppt' ") or die(mysqli_error($con));
           $_SESSION['facc_name'] = $faculty;
           $_SESSION['dept_name'] = $deppt;
        }
        else{
           $queryy = mysqli_query($con, "select * from tblleaves where LeaveType = '$get' and Status = 2 ") or die(mysqli_error($con)); 
            $_SESSION['facc_name'] = '';
           $_SESSION['dept_name'] = '';
        }
        
        //echo "<script></script>";
        if (mysqli_num_rows($queryy) > 0) {
          //
          $counter = 1;
          while ($rox = mysqli_fetch_assoc($queryy)) { ?>
              <tr>
                  <td><?=$counter?></td>
                  <td><?=$rox['EmpID']?></td>
                  <td><?=$rox['LeaveType']?></td>
                  <td><?=$rox['FromDate']?></td>
                  <td><?=$rox['ToDate']?></td>
                  <td><?php 
                  //echo ($rox['FromDate']) - ($rox['ToDate']) 
                  $date1 = strtotime($rox['FromDate']);
                    $date2 =  strtotime($rox['ToDate']);
                    $answer = $date2 - $date1;
                    $sc = $answer/86400;
                    if (date('Y-m-d') > $rox['ToDate']) {
                        echo '<strong style="color:red">Leave Expired</strong>';
                    }
                    else{
                        echo '<strong style="color:green">'.$sc.' Days To Go</strong>';
                        //echo $sc;
                    }
                  ?></td>
                  <td><?=$rox['AdminRemark']?></td>
                  <td><?=$rox['AdminRemarkDate']?></td>
                  <td> <a href=""> <i class="fa fa-print"></i> </a></td>
              </tr>
         <?php $counter++;}
        }
    }
        
    
      ?>   


                                    </tbody>
                                    </table>
                                    <a href="print_record.php"> <button class="btn btn-primary btn-lg" style="float: right; margin-right: 20px; height: 40px; margin-top: 30px;">
                                    <i class="fa fa-print"> Print Record</i>
                                
                            </button></a>
                        </div>
                    <!--  -->
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

 <script type="text/javascript">
        function reload(){
            if (document.getElementById('dept_check').checked) {
                document.getElementById('lga_select').disabled = false;
            }
        }
    </script>

</body>

</html>
