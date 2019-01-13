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
                    <h2 class="page-header" style="font-style: italic;color: black">Staff Record</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
            <?php 

                $eid=$_GET['id'];
// echo "<script>alert('$eid')</script>";
                $sql = "SELECT * from  instructor_tb where id= '$eid'";

                $query = mysqli_query($con, $sql);
                $cnt=1;

                if(mysqli_num_rows($query)<1)
                {
                header('location:manageinstructor.php');
                }
                else{
                    if (!$sql) {
                        header('location:manageinstructor.php');
                    }
                $result = mysqli_fetch_assoc($query)
              ?> 


                <div class="tab-content">
                    
                        
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <strong> <i class="fa fa-desktop">  </i> Instructor Record</strong>
                                <a href="manageinstructor.php"><strong style="float: right;"> <i class="fa fa-gear"> </i> Manage Instructor </strong> </a>
                            </div>
                            <div class="panel-body">
               <!--  <div class="col-md-2"></div> -->
                                <div class="col-md-6">
                                    <form>
                                    <div class="row">

                                    <table class="table table-hover">
                                        <tr>
                                            <th> FUll Name</th>
                                            <td class="upper"><?=$result['instructor_name']?></td>
                                        </tr>
                                        <tr>
                                            <th>Phone Number</th>
                                            <td class="upper"><?=$result['phoneNo'];?></td>
                                        </tr>
                                        <tr>
                                            <th>Username</th>
                                            <td class="upper"><?=$result['username'];?></td>
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
        
                            <label >Instructor Image :</label>
                            <div>
                               <img src="<?=$result['passport']?>" class="img img-thumbnail" width="210px;">
                            </div>

                            <form action="delete_instructor.php" method="get">
                                <input type="hidden" value="<?=$eid?>" name ="del" />
                                 <button class="btn btn-danger btn-lg" id="changepicture" onclick="return confirm('Do you want to delete');"  type="submit"> <i class="fa fa-trash"> </i> Delete Record</button>
                            </form>
                        </div>

                    </div>

                </div>

                    </div> <!--end of home-->
                

                
               
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


</body>

</html>
