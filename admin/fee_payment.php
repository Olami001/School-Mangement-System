<?php
include('..\admin/includes/config.php');
session_start();
if (empty($_SESSION['user']) || $_SESSION['user'] == '') {
    header('location:../index.php');
}
$message = $msg ='';
if (isset($_POST['add'])) {
    $fee_name = ucwords($_POST['fee_name']);
    $collection = ucwords($_POST['collection']);
    $description = $_POST['description'];
    // Trim function on fee name and collection
    $fee_name_trim = trim($fee_name);
    $collection_trim = trim($collection);
    $description_trim = trim($description);
    if (empty($fee_name) || empty($collection) | empty($description)) 
    {
        echo "<script>alert('All Field Must be fill')</script>";
    }
   
}

$query = mysqli_query($con, "select * from student_tb");
$sql = mysqli_query($con, "select * from fee_type_tb");

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
    .my-tab{
        border:1px solid #ccc;
        border-radius: 3px;
    }
    .save{
        display: none;
    }
    .close{
        color: white;
    }
</style>

<script type="text/javascript">
    function checkAvailabilityfeeType() {
$("#loaderIcon").show();
jQuery.ajax({
url: "check_availability.php",
data:'fee_type='+$("#fee_type").val(),
type: "POST",
success:function(data){
    document.getElementById("phoneid-availability").innerHTML=data;
$("#phoneid-availability").innerHTML(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>

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
                    <h2 class="page-header" style="font-style: italic;color: black">Fee Payment</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="panel panel-info">
                    <div class="panel-heading">
                                <strong> <i class="fa fa-newspaper-o"> </i> Student Payment</strong>
                               <a href="addstudent.php"><strong style="float: right;"> <i class="fa fa-gear"> </i> Manage Student Fee </strong> </a></div>
                    <div class="panel-body">
                       <div class="col-md-5 col-md-offset-1">
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label>Student Name <span class="required">*</span></label>
                                        <div class="input-group">             
                                        <span class="input-group-addon">
                                        <i class="fa fa-lock" aria-hidden="true"></i>
                                        </span>
                                        <!-- <input type="text" class="form-control" name="student_name" required> -->
                                        <select name="studen_name" class="form-control" required>
                                            <option value=""></option>
                                           <?php while ($row = mysqli_fetch_assoc($query)) { ?>
                                                <option ><?= $row['fname']. " ". $row['lname']. " ". $row['mname']; ?></option>
                                            <?php } ?>
                                 
                                            
                                        </select>

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label >Fee Type <span class="required">*</span></label>
                                        <div class="input-group">             
                                          <span class="input-group-addon">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                        </span>
                                        <select name="fee_type" class="form-control" id="fee_type" required="" onBlur="checkAvailabilityfeeType()">
                                            <option value="">Select Fee Type</option>
                                            <?php while ($srow = mysqli_fetch_assoc($sql)) { ?>
                                                <option ><?= $srow['fee_name']; ?></option>
                                            <?php } ?>    
                                        </select>
                                            
                                        </div>
                                        <!-- <span id="phoneid-availability" style="font-size:12px;"></span>  -->
                                    </div>

                                    <div class="form-group">
                                        <label >Amount <span class="required">*</span></label>
                                        <div class="input-group">             
                                          <span class="input-group-addon">
                                        <i class="fa fa-money" aria-hidden="true"></i>
                                        </span>
                                            <input type="text" class="form-control" id="phoneid-availability" name="student_name" required>
    
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label >Period <span class="required">*</span></label>
                                        <div class="input-group">             
                                          <span class="input-group-addon">
                                        <i class="fa fa-paperclip" aria-hidden="true"></i>
                                        </span>
                                        <select name="period" required class="form-control">
                                            <option value=""> select week period</option>
                                            <option> Week I</option>
                                            <option> Week II</option>
                                            <option> Week III</option>
                                            <option> Week IV</option>
                                        </select>

                                            
                                        </div>
                                    </div>

                                    <button type="submit" name="add" class="btn btn-primary btn-lg" style="float: right; width: 130px;">Save</button>
                                </form>
                            </div> 
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
    // close alert script
    $(document).ready(function(){
    $(".close").click(function(){
        $("#myAlert").alert("close");
    });
});

    function cal(){
  //   var result = document.getElementById('tprice');
  //  var el = document.getElementById('qnty');
  //  var pri = document.getElementById('price');
  // el.value = el.value * pri.value;
  // var total =0;
  // total = total + Number(el.value);
  // result.value = total;
  }

    }
    </script>

</body>

</html>
