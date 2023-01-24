<?php
session_start();
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

/*$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'Hello World !');

$writer = new Xlsx($spreadsheet);
$writer->save('hello world.xlsx');*/



$errmsg_arr = array();
	$errflag = false;
	$alphabetical_letters_array=array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ','BA','BB','BC','BD','BE','BF','BG','BH','BI','BJ','BK','BL','BM','BN','BO','BP','BQ','BR','BS','BT','BU','BV','BW','BX','BY','BZ');
	
	$header_array=array("NAMES","GENDER","CATEGORY","CONTACT","CONTACT2","EMAIL");

////////////////////////////////////////STARTS PHPExcel//////////////////////////////////////////////
////////////////////////////////////////STARTS PHPExcel//////////////////////////////////////////////
////////////////////////////////////////STARTS PHPExcel//////////////////////////////////////////////
//xlsx=vnd.openxmlformats-officedocuments.spreadsheetml.sheet///xls=/vnd.ms-excel
$spreadsheet=new Spreadsheet();
// Set document properties
$spreadsheet->getProperties()->setCreator("Joshua.M.S")
							 ->setLastModifiedBy("Joshua.M.S")
							 ->setTitle("Office 2007 XLSX Document")
							 ->setSubject("SchoolSafia Excel Sheet")
							 ->setDescription("SchoolSafia document for Office 2007 XLSX.")
							 ->setCategory("Template for adding recepients");
							 

$worksheet=$spreadsheet->getActiveSheet();

$worksheet->setTitle('Receipients');
////////////////////////////////////////HEADER TEXT//////////////////////////////////////////////	
$worksheet->setCellValue('G1','SchoolSafia Auto generated Excelsheet');	 
$worksheet->getStyle('G1')->getFont()->setBold(true);
////////////
$worksheet->setCellValue('F2',"NOTE: This sheet is Only for collecting receipient contacts");	 
$worksheet->getStyle('F2')->getFont()->setBold(true);
$worksheet->getStyle('F2')->getFont()->setItalic(true);
$worksheet->getStyle('F2')->getFont()->getColor()->setARGB(Color::COLOR_DARKBLUE);
///////////////
$worksheet->setCellValue('E3',"System Developed by Joshua.M.S Contact: 0752008745 Email: safia@schoolsafia.com Website: www.schoolsafia.com");	 
$worksheet->getStyle('E3')->getFont()->setItalic(true);
$worksheet->getStyle('E3')->getFont()->getColor()->setARGB(Color::COLOR_DARKGREEN);

$worksheet->setCellValue('H4',$sheet_title);	 
$worksheet->getStyle('H4')->getFont()->setBold(true);
$worksheet->getStyle('H4')->getFont()->getColor()->setARGB(Color::COLOR_DARKBLUE);

////////////////////////////////////////ENDS HEADER TEXT//////////////////////////////////////////////
//$objConditional1 = new PHPExcel_Style_Conditional();
//$objConditional1->getStyle()->getFont()->setBold(true);

////////////////////////////////////////Display subjects names//////////////////////////////////////////////

//$alphabetical_letters_array
///p_id, a_id, names, category, contact, contact1, email, sex, photo, stamp

/*$worksheet->getStyle('A:B')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$worksheet->getColumnDimension('B')->setWidth(3);
$worksheet->getColumnDimension('AA')->setVisible(false);
$worksheet->setCellValue('A5','NAMES');
$worksheet->getStyle('A5')->getFont()->setBold(true);
$worksheet->getColumnDimension('A')->setWidth(20);*/
$worksheet->freezePane('A6');
$i=0;
foreach($header_array as $titles){
$worksheet->getColumnDimension($alphabetical_letters_array[$i])->setWidth(15);
$worksheet->getStyle($alphabetical_letters_array[$i])->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
//HORIZONTAL_LEFT

$worksheet->setCellValue($alphabetical_letters_array[$i].'5',$titles)
           ->getStyle($alphabetical_letters_array[$i].'5')
		   ->getFont()
		   ->setBold(true);
		//make subjectes floatable   
	$i++;	  
}
////////////////////////////////////////ends Disaplay subjects names//////////////////////////////////////////////


header('Content-Type:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachement;filename="receipients.xlsx"');
header('Cache-Control: max-age=0');//donot cache content on browser

$writer = new Xlsx($spreadsheet);
 $writer->save('php://output');
//$writer->save($filename);
//$writer->save('C:\Users\Joshua.M.S\Downloads\receipients.xlsx');
////////////////////////////////////////ENDS STARTS PHPExcel//////////////////////////////////////////////
////////////////////////////////////////ENDS STARTS PHPExcel//////////////////////////////////////////////
////////////////////////////////////////ENDS STARTS PHPExcel//////////////////////////////////////////////




?>