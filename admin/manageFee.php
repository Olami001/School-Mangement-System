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
    else
    {
        //check if it exit before
        $check = mysqli_query($con, "select * from fee_type_tb where fee_name = '$fee_name_trim'");
        if (mysqli_num_rows($check)>0) 
        {
            $message = 'oooh Snap!!!  Fee Type Already exist ';
            $msg = '<div class="alert alert-danger alert-dismissible" id="myAlert"><strong><a href="#" class="close">&times;</a>'. $message.'</strong></div>';
        }
        else
        {
            $sql = mysqli_query($con, "INSERT INTO fee_type_tb(fee_name,collection,description) VALUES('$fee_name_trim','$collection_trim','$description_trim')");
            if ($sql) 
            {
                $fetch_back = mysqli_query($con, "select * from fee_type_tb where fee_name = '$fee_name_trim'");
                $fetch_array = mysqli_fetch_assoc($fetch_back);
                $fee_id = $fetch_array['id'];
                $fee_detail = mysqli_query($con, "INSERT INTO fee_details_tb(fee_type,fee_id) VALUES('$fee_name_trim','$fee_id')") or die(mysqli_error($con));
                if($fee_detail){
                    $message = 'New Fee Type added Successfully';
                $msg = '<div class="alert alert-success alert-dismissible" id="myAlert"> <a href="#" class="close">&times;</a> <strong>'. $message.'</strong></div>';
                }
                else{
                    $message = 'error occur';
                $msg = '<div class="alert alert-danger alert-dismissible" id="myAlert"> <a href="#" class="close">&times;</a> <strong>'. $message.'</strong></div>';
                }
                
            }
            else
            {
                $message = 'Sorry Fee Type Not Added!!! Please Try again';
                $msg = '<div class="alert alert-danger alert-dismissible" id="myAlert"><strong> <a href="#" class="close">&times;</a>'. $message.'</strong></div>';
            }
        }
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
                    <h2 class="page-header" style="font-style: italic;color: black">Fee Management</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">


              <ul class="nav nav-tabs ">
                <li class="active"><a data-toggle="tab" href="#home">Fee Type</a></li>
                <li><a data-toggle="tab" href="#menu1">Fee Details</a></li>
                
              </ul>

                <div class="tab-content my-tab">
                    <h6></h6>
                    <?php echo $msg?>
                    <div id="home" class="tab-pane fade in active">
                        <div class="row" style="margin-bottom: 20px; ">
                            <div class="col-md-5 col-md-offset-1">
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label>Fee Name <span class="required">*</span></label>
                                        <div class="input-group">             
                                        <span class="input-group-addon">
                                        <i class="fa fa-lock" aria-hidden="true"></i>
                                        </span>
                                        <input type="text" class="form-control" name="fee_name" required>

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label >Fee Collection <span class="required">*</span></label>
                                        <div class="input-group">             
                                          <span class="input-group-addon">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                        </span>
                                        <select name="collection" class="form-control" required="">
                                            <option value="">Select Collection Type</option>
                                            <option value="Days">Days</option>  
                                            <option value="Weekly">Weekly</option>
                                            <option value="Monthly">Monthly</option>    
                                        </select>
                                            
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label >Fee Description <span class="required">*</span></label>
                                        <div class="input-group">             
                                          <span class="input-group-addon">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                        </span>
                                            <textarea name="description" class="form-control" required></textarea>
                                            
                                        </div>
                                    </div>

                                    <button type="submit" name="add" class="btn btn-primary btn-lg" style="float: right; width: 130px;">Save</button>
                                </form>
                            </div>
                            
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-info">
                                    <div class="panel-heading"> <i class="fa fa-calendar"> </i> <strong>Available Fee Type </strong> </div>
                                    <div class="panel-body">
                                   
                                        <table id="example" class="table table-striped " >                                    
                                            <thead>
                                                <tr>
                                                    <th>S/No</th>
                                                    <th>Fee Name</th>
                                                    <th>Fee Collection</th>
                                                    <th>Fee Description</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>                                 
                                            <tbody>
                                             <?php
                                                $select = mysqli_query($con, "select * from fee_type_tb");
                                                $count = 1;
                                                while($rows = mysqli_fetch_assoc($select))
                                                {
                                            ?>
                                                <tr id="row<?php echo $rows['id'];?>">
                                                    <td><?=$count;?></td>
                                                    <td id="name_val<?php echo $rows['id'];?>"><?=$rows['fee_name']?></td>
                                                    <td id="collection<?php echo $rows['id'];?>"><?=$rows['collection']?></td>
                                                    <td id="description<?php echo $rows['id'];?>"><?=$rows['description']?></td>
                                                    <td>
                                                        <input type='button' class="btn btn-success btn-sm" id="edit_button<?php echo $rows['id'];?>" value="edit" onclick="edit_row('<?php echo $rows['id'];?>');">
   <input type='button' class="btn btn-primary btn-sm save" id="save_button<?php echo $rows['id'];?>" value="save" onclick="save_row('<?php echo $rows['id'];?>');">
   <input type='button' class="btn btn-danger btn-sm" id="delete_button<?php echo $rows['id'];?>" value="delete" onclick="delete_row('<?php echo $rows['id'];?>');">
 
                                                    </td>
                                                </tr>
                                                
                                                <?php 
                                                $count++;
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>  <!--panel body-->
                                </div>
                                    
                            </div>
                            
                        </div>
                        
                    </div>

                <div id="menu1" class="tab-pane fade">
                    <h6></h6>
                    <div class="panel panel-info">
                        <div class="panel-heading"><strong>Available Fess Details</strong></div>
                        <div class="panel-body">
                        <table id="example" class="table table-bordered">  
                                        <tr>
                                            <th>S/N</th>
                                            <th>Fee Type</th>
                                            <th>Amount</th>
                                            <th>Period</th>
                                            <th>Action</th>
                                        </tr>
                            <?php
                                $query = mysqli_query($con, "select * from fee_type_tb");
                                if (mysqli_num_rows($query)>0) {
                                    $int =1;
                                    while ($fetch = mysqli_fetch_assoc($query)) {
                                        $feeName = $fetch['fee_name'];
                                        
                                        $select_payment = mysqli_query($con, "select * from fee_details_tb where fee_type = '$feeName'");
                                        
                                         $data = mysqli_fetch_assoc($select_payment);
                            ?>
                                            
                                <tr id="second_row<?php echo $data['fee_id'];?>">
                                    <td><?=$int;?></td>
                                    <td><?=$feeName?></td>
                                    <td id="amount<?php echo $data['id'];?>"><?=$data['amount']?></td>
                                    <td id="period<?php echo $data['id'];?>"><?=$data['period']?></td>
                                    <td>
                                        <input type='button' class="btn btn-success btn-sm" id="edit_button<?php echo $data['id'];?>" value="edit" onclick="edit_row2('<?php echo $data['id'];?>');">
                                         <input type='button' class="btn btn-primary btn-sm save" id="save_button<?php echo $data['id'];?>" value="save" onclick="save_row2('<?php echo $data['id'];?>');">
                                    </td>

                                </tr>
                                    
                           <?php
                            $int++;}
                                }
                                else{
                                    echo "No Record Available";
                                }
                            ?>
                        </table>
                        </div>
                        
                    </div>
                </div>
                <div id="menu2" class="tab-pane fade">
                  <h3>Fess Record</h3>
                  <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
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

        function edit_row(id)
{
 var name=document.getElementById("name_val"+id).innerHTML;
 var collection=document.getElementById("collection"+id).innerHTML;
  var description=document.getElementById("description"+id).innerHTML;

 document.getElementById("name_val"+id).innerHTML="<input type='text' id='name_text"+id+"' value='"+name+"'>";
 document.getElementById("collection"+id).innerHTML="<input type='text' id='collection_text"+id+"' value='"+collection+"'>";
 document.getElementById("description"+id).innerHTML="<input type='text' id='description_text"+id+"' value='"+description+"'>";
    
 document.getElementById("edit_button"+id).style.display="none";
 document.getElementById("save_button"+id).style.display="block";
}

function save_row(id)
{
 var name=document.getElementById("name_text"+id).value;
 var collection=document.getElementById("collection_text"+id).value;
 var description=document.getElementById("description_text"+id).value;
    
 $.ajax
 ({
  type:'post',
  url:'modify_records.php',
  data:{
   edit_row:'edit_row',
   row_id:id,
   name_val:name,
   collection:collection,
   description:description
  },
  success:function(response) {
   if(response=="success")
   {
    document.getElementById("name_val"+id).innerHTML=name;
    document.getElementById("collection"+id).innerHTML=collection;
    document.getElementById("description"+id).innerHTML=description;
    document.getElementById("edit_button"+id).style.display="block";
    document.getElementById("save_button"+id).style.display="none";
    alert('Record Updated Successfully');
   }
  }

 });
}

function delete_row(id)
{
    // confirming delete
    if (confirm("Are You Sure you want to delete?") == true)
    {

     $.ajax
     ({
      type:'post',
      url:'modify_records.php',
      data:{
       delete_row:'delete_row',
       row_id:id,
      },
      success:function(response) {
       if(response=="success")
       {
        var row=document.getElementById("row"+id);
        row.parentNode.removeChild(row);
        alert('Record Deleted Successfully');
        var row2 = document.getElementById("second_row"+id);
        row2.parentNode.removeChild(row2);
       }
      }
     });

    }//end of confirm
    else{

    }
}

// edit for second tab
 function edit_row2(id)
{
 var amount=document.getElementById("amount"+id).innerHTML;
 var period=document.getElementById("period"+id).innerHTML;

 document.getElementById("amount"+id).innerHTML="<input type='text' id='amount_text"+id+"' value='"+amount+"'>";
 document.getElementById("period"+id).innerHTML="<input type='text' id='period_text"+id+"' value='"+period+"'>";
    
 document.getElementById("edit_button"+id).style.display="none";
 document.getElementById("save_button"+id).style.display="block";
}

// save for second tab
function save_row2(id)
{
 var amount=document.getElementById("amount_text"+id).value;
 var period=document.getElementById("period_text"+id).value;
    
 $.ajax
 ({
  type:'post',
  url:'modify_records.php',
  data:{
   edit_row2:'edit_row2',
   row_id:id,
   amount:amount,
   period:period
  },
  success:function(response) {
   if(response=="success")
   {
    document.getElementById("amount"+id).innerHTML=amount;
    document.getElementById("period"+id).innerHTML=period;
    document.getElementById("edit_button"+id).style.display="block";
    document.getElementById("save_button"+id).style.display="none";
    alert('Record Updated Successfully');
   }
  }

 });
}
    </script>

</body>

</html>
