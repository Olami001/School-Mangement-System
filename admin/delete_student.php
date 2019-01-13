<?php
session_start();
error_reporting(0);
include('includes/config.php');


$eid=$_GET['del'];
if (empty($eid) || $eid == '' || $eid == null) {
	header('location:managestudent.php');
}
else{
	$del = mysqli_query($con, "DELETE FROM student_tb where student_adm = '$eid'") or die(mysqli_error($con));
	if ($del) {
		$succ_msg = ' STUDENT RECORD DELETED SUCCESSFULLY';
		
                $_SESSION['suc_msg'] =   '<div class ="alert alert-success"><strong>'.$succ_msg.'</strong></div>';
		header('location:managestudent.php');
	}
	else{
			$succ_msgx = 'SORRY ERROR ENCOUNTED. RECORD NOT DELETED. PLEASE TRY AGAIN';
		
		$_SESSION['er_msg'] = '<div class ="alert alert-danger"><strong>'.$succ_msgx.'</strong></div>';

		header('location:managestudent.php');
	}

}

?>