<?php

// Include the main TCPDF library (search for installation path).
include("tcpdf/tcpdf.php");
include('includes/config.php');
session_start();
	


// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('Leave Record');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(TRUE);
//$pdf->setFooter('{PAGENO}');
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_RIGHT);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}


// set font
$pdf->SetFont('freeserif', '', 12);
// set font
//$pdf->SetFont('times', 'BI', 20);
//$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// add a page
$pdf->AddPage();

// set some text to print
$pdf->Image('logo2.jpg',21,20,27);
$faculty = strtoupper($_SESSION['facc_name']);
$dept = strtoupper($_SESSION['dept_name']);
$pdf->Write(0, $dept, '', 0, 'C', true, 0, false, false, 0);
$txt = <<<EOD
\n USMANU DANFODIYO UNIVERSITY SOKOTO. \n FACULTY OF $faculty  \n  DEPARTMENT OF Mathematics \n\n
EOD;

// if (($_SESSION['dept_name']) != '' ) {
// 	$txtd = <<<EOD
// \n DEPARTMENT OF $dept \n\n
// EOD;
// }
$txtx = <<<EOD
\n  \n    STAFF RECORD ON STUDY LEAVE \n\n
EOD;

$pdf->setFontSubsetting(true);

$pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);
// $pdf->Write(0, $txtd, '', 0, 'C', true, 0, false, false, 0);
$pdf->Write(0, $txtx, '', 0, 'C', true, 0, false, false, 0);

	include('includes/config.php');

$get = $_SESSION['leave_select'];
if (empty($_SESSION['leave_select'])) {
	$pdf->Write(0, 'Session emty', '', 0, 'C', true, 0, false, false, 0);
}
        $queryy = mysqli_query($con, "select * from tblleaves where LeaveType = '$get' and Status = 2 ");
        if ($queryy) {
        	$txtx = '1';
        	//$pdf->Write(0, $txtx, '', 0, 'C', true, 0, false, false, 0);
        }
        

        $cnt = mysqli_num_rows($queryy);
        //$pdf->Write(0, $cnt, '', 0, 'C', true, 0, false, false, 0);
        
        //$rows = mysqli_fetch_assoc($queryy);

        while ($rox = mysqli_fetch_assoc($queryy)) {
        	$get_stafid = $rox['EmpID'];
        	$name_query = mysqli_query($con, "select * from employee_tb where EmpID = '$get_stafid'") or die(mysqli_error($con));
        	$fetch_name = mysqli_fetch_assoc($name_query);
        	
        	$date1 = strtotime($rox['FromDate']);
                    $date2 =  strtotime($rox['ToDate']);
                    $answer = $date2 - $date1;
                    $sc = $answer/86400;

// print a block of text using Write()
$width_cell = array(20,10,10,10,10);
$pdf->Cell( 21, 7, 'STAFF ID', 1, 0,' L');
$pdf->Cell( 67, 7, 'STAFF NAME', 1, 0,' L');
$pdf->Cell( 64, 7, 'DEPARTMENT', 1, 0,' L');

$pdf->Cell( 40, 7, 'DAYS REMAINING', 1, 1,' L');
 //$pdf->Cell(30,10,'Title',1,0,'C',1);

   
    $pdf->Cell( 21, 7, $rox['EmpID'], 1, 0,' L');
    $pdf->Cell( 67, 7, $fetch_name['First_Name']." ".$fetch_name['Last_Name']. " ". $fetch_name['Middle_Name'], 1, 0,' L');
    $pdf->Cell( 64, 7, $fetch_name['Department'], 1, 0,' L');
    $pdf->Cell( 40, 7, $sc, 1, 1,' L');
}
$pdf->Output();






//$txt .=fetch();

// 
$pdf->setFontSubsetting(false);

//$pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);

// add a page
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
//$pdf->AddPage();



//
// $CreationDate = date('Y-m-d G:i:s');
// $dte = date('d');
// $filename= $couCode.'.pdf'; 
//  $filelocation = "C:\\xampp\htdocs\\qpgs\questionpaper";  

//  $fileNL = $filelocation."\\".$filename;
 //$pdf->printt();
 $pdf->Output('','I');

//============================================================+
// END OF FILE
//============================================================+

?>

<?php

?>		