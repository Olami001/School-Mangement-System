<?php


// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 002');
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
$txt = <<<EOD
Usmanu Danfodiyou University Sokoto. \n Departemnt of Mathematics \n COMPUTER SCIENCE UNIT \n SECOND SEMSETER EXAMINATION, 2017/2018 SESSION 
___________________________________________________________________________________
EOD;





// print a block of text using Write()
$pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);
//$pdf ->write(0,$html, '', 0, true, 0, false, false, 0);

$pdf -> cell(25,5,'Course Code: ',0,0);
$pdf -> cell(82,5,'CMP201',0,0);
$pdf -> cell(12,5,'Title:',0,0);
$pdf -> cell(35,2,'Introduction To COMPUTER SCIENCE',0,1);

// $pdf -> cell(130,5,'Time Allowed: ',0,0);
// $pdf -> cell(25,5,'TiTle:',0,0);
// $pdf -> cell(34,2,'ssssss',0,0);
$pdf -> cell(26,5,'Time Allowed: ',0,0);
$pdf -> cell(81,5,'2Hours',0,0);
$pdf -> cell(12,5,'Units:',0,0);
$pdf -> cell(35,2,'3',0,1);


$pdf -> cell(23,5,'Instruction: ',0,0);
$pdf -> cell(162,5,'Answer four (4) question only',0,1);


$pdf -> cell(25,5,'DO NOT WRITE ON THIS QUESTION PAPER',0,1);

$txt = <<<EOD
____________________________________________________________________________________
EOD;

$pdf->setFontSubsetting(true);

$pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);

// add a page
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->AddPage();




//Close and output PDF document
$pdf->Output('example_002.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
