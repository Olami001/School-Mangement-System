				<?php
							include('includes/functions.php'); 
							 global $con; $v = $con;
							$value=$_REQUEST['value'];
							
							$query="SELECT * FROM dept_tb WHERE faculty_id='$value'";
							$q2 = mysqli_query($v, $query);
							while($prdrow=mysqli_fetch_assoc($q2)){
							$tt=$prdrow['department'];
							//$id=$prdrow['pID'];
							$id=$prdrow['id'];
							echo"<option value='$id'>1</option>"
							echo "<option value='$id'>$tt</option>";
							}
					
							
							
							?>