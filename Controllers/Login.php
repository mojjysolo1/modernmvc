<?php

class Login extends Controller{

    public $errmsg_arr = array();
    public  $authFlag = false;
    
    //initialise databse

public function validateLoginUser($credentials){
//initialise databse
$database=new Database();
//a_id, names, sex, email, auth_id, pwd, photo, pos, organisation, org_code, contacts, contacts1, email_id, email_valid, stamp
$database->setTriple('admin','auth_id',$credentials['auth'],'pwd',sha1($credentials['pwd']),'org_code',$credentials['ucode']);

if($database->getTripleCount()>0){

$rr=$database->getTripleValues();
$_SESSION['aid']=$rr['a_id'];
$_SESSION['org_code']=$rr['org_code'];
$_SESSION['account']=$rr['account'];

if($rr['org_code']=='CP' || $rr['org_code']=='ADMIN'){
    $database->set('users','pos',$rr['org_code']);
    $ss=$database->getValues();
    $_SESSION['uid']=$ss['u_id'];
    $_SESSION['pos_code']=$ss['pos'];
}


$this->authFlag=true;

}else{
 
    $this->errmsg_a[]="<button type='button' class='btn btn-danger btn-block'>Invalid  ID Number / Username  or Password</button>";
    $this->authFlag=false;
}

$_SESSION['sys_response']= $this->errmsg_a;

}


public function validateDataCoreLoginUser($credentials){
    //initialise databse
    $database=new Database();
    //a_id, names, sex, email, auth_id, pwd, photo, pos, organisation, org_code, contacts, contacts1, email_id, email_valid, stamp
    $database->setTriple('users','auth_id',$credentials['auth'],'pwd',sha1($credentials['pwd']),'pos',$credentials['ucode']);
    
    if($database->getTripleCount()>0){
    
    $rr=$database->getTripleValues();
    $_SESSION['uid']=$rr['u_id'];
    $_SESSION['authid']=$rr['auth_id'];
    $_SESSION['pos_code']=$rr['pos'];
    
    $this->authFlag=true;
    
    }else{
     
        $this->errmsg_a[]="<button type='button' class='btn btn-danger btn-block'>Invalid ID Number / Username or Password</button>";
        $this->authFlag=false;
    }
    
    $_SESSION['sys_response']= $this->errmsg_a;
    
    }

public function validationResponse(){

    return $this->authFlag;

}

}





