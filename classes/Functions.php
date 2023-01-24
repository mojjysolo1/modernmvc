<?php
function numberCurrencyFormat($num){
	
	return 'UGX '.number_format($num,2,'.',',');
}

function defaultNumberFormat($num){
	
	return number_format($num,0,'.',',');
}

function numberDecimalFormat($num){
	
	return number_format($num,2,'.',',');
}

function roundTo2decimals($num){
	return round($num,2);
}

function nullTrim($str){
	return trim($str ??'');
  }

function modifyDate($date){
	 
	 $date_parts=explode('/',$date);
	 $strDate=$date_parts[2].'-'.$date_parts[1].'-'.$date_parts[0]; 
	 
	 return   date("d-M-Y", strtotime($strDate));
}

function assignOrderNum($gid){
	return 'N'.str_pad($gid,4,"0",STR_PAD_LEFT);
}

function formatContacts4Validation($phone){
	
	
	if(preg_match('/^[256]{3}[1-9]{1}[0-9]{8}$/',$phone)){
		$phone="+".$phone;
	}
	if(preg_match('/^[0]{1}[1-9]{1}[0-9]{8}$/',$phone)){
		$phone="+256".substr($phone,1,10);
	}
	 return $phone;
	
}


function formatTextBreaking($str){
	$length=strlen($str);
	$txt='';
	$loopstr=ceil($length/25);
	if($length>25){
		$start=0;
		$end=25;
	for($i=0;$i<$loopstr;$i++){
		
	
		$txt.=substr($str,$start,$end);
		$txt.="\n";
		$start+=25;
		$end+=25;
		
			}
		return nl2br(trim($txt));
			
	}else{
		return $str;
	}

}

   function bindWhereClause($fieldvals_array,$AND_OR='and',array $clauses=['IN'=>false,'LIKE'=>false,'INSERT'=>false,'UPDATE'=>false]){

		if(empty($fieldvals_array)) return '';

		if($clauses['IN']){
			$result=" where ";

			foreach($fieldvals_array as $key=>$val){

				$result.="{$key} in ({$val}) {$AND_OR} ";
			}
		}else if($clauses['LIKE']){
			$result=" where ";

			foreach($fieldvals_array as $key=>$val){
                
				$result.="{$key} like :{$key} $AND_OR ";
			}

		}else if($clauses['INSERT']){

					//get field placeholders for prepare statement
			$keys=array_keys($fieldvals_array);

			$filtered_keys=array_map(fn($key)=>':'.$key.',',$keys);
			$index=count($filtered_keys)-1;
			$filtered_keys[$index]=rtrim($filtered_keys[$index],',');
			$placeholders=join('',$filtered_keys);
			//ends get field placeholders for prepare statement

			return $placeholders;

		}else if($clauses['UPDATE']){

					//get field placeholders for prepare statement
			$keys=array_keys($fieldvals_array);

			$filtered_keys=array_map(fn($keys)=> $keys.'=:'.$keys.',',$keys);
			//trim ',' on the last element
			$filtered_keys[count($filtered_keys)-1]=rtrim($filtered_keys[count($filtered_keys)-1],',');
			$placeholders=join('',$filtered_keys);
			//ends get field placeholders for prepare statement

			return $placeholders;

		}else{

			$result=" where ";
			foreach($fieldvals_array as $key=>$val){
				$result.="$key=:{$key} $AND_OR ";
			}
		}

		 
		return rtrim($result," $AND_OR ");

}

function createRandomString(){
$alphabet=array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
$symbols=array('~','!','@','#','%','^','*','(',')','_','+','}','{',':','"','?','>');

for($i=0;$i<10;$i++){
	$alpha_symbol_random_string.=$alphabet[rand(0,26)];
	$alpha_symbol_random_string.=$symbols[rand(0,17)];
	$alpha_symbol_random_string.=$alphabet[rand(0,26)];
}


$stringGenerate=mt_rand().''.$alpha_symbol_random_string;

return $stringGenerate;

}

function sendMail($to,$subject,$message){
	$filter_massage.='From : schoolsafia.com <br/> Email: safia@schoolsafia.com <br/> Number: 0752008745 <br/>'.$massage;
 
 /* To send HTML mail, you can set the Content-type header. */
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

/* additional headers */
/*$headers .= "To: Me <me@address1.net>\r\n";
$headers .= "From: Me <me@address2.net>\r\n";
$headers .= "Cc: me@address3.net\r\n";*/

$send=mail($to,$subject,$filter_massage,$headers);

return $send;
}

function emergencyContacts(){
	$quickdial="0752008745";
	return $quickdial;
}


function sortMonths_figures($omwezi,$figures){

	if($omwezi=='january'){
  
	  $months_array[0]="<td>".ucfirst(substr($omwezi,0,3))."</td>";
	  $candidate_figures[0]="<td>".number_format($figures,0,'',',')."</td>";
  
	}else if($omwezi=='february'){
  
	  $months_array[1]="<td>".ucfirst(substr($omwezi,0,3))."</td>";
	  $candidate_figures[1]="<td>".number_format($figures,0,'',',')."</td>";
  
	}else if($omwezi=='march'){
	  
	  $months_array[2]="<td>".ucfirst(substr($omwezi,0,3))."</td>";
	  $candidate_figures[2]="<td>".number_format($figures,0,'',',')."</td>";
	  
	}else if($omwezi=='april'){
  
	  $months_array[3]="<td>".ucfirst(substr($omwezi,0,3))."</td>";
	  $candidate_figures[3]="<td>".number_format($figures,0,'',',')."</td>";
	  
	}else if($omwezi=='may'){
  
	  $months_array[4]="<td>".ucfirst(substr($omwezi,0,3))."</td>";
	  $candidate_figures[4]="<td>".number_format($figures,0,'',',')."</td>";
	  
	}else if($omwezi=='june'){
  
	  $months_array[5]="<td>".ucfirst(substr($omwezi,0,3))."</td>";
	  $candidate_figures[5]="<td>".number_format($figures,0,'',',')."</td>";
	  
	}else if($omwezi=='july'){
  
	  $months_array[6]="<td>".ucfirst(substr($omwezi,0,3))."</td>";
	  $candidate_figures[6]="<td>".number_format($figures,0,'',',')."</td>";
	  
	}else if($omwezi=='august'){
  
	  $months_array[7]="<td>".ucfirst(substr($omwezi,0,3))."</td>";
	  $candidate_figures[7]="<td>".number_format($figures,0,'',',')."</td>";
	  
	}else if($omwezi=='september'){
  
	  $months_array[8]="<td>".ucfirst(substr($omwezi,0,3))."</td>";
	  $candidate_figures[8]="<td>".number_format($figures,0,'',',')."</td>";
	  
	}else if($omwezi=='october'){
  
	  $months_array[9]="<td>".ucfirst(substr($omwezi,0,3))."</td>";
	  $candidate_figures[9]="<td>".number_format($figures,0,'',',')."</td>";
	  
	}else if($omwezi=='november'){
  
	  $months_array[10]="<td>".ucfirst(substr($omwezi,0,3))."</td>";
	  $candidate_figures[10]="<td>".number_format($figures,0,'',',')."</td>";
	  
	}else if($omwezi=='december'){
  
	  $months_array[11]="<td>".ucfirst(substr($omwezi,0,3))."</td>";
	  $candidate_figures[11]="<td>".number_format($figures,0,'',',')."</td>";
	  
	}
	return $months_array;
  }

  function sortMonths_figures2($omwezi,$figures){
	$months_array=array();
	$candidate_figures=array();
	if($omwezi=='january'){
  
	  $months_array[0]="<td>".ucfirst(substr($omwezi,0,3))."</td>";
	  $candidate_figures[0]="<td>".number_format($figures,0,'',',')."</td>";
  
	}else if($omwezi=='february'){
  
	  $months_array[1]="<td>".ucfirst(substr($omwezi,0,3))."</td>";
	  $candidate_figures[1]="<td>".number_format($figures,0,'',',')."</td>";
  
	}else if($omwezi=='march'){
	  
	  $months_array[2]="<td>".ucfirst(substr($omwezi,0,3))."</td>";
	  $candidate_figures[2]="<td>".number_format($figures,0,'',',')."</td>";
	  
	}else if($omwezi=='april'){
  
	  $months_array[3]="<td>".ucfirst(substr($omwezi,0,3))."</td>";
	  $candidate_figures[3]="<td>".number_format($figures,0,'',',')."</td>";
	  
	}else if($omwezi=='may'){
  
	  $months_array[4]="<td>".ucfirst(substr($omwezi,0,3))."</td>";
	  $candidate_figures[4]="<td>".number_format($figures,0,'',',')."</td>";
	  
	}else if($omwezi=='june'){
  
	  $months_array[5]="<td>".ucfirst(substr($omwezi,0,3))."</td>";
	  $candidate_figures[5]="<td>".number_format($figures,0,'',',')."</td>";
	  
	}else if($omwezi=='july'){
  
	  $months_array[6]="<td>".ucfirst(substr($omwezi,0,3))."</td>";
	  $candidate_figures[6]="<td>".number_format($figures,0,'',',')."</td>";
	  
	}else if($omwezi=='august'){
  
	  $months_array[7]="<td>".ucfirst(substr($omwezi,0,3))."</td>";
	  $candidate_figures[7]="<td>".number_format($figures,0,'',',')."</td>";
	  
	}else if($omwezi=='september'){
  
	  $months_array[8]="<td>".ucfirst(substr($omwezi,0,3))."</td>";
	  $candidate_figures[8]="<td>".number_format($figures,0,'',',')."</td>";
	  
	}else if($omwezi=='october'){
  
	  $months_array[9]="<td>".ucfirst(substr($omwezi,0,3))."</td>";
	  $candidate_figures[9]="<td>".number_format($figures,0,'',',')."</td>";
	  
	}else if($omwezi=='november'){
  
	  $months_array[10]="<td>".ucfirst(substr($omwezi,0,3))."</td>";
	  $candidate_figures[10]="<td>".number_format($figures,0,'',',')."</td>";
	  
	}else if($omwezi=='december'){
  
	  $months_array[11]="<td>".ucfirst(substr($omwezi,0,3))."</td>";
	  $candidate_figures[11]="<td>".number_format($figures,0,'',',')."</td>";
	  
	}
	return  $candidate_figures;
  }


  function addNortification($users_receivers_array,$nortification){

	//INSERTS NORTIFICATION
				//nort_id, system, sender, sender_id, receiver, message, ops_table, ops_assmt_id, inserts, status, date, stamp
				global $database;
				global $ass_period_id;

				$database->set('nortifications',1,1);

				foreach($users_receivers_array as $receiver_vals){//STARTS FOREACH

					//echo "SELECT * FROM nortifications where app_sys='datacore' and sender='".$_SESSION['pos_code']."' and sender_id='".$_SESSION['uid']."' and ops_table='printed_cands' and ops_assmt_id='".$ass_period_id."' and status<>'seen' and receiver='".$receiver_vals."' "; exit;

                $tt=$database->selectAllValues("SELECT * FROM nortifications where app_sys='datacore' and sender='".$_SESSION['pos_code']."' and sender_id='".$_SESSION['uid']."' and ops_table='printed_cands' and ops_assmt_id='".$ass_period_id."' and status<>'seen' and receiver='".$receiver_vals."' ");

				if($database->numPairRows>0){
                  $inserts=$tt[0]['inserts']+1;

				  $database->nortifications_update($tt[0]['nort_id'],$tt[0]['app_sys'],$tt[0]['sender'],$tt[0]['sender_id'],$tt[0]['receiver'],$nortification,$tt[0]['ops_table'],$tt[0]['ops_assmt_id'],$inserts,$tt[0]['status'],date("d-M-Y",time()),time());

					

				}else{


						$database->nortifications_insertValues('datacore',$_SESSION['pos_code'],$_SESSION['uid'],$receiver_vals,$nortification,'printed_cands',$ass_period_id,1,'not seen',date("d-M-Y",time()),time());

					}
                    

				}//ENDS FOREACH


  }

  function ParseSuccess($strSuccess){

	return "<span class='bg-success text-light text-center btn-block' style='border-radius:5px;padding:5px; font-size:16px;'>".ucfirst($strSuccess)."</span>";

  }

  function parseCodedError($strCodedError){

	return "<span class='bg-danger text-center btn-block' style='border-radius:5px;padding:5px; font-size:16px;'><code class='text-light'>".ucfirst($strCodedError)."</code></span>";

  }
   function parseCodedWarning($strCodedError){
	return "<span class='bg-warning text-center btn-block' style='border-radius:5px;padding:5px;  font-weight:bold;  font-size:16px;'><code class='text-light'>".ucfirst($strCodedError)."</code></span>";
   }

  function ParseError($strError){

	return "<span class='bg-danger text-light text-center btn-block' style='border-radius:5px;padding:5px; font-size:16px;'>".ucfirst($strError)."</span>";

  }

  function ParseWarning($strWarning){

	return "<span class='bg-warning text-center text-light btn-block' style='border-radius:5px;padding:5px; font-weight:bold; font-size:16px;'>".ucfirst($strWarning)."</span>";

  }

  function longParseError($strError){

	return "<span class='bg-danger text-light text-center btn-block' style='border-radius:5px;padding:5px; font-size:16px;'>".ucfirst($strError)."</span>";

  }

