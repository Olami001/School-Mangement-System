<?php
  include 'connection.php';
// $select = mysqli_query($con,"SELECT * FROM testing") or die(mysqli_error($con));
$fetch = mysqli_query($con, "select * from fee_type_tb");
?>

<html>
<head>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="modify_records.js"></script>
<script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>
</head>
<body>
<div id="wrapper">



<table align="center" cellpadding="10" border="1" id="user_table">
<tr>
<th>NAME</th>
<th>AGE</th>
<th></th>
</tr>
<?php
while ($row=mysqli_fetch_assoc($fetch)) 
{
 ?>
 <tr id="row<?php echo $row['id'];?>">
  <td id="name_val<?php echo $row['id'];?>"><?php echo $row['fee_name'];?></td>
  <td id="age_val<?php echo $row['id'];?>"><?php echo $row['collection'];?></td>
  <td>
   <input type='button' class="edit_button" id="edit_button<?php echo $row['id'];?>" value="edit" onclick="edit_row('<?php echo $row['id'];?>');">
   <input type='button' class="save_button" id="save_button<?php echo $row['id'];?>" value="save" onclick="save_row('<?php echo $row['id'];?>');">
   <input type='button' class="delete_button" id="delete_button<?php echo $row['id'];?>" value="delete" onclick="delete_row('<?php echo $row['id'];?>');">
  </td>
 </tr>
 <?php
}
?>

<tr id="new_row">
 <td><input type="text" id="new_name"></td>
 <td><input type="text" id="new_age"></td>
 <td><input type="button" value="Insert Row" onclick="insert_row();"></td>
</tr>
</table>

</div>

<script type="text/javascript">
	function edit_row(id)
{
 var name=document.getElementById("name_val"+id).innerHTML;
 var age=document.getElementById("age_val"+id).innerHTML;

 document.getElementById("name_val"+id).innerHTML="<input type='text' id='name_text"+id+"' value='"+name+"'>";
 document.getElementById("age_val"+id).innerHTML="<input type='text' id='age_text"+id+"' value='"+age+"'>";
	
 document.getElementById("edit_button"+id).style.display="none";
 document.getElementById("save_button"+id).style.display="block";
}

function save_row(id)
{
 var name=document.getElementById("name_text"+id).value;
 var age=document.getElementById("age_text"+id).value;
	
 $.ajax
 ({
  type:'post',
  url:'modify_records.php',
  data:{
   edit_row:'edit_row',
   row_id:id,
   name_val:name,
   age_val:age
  },
  success:function(response) {
   if(response=="success")
   {
    document.getElementById("name_val"+id).innerHTML=name;
    document.getElementById("age_val"+id).innerHTML=age;
    document.getElementById("edit_button"+id).style.display="block";
    document.getElementById("save_button"+id).style.display="none";
   }
  }
 });
}

function delete_row(id)
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
   }
  }
 });
}

function insert_row()
{
 var name=document.getElementById("new_name").value;
 var age=document.getElementById("new_age").value;

 $.ajax
 ({
  type:'post',
  url:'modify_records.php',
  data:{
   insert_row:'insert_row',
   name_val:name,
   age_val:age
  },
  success:function(response) {
   if(response!="")
   {
    var id=response;
    var table=document.getElementById("user_table");
    var table_len=(table.rows.length)-1;
    var row = table.insertRow(table_len).outerHTML="<tr id='row"+id+"'><td id='name_val"+id+"'>"+name+"</td><td id='age_val"+id+"'>"+age+"</td><td><input type='button' class='edit_button' id='edit_button"+id+"' value='edit' onclick='edit_row("+id+");'/><input type='button' class='save_button' id='save_button"+id+"' value='save' onclick='save_row("+id+");'/><input type='button' class='delete_button' id='delete_button"+id+"' value='delete' onclick='delete_row("+id+");'/></td></tr>";

    document.getElementById("new_name").value="";
    document.getElementById("new_age").value="";
   }
  }
 });
}
</script>
</body>
</html>