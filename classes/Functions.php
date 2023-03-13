<?php
function numberCurrencyFormat($num){
	
	return 'UGX '.number_format($num,2,'.',',');
}

function defaultNumberFormat($num){
	
	return number_format($num,0,'.',',');
}

function numberDecimalFormat($num,$decimals=null){
	
	if(!$decimals)
	return number_format($num,2,'.',',');

	return number_format($num,$decimals,'.',',');
}

function roundTo2decimals($num,$decimals=null){

	if(is_null($decimals)){
		$rnum=round($num,2);
		return numberDecimalFormat($rnum,2);
	}
	
	$rnum=round($num,$decimals);
	return numberDecimalFormat($rnum,$decimals);
}

function nullTrim($str){
	return trim($str ??'');
  }

  function insertNowDate($timestamp=false){
     if($timestamp)
	     return time();

	return date('Y-m-d H:i:s',time());
  }


  function inputDateFormat($input_date){

    if($input_date=='')
         return '';
    
      return date("Y-m-d",strtotime($input_date));
      }

	  function inputDateTimeFormat($input_date){

		if($input_date=='')
			 return '';
		
		  return date("Y-m-d H:i:s",strtotime($input_date));
		  }



function outputDateFormat($input_date,$timezone_offset_minutes=''){

	if($timezone_offset_minutes==''){
		if($input_date=='')
			return '';

        return date("d-M-Y",strtotime($input_date));

	}else{

		if($input_date=='')
			return '';

			$timezone_name = timezone_name_from_abbr("", $timezone_offset_minutes*60, false);
			date_default_timezone_set($timezone_name);

        return date("d-M-Y",strtotime($input_date));

	}
    

}

function outputDateTimeFormat($input_date,$timezone_offset_minutes=''){

	if($timezone_offset_minutes==''){
		if($input_date=='')
			    return '';
	   
        return date("l d-M-Y h:i a",strtotime($input_date));
   
	}else{

		if($input_date=='')
			return '';

			$timezone_name = timezone_name_from_abbr("", $timezone_offset_minutes*60, false);
			date_default_timezone_set($timezone_name);

        return date("l d-M-Y h:i a",strtotime($input_date));

	}
    
}


function modifyDate($date){
	 
	 $date_parts=explode('/',$date);
	 $strDate=$date_parts[2].'-'.$date_parts[1].'-'.$date_parts[0]; 
	 
	 return   date("d-M-Y", strtotime($strDate));
}


function getTimeDifference($dt1,$dt2,$tzone=''){
	//get Date diff as intervals 
// $d1 = new DateTime("2018-01-10 00:00:00");
if($tzone!=''){
	$d1 = new DateTime($dt1,new DateTimeZone($tzone));
	$d2 = new DateTime($dt2,new DateTimeZone($tzone));
	$d1->setTimeZone(new DateTimeZone('UTC'));
	$d2->setTimeZone(new DateTimeZone('UTC'));
}else{
	$d1 = new DateTime($dt1);
	$d2 = new DateTime($dt2);
}


$interval = $d1->diff($d2);

$diffInSeconds = $interval->s; //45
$diffInMinutes = $interval->i; //23
$diffInHours   = $interval->h; //8
$diffInDays    = $interval->d; //21
$diffInMonths  = $interval->m; //4
$diffInYears   = $interval->y; //1

if($diffInYears>0){
    return $diffInYears.'y '.$diffInMonths.'m ';

}else if($diffInMonths>0){
	return $diffInMonths.'m '.$diffInDays.'d ';

}else if($diffInDays>0){

	return $diffInDays.'d '.$diffInHours.'h ';

}else if($diffInHours>0){

	return $diffInHours.'h '.$diffInMinutes.'m ';

}else if($diffInMinutes>0){
	return $diffInMinutes.'m '.$diffInSeconds.'s ';
}else{
	return $diffInSeconds.'s ';
}

}

//LOCATION TRACKING
function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE) {
    $output = NULL;
    if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
        $ip = $_SERVER["REMOTE_ADDR"];
        if ($deep_detect) {
            if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
    }

    $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"),'', strtolower(trim($purpose)));
    $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
    $continents = array(
        "AF" => "Africa",
        "AN" => "Antarctica",
        "AS" => "Asia",
        "EU" => "Europe",
        "OC" => "Australia (Oceania)",
        "NA" => "North America",
        "SA" => "South America"
    );
    if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
        $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
        if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
            switch ($purpose) {
                case "location":
                    $output = array(
                        "city"           => @$ipdat->geoplugin_city,
                        "state"          => @$ipdat->geoplugin_regionName,
                        "country"        => @$ipdat->geoplugin_countryName,
                        "country_code"   => @$ipdat->geoplugin_countryCode,
                        "continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                        "continent_code" => @$ipdat->geoplugin_continentCode
                    );
                    break;
                case "address":
                    $address = array($ipdat->geoplugin_countryName);
                    if (@strlen($ipdat->geoplugin_regionName) >= 1)
                        $address[] = $ipdat->geoplugin_regionName;
                    if (@strlen($ipdat->geoplugin_city) >= 1)
                        $address[] = $ipdat->geoplugin_city;
                    $output = implode(", ", array_reverse($address));
                    break;
                case "city":
                    $output = @$ipdat->geoplugin_city;
                    break;
                case "state":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "region":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "country":
                    $output = @$ipdat->geoplugin_countryName;
                    break;
                case "countrycode":
                    $output = @$ipdat->geoplugin_countryCode;
                    break;
            }
        }
    }
    return $output;
}



function ip_visitor_country()
{

    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];
    $country  = "Unknown";

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://www.geoplugin.net/json.gp?ip=".$ip);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $ip_data_in = curl_exec($ch); // string
    curl_close($ch);

    $ip_data = json_decode($ip_data_in,true);
    $ip_data = is_null($ip_data)?NULL:str_replace('&quot;', '"', $ip_data); // for PHP 5.2 see stackoverflow.com/questions/3110487/

    if($ip_data && $ip_data['geoplugin_countryName'] != null) {
        $country = $ip_data['geoplugin_countryName'];
    }

    //return 'IP: '.$ip.' # Country: '.$country;
	return $ip;
}

function getLocalIP(){
    $ip=getHostByName(getHostName());
    return  $ip;
}
//LOCATION TRACKING



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

function encodePwd($pwd){
 return sha1($pwd);
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

  function ParseInfo($strInfo){

	return "<span class='bg-info text-center text-light btn-block' style='border-radius:5px;padding:5px; font-weight:bold; font-size:16px;'>".ucfirst($strInfo)."</span>";

  }

  function longParseError($strError){

	return "<span class='bg-danger text-light text-center btn-block' style='border-radius:5px;padding:5px; font-size:16px;'>".ucfirst($strError)."</span>";

  }

?>