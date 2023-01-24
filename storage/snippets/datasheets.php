<?php
require_once $_SESSION['DOCUMENT_ROOT'].'/Packages/PHPSPREADSHEETS/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Fill;
//READING EXCEL DATA
//use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

	$alphabetical_letters_array=array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ','BA','BB','BC','BD','BE','BF','BG','BH','BI','BJ','BK','BL','BM','BN','BO','BP','BQ','BR','BS','BT','BU','BV','BW','BX','BY','BZ');

/*=============================PRIVILEGES AND INITIALISATIONS=====================================*/


  $errmsg_arr = array();
  $errflag = false;


  
$opt=$data['opt'];
$occupation=$data['opt2'];
////////////////////////////////////////STARTS PHPExcel//////////////////////////////////////////////
////////////////////////////////////////STARTS PHPExcel//////////////////////////////////////////////
////////////////////////////////////////STARTS PHPExcel//////////////////////////////////////////////
//xlsx=vnd.openxmlformats-officedocuments.spreadsheetml.sheet///xls=/vnd.ms-excel
$spreadsheet=new Spreadsheet();
// Set document properties
$spreadsheet->getProperties()->setCreator("Joshua.M.S")
							 ->setLastModifiedBy("Joshua.M.S")
							 ->setTitle("Office XLSX Document")
							 ->setSubject("SchoolSafia Excel Sheet")
							 ->setDescription("SchoolSafia document for Office 2007 XLSX.")
							 ->setCategory("Template Data Template");
							 

$worksheet=$spreadsheet->getActiveSheet();




switch($opt){
	
case 'new_ATP';
//Array ( [atp_occp] => a [atp_pats] => [atp_staff] => [atp_start] => [atp_end] => [atp_status] => unavailable [opt] => new_ATP ) 
print_r($_POST);
break;
/*********************************************ends levels_3_template******************************************/
/*********************************************ends levels_3_template******************************************/
case 'new_OCCPN';
//Array ( [occp_Levels] => level 1 [occp_occp] => s [occp_initial] => [opt] => new_OCCPN ) 
print_r($_POST);
break;
/*********************************************ends levels_3_template******************************************/
/*********************************************ends levels_3_template******************************************/



	default:

	$errmsg_arr[]=ParseError("Error: Wrong Params1");

		$_SESSION['sys_response']=$errmsg_arr;
//header('location:./admin-reg');
		//exit();
		echo ParseError("Error: Wrong Params1");

	break;
	
}