<?php

$sheet_title='MODULAR';
$fileName=strtoupper(basename($_FILES['file_xlsx']['name']));
$tmpName=$_FILES['file_xlsx']['tmp_name'];
$excelReader=new PhpOffice\PhpSpreadsheet\Reader\Xlsx();
$excelObj=$excelReader->load($tmpName);
$worksheet=$excelObj->getSheet(0);

if($sheet_title!=$worksheet->getTitle()){
$errmsg_arr[]="<span class='btn btn-danger btn-block'>Incompartible Data sheet- check sheet title</span>";
$errflag = true;
}

$i=0;
//check heading imported sheet
foreach($header_MODULAR as $titles){
	
if($worksheet->getCell($alphabetical_letters_array[$i].'1')->getValue()!= $titles){
$errmsg_arr[]="<span class='btn btn-danger btn-block'>Headings from sheet donot match ::".$worksheet->getCell($alphabetical_letters_array[$i].'1')->getValue()."</span>";
$errflag = true;
}
$i++;
}
//ends check heading 

//ends get class and stream
if($errflag){
$_SESSION['sys_response']=$errmsg_arr;
session_write_close();
header('location:./admin-reg');
exit();
}

$rowCount=$worksheet->getHighestRow();


$r=2;
$err_num=0;
$success=0;
$stamp=time();
$Photo='photos/face.jpg';
$Ref_results_table='modular_results';

$obj_database=new Database();
$obj_validate=new Validation();

while($r<=$rowCount){//STARTS BIG WHILE

$errflag=false;
 
   
$Center_No=trim($worksheet->getCell('A'.$r)->getValue());
$Region=trim($worksheet->getCell('B'.$r)->getValue());
$District=trim($worksheet->getCell('C'.$r)->getValue());
$Institution=trim($worksheet->getCell('D'.$r)->getValue());
$Sector=trim($worksheet->getCell('E'.$r)->getValue());
$Occupation=trim($worksheet->getCell('F'.$r)->getValue());

$Modules=trim($worksheet->getCell('G'.$r)->getValue());
$Language=trim($worksheet->getCell('H'.$r)->getValue());
$Reg_No=str_replace(' ','',trim($worksheet->getCell('I'.$r)->getValue()));
$Candidate=trim($worksheet->getCell('J'.$r)->getValue());
$Sex=trim($worksheet->getCell('K'.$r)->getValue());
$Date_of_birth=trim($worksheet->getCell('L'.$r)->getFormattedValue());

$District_Of_Birth=trim($worksheet->getCell('M'.$r)->getFormattedValue());
$Nationality=trim($worksheet->getCell('N'.$r)->getValue());

$Disabled=trim($worksheet->getCell('O'.$r)->getValue());
$Type_Of_Disability=trim($worksheet->getCell('P'.$r)->getValue());

$Prog_Starts=trim($worksheet->getCell('Q'.$r)->getFormattedValue());
$Prog_Ends=trim($worksheet->getCell('R'.$r)->getFormattedValue());
$Qualification=trim($worksheet->getCell('S'.$r)->getValue());

$Practical_Module_Assessed_1=trim($worksheet->getCell('T'.$r)->getValue());
$Practical_Score_1=trim($worksheet->getCell('U'.$r)->getValue());
$Practical_Grade_1=trim($worksheet->getCell('V'.$r)->getValue());

$Practical_Module_Assessed_2=trim($worksheet->getCell('W'.$r)->getValue());
$Practical_Score_2=trim($worksheet->getCell('X'.$r)->getValue());
$Practical_Grade_2=trim($worksheet->getCell('Y'.$r)->getValue());
$Overall=trim($worksheet->getCell('Z'.$r)->getValue());

//validate student info imported from sheet
$obj_validate->line=$r;


if(count(array($Practical_Module_Assessed_1,$Practical_Module_Assessed_2))==0){
   
	$obj_validate->errmsg_arr[]="<span class='btn btn-warning btn-block'>Missing MODULE_ASSESSED value on line ".$r."</span>";
	$obj_validate->errflag=true;
	$obj_validate->err_num++;
			
		}

$errflag=$obj_validate->infoValidation($Center_No,$Reg_No,$Region,$District,$Institution,$Sector,$District_Of_Birth,$Occupation,$Modules,$Language,$Candidate,$Sex,$Date_of_birth,$Nationality,$Disabled,$Type_Of_Disability,$Prog_Starts,$Prog_Ends,$Qualification,array($Practical_Module_Assessed_1,$Practical_Module_Assessed_2),array($Practical_Score_1,$Practical_Score_2),array($Practical_Grade_1,$Practical_Grade_2),$Overall,'','','');
//check subjects from sheet


if($data['CHK_ERRORS']==1){
	if($errflag==false){
		$success++;
	}
	$r++;
	continue;
}

//////////////////////////////IF NO ERRORS////////////////////////////////////////////////
if($errflag==false){//IF NO ERRORS

//INSERTS CENTER
$obj_database->setPairs('institute','center_no',$Center_No,'center',addslashes($Institution));
if($obj_database->getPairCount()>0){
	$rr=$obj_database->getPairValues();
	$i_id=$rr['i_id'];
	
}else{
	$obj_database->institute_insertValues($Center_No,$Institution,$District,$Region,$stamp);
	$i_id=$obj_database->insert_id;
	
}
//ENDS INSERTS CENTER

//INSERTS ASSESSMENT PERIODS
//ass_id, ass_period
$obj_database->setPairs('assessments','ass_period',$assessment_period,'ass_category_code',$assment_period_cat_code);
if($obj_database->getPairCount()>0){
	$ss=$obj_database->getPairValues();
	$ass_id=$ss['ass_id'];
}else{
	//ass_id, ass_period, levels, ass_category, ass_category_code, stamp
	$obj_database->assessments_insertValues($assessment_period,$assment_period_name,$array_cat[$assment_period_cat_code],$assment_period_cat_code,$stamp);
	$ass_id=$obj_database->insert_id;
}
//ENDS INSERTS ASSESSMENT PERIODS

$obj_database->set('candidate','','');

$affect=$obj_database->candidate_insertValues($i_id,$ass_id,$Reg_No,$Candidate,$Sex,$Photo,$Sector,$Occupation,$Modules, $Ref_results_table,$Date_of_birth,$District_Of_Birth,$Nationality,$Disabled,$Type_Of_Disability,$Prog_Starts,$Prog_Ends,$Qualification,$Language,'',$stamp);

$c_id=$obj_database->insert_id;

$obj_database->set($Ref_results_table,'','');

$affect2=$obj_database->modular_results_insertValues($c_id,addslashes($Practical_Module_Assessed_1),$Practical_Score_1,$Practical_Grade_1,addslashes($Practical_Module_Assessed_2),$Practical_Score_2,$Practical_Grade_2,$Overall,$stamp);

if($affect && $affect2){
$success++;
}

}//ENDS IF NO ERRORS
//////////////////////////////ENDS IF NO ERRORS////////////////////////////////////////////////
 $r++;
}//ENDS BIG WHILE



$obj_validate->errmsg_arr[]=$data['CHK_ERRORS']==1?"<span class='btn btn-info btn-block'>$fileName <br/> SUCCESSFUL ENTRIES: {$success} / ".($rowCount-1)." <br/> ERRORS : ".$obj_validate->err_num." <br/> FINISHED</span>":"<span class='btn btn-primary btn-block'>$fileName <br/> SUCCESSFUL ENTRIES: {$success} /".($rowCount-1)."<br/> ERRORS : ".$obj_validate->err_num."/".($rowCount-1)." <br/> DUPS : ".$obj_validate->dups." <br/> FINISHED</span>";

$errflag = true;
if($errflag){
$_SESSION['sys_response']=$obj_validate->errmsg_arr;
session_write_close();
header('location:./admin-reg');
exit();
}


?>