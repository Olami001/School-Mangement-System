<?php
include('..\admin/includes/config.php');
session_start();
// if ($_SESSION['eid'] == '') {
//     header('location:../index.php');
// }

// code for action taken on leave
$lid=($_GET['id']);
if(isset($_POST['update']))
{ 
  $status = $_POST['status'];
  $description = $_POST['description'];
  $date = date('Y-m-d G:i:s');

  if (empty($status) || empty($description)) {
    echo "<script>alert('All field is required')</script>";
  }
  else{
    $update_query = mysqli_query($con, "UPDATE tblleaves set Status = '$status', AdminRemark = '$description', AdminRemarkDate = '$date' where id ='$lid'");
    if ($update_query) {
      $msg="Leave updated Successfully";
    }
    else
      echo "<script>alert('Error Encounter!!! contact Administrator')</script>";
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
                               Pending Leave Detail
                           </div>
                           <div class="panel-body">
                              
                              <table id="example" class="table table-striped">
                               
                                 
                                    <tbody>
                                    <?php 
                                    $lid=($_GET['id']);
                                    // echo "<script>alert('$lid')</script>";
                                    $sql = mysqli_query($con, "Select * from tblleaves where id = '$lid'");
                                    // if (mysqli_num_rows($sql) < 1) {
                                    //     echo "no record found for this user";
                                    // }
                                    // else{
                                    //     echo "Record found";
                                    // }

                                    $cnt=1;
                                    while ($result = mysqli_fetch_assoc($sql)) {
                                        $staff_id = $result['EmpID'];
                                              $name_query = mysqli_query($con, "Select * from employee_tb where EmpID = '$staff_id'");
                                              while ($rows = mysqli_fetch_assoc($name_query)) {
                                                // $sex_query = mysqli_query($con, "select * from personaldata_tb where Emp = '$lid'");
                                                // while ($rop = mysqli_fetch_assoc($sex_query)) {
                                                  # code...
                                                
                                            //   }
                                            // }        
                                          ?>  

                                        <tr>
                                            <td style="font-size:16px;"> <b>Employe Name :</b></td>
                                              <td>
                                                <?php echo $rows['First_Name'];?></a></td>
                                              <td style="font-size:16px;"><b>Staff Id :</b></td>
                                              <td><?php echo $staff_id;?></td>
                                              <td style="font-size:16px;"><b>Emp Contact No :</b></td>
                                            <td><?php echo $rows['PhoneNo'];?></td>
                                          </tr>

                                       

                                            <tr>
                                             <td style="font-size:16px;"><b>Leave Type :</b></td>
                                            <td><?php echo $result['LeaveType'];?></td>
                                             <td style="font-size:16px;"><b>Leave Date  :</b></td>
                                            <td>From <?php echo $result['FromDate'];?> to <?php echo $result['ToDate'];?></td>
                                            <td style="font-size:16px;"><b>Posting Date</b></td>
                                           <td><?php echo $result['Date_apply'];?></td>
                                        </tr>

                                        <tr>
                                             <td style="font-size:16px;"><b>Employe Leave Description : </b></td>
                                            <td colspan="5"><?php echo $result['Description'];?></td>
                                          
                                        </tr>

                                        <tr>
                                        <td style="font-size:16px;"><b>leave Status :</b></td>
                                        <td colspan="5"><?php $stats=$result['Status'];
                                        if($result['Status'] ==0){
                                        ?>
                                        <span style="color: orange">Pending</span>
                                         <?php } if($result['Status'] ==1)  { ?>
                                        <span style="color: blue">To Approval</span>
                                        <?php } if($result['Status'] ==2)  { ?>
                                         <span style="color: green">Approved</span>
                                         <?php }if($result['Status'] ==3)  { ?>
                                         <span style="color:Red">Reject</span>
                                         <?php } ?>
                                        </td>
                                        </tr>

                                        <tr>
                                        <td style="font-size:16px;"><b>Hod Remark: </b></td>
                                        <td colspan="5"><?php
                                        echo $result['hod_dean_remark'];
                                        ?></td>
                                         </tr>

                                         <tr>
                                        <td style="font-size:16px;"><b>Admin Action taken date : </b></td>
                                        <td colspan="5"><?php
                                        echo $result['hod_remark_date'];
                                        ?></td>
                                         </tr>
                                        <?php 
                                        if($result['Status']==1)
                                        {

                                        ?>
                                        <tr>
                                         <td colspan="5">
                                          <!-- <a  href="#modal1">
                                              <button class="btn btn-primary"></button>
                                          </a> -->
                                          <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#logoutModal">Take Action</button>
                                          
                                        <form name="adminaction" method="post">
                                        <!-- <div id="modal1" class="modal fade" id="myModal" role="dialog" style="height: 60%">
                                            <div class="modal-content" style="width:90%">
                                                <h4>Leave take action</h4>
                                                  <select class="browser-default" name="status" required="">
                                                                                    <option value="">Choose your option</option>
                                                                                    <option value="2">Approved</option>
                                                                                    <option value="3">Rejected</option>
                                                                                </select></p>
                                                                                <p><textarea id="textarea1" name="description" class="materialize-textarea" placeholder="Description" length="500" maxlength="500" required></textarea></p>
                                            </div>
                                            <div class="modal-footer" style="width:90%">
                                               <input type="submit" class="btn btn-success" name="update" value="Submit">
                                            </div>

                                        </div>  -->  

<?php } ?>
                                           </form>
                                         </td>
                                        </tr>
                                          


   <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="logout.php">Logout</a>
          </div>
        </div>
      </div>
    </div>

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

   

</body>

</html>

