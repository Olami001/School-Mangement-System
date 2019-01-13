<?php
include('..\admin/includes/config.php');
session_start();
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

    <title>view student</title>

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
    .upper{
        text-transform: uppercase;
        font-style: italic;
    }
    #changepicture{
        margin-top: 12px;
        margin-left: 22px;
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
            </ul>
            <!-- /.navbar-top-links -->

            <?php include 'includes/sidebar.php' ?>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">

                <div class="col-lg-12">
                    <h2 class="page-header" style="font-style: italic;color: black">Student Record</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
            <?php 

                $eid=$_GET['id'];
// echo "<script>alert('$eid')</script>";
                $sql = "SELECT * from  student_tb where student_adm= '$eid'";

                $query = mysqli_query($con, $sql);
                $cnt=1;

                if(mysqli_num_rows($query)<1)
                {
                header('location:managestudent.php');
                }
                else{
                    if (!$sql) {
                        header('location:managestudent.php');
                    }
                $result = mysqli_fetch_assoc($query)
              ?> 

              <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home">Personal Record</a></li>
                <li><a data-toggle="tab" href="#menu1">Acedemic Record</a></li>
                <li><a data-toggle="tab" href="#menu2">Fess Record</a></li>
                
              </ul>

                <div class="tab-content">
                    <h6></h6>
                    <div id="home" class="tab-pane fade in active">
                        
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <strong> <i class="fa fa-desktop">  </i> View student Record</strong>
                                <a href="managestudent.php"><strong style="float: right;"> <i class="fa fa-gear"> </i> Manage Student </strong> </a>
                            </div>
                            <div class="panel-body">
               <!--  <div class="col-md-2"></div> -->
                                <div class="col-md-6">
                                    <form>
                                    <div class="row">

                                    <table class="table table-hover">
                                        <tr>
                                            <th> First Name</th>
                                            <td class="upper"><?=$result['fname']?></td>
                                        </tr>
                                        <tr>
                                            <th>Other Name</th>
                                            <td class="upper"><?=$result['lname']. " ".$result['mname'];?></td>
                                        </tr>
                                        <tr>
                                            <th>Phone Number</th>
                                            <td class="upper"><?=$result['phone_no'];?></td>
                                        </tr>
                                        <tr>
                                            <th>Date of birth</th>
                                            <td class="upper"><?=$result['dob'];?></td>
                                        </tr>
                                        <tr>
                                            <th>Sate of origin</th>
                                            <td class="upper"><?=$result['state'];?></td>
                                        </tr>

                                        <tr>
                                            <th>Local Government</th>
                                            <td class="upper"><?=$result['lga'];?></td>
                                        </tr>

                                        <tr>
                                            <th>Parent Number</th>
                                            <td class="upper"><?=$result['parent_no'];?></td>
                                        </tr>

                                        <tr>
                                            <th>Nationality</th>
                                            <td class="upper"><?=$result['nationality'];?></td>
                                        </tr>

                                        <tr>
                                            <th>Address</th>
                                            <td class="upper"><?=$result['address'];?></td>
                                        </tr>

                                        <tr>
                                            <th>Admitted date</th>
                                            <td class="upper"><?=$result['date_create'];?></td>
                                        </tr>
                                        
                                    </table>
        
                                </div>
                            </form>

                        </div>
 
                    <div class="col-md-6">
                    
                        <div class="col-md-12">
        
                            <label >Student Image :</label>
                            <div>
                               <img src="<?=$result['passport']?>" class="img img-thumbnail" width="210px;">
                            </div>

                            <form action="delete_student.php" method="get">
                                <input type="hidden" value="<?=$eid?>" name ="del" />
                                 <button class="btn btn-danger btn-lg" id="changepicture" onclick="return confirm('Do you want to delete');"  type="submit"> <i class="fa fa-trash"> </i> Delete Record</button>
                            </form>
                        </div>

                    </div>

                </div>

                    </div> <!--end of home-->
                </div>

                <div id="menu1" class="tab-pane fade">
      <h3>Acedemic Record</h3>
      <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    </div>
    <div id="menu2" class="tab-pane fade">
      <h3>Fess Record</h3>
      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
    </div>
               
            </div> <?php }?>
        
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
