<?php
class Database {
private $conn;
private $table;
public  $column_vals_array=[];
public  $numRows,$numPairRows;
public  $pairArrayValues=array();
public  $rowValues=array();
public  $insert_id;
public  $error;

public function __construct(){
  try{
         $this->conn = new PDO("mysql:host=".$_ENV['DB_HOST'].";dbname=".$_ENV['DB_DATABASE'].";port=".$_ENV['DB_PORT']."",$_ENV['DB_USER'],$_ENV['DB_PASS']);//;charset=utf8
        $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		$this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
		
	}catch(PDOException $e){
		
		$this->error=$e->getMessage();
	
	}
        
}

public function changeDatabaseConnection($host='localhost',$dbName='dit',$userName='root',$password=''){
	$this->host=$host;
    $this->dbName=$dbName;
	$this->userName=$userName;
	$this->password=$password;

	$this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbName;port=3307",$this->userName,$this->password);//;charset=utf8
	$this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	
}


public function set($instance,array $col_vals=[]){
$this->table=$instance;
$this->column_vals_array=$col_vals;
}


public function executeStatement($param){

		try{
			$this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES,1);
	        $sql=$this->conn->prepare($param);
		     $resp=$sql->execute();

			 return $resp;
		}catch(PDOException $e){				
		$this->error=$e->getMessage();
		echo $e->getMessage();		
			}	
		
	}
        
public function select($param){
	$sql=$this->conn->prepare($param);
	$sql->execute($this->column_vals_array);
	$this->numRows=$sql->fetch(PDO::FETCH_ASSOC);
	//mysqli_free_result($sql);
	return $this->numRows;
	}

	public function selectAllValues($params){
		$sql=$this->conn->prepare($params);
		$sql->execute($this->column_vals_array);
		$this->rowValues=$sql->fetchAll(PDO::FETCH_ASSOC);
		$this->numRows=$sql->rowCount();
		//mysqli_free_result($sql);
		return $this->rowValues;
		}


	public function updateTables($upd_sql){
    try{
	$this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
	$update=$this->conn->prepare($upd_sql);
    $resp=$update->execute($this->column_vals_array);
	}catch(PDOException $e){
		
		$this->error=$e->getMessage();
	
	}

//$this->insert_id=$this->conn->lastinsertid();
return $resp;
		}

		public function rowCount($sql){
			$sql=$this->conn->prepare($sql);
			$sql->execute($this->column_vals_array);
			$this->numRows= $sql->rowCount();
			//mysqli_free_result($sql);
			return $this->numRows;
			}

public function getCount(string $AND_OR='and'){
   
	    $qry="select * from ".$this->table." ".bindWhereClause($this->column_vals_array,$AND_OR)."";
		
		$sql=$this->conn->prepare($qry);
		$sql->execute($this->column_vals_array);
		$this->numRows= $sql->rowCount();
		//mysqli_free_result($sql);
		return $this->numRows;
}

public function getCountIn(string $AND_OR='and'){
    
	$qry="select * from ".$this->table." ".bindWhereClause($this->column_vals_array,$AND_OR,['IN'=>true])."";
	$sql=$this->conn->prepare($qry);
	$sql->execute();
	$this->numRows=$sql->rowCount();
	//mysqli_free_result($sql);
	return $this->numRows;
	}



public function getValues(string $AND_OR='and'){
	try{
		$qry="select * from ".$this->table." ".bindWhereClause($this->column_vals_array,$AND_OR)."";
		$sql=$this->conn->prepare($qry);

		$sql->execute($this->column_vals_array);
		$this->rowValues=$sql->fetch(PDO::FETCH_ASSOC);

		return $this->rowValues;

	}catch(PDOException $e){
		$this->error=$e->getMessage();
		 
  }

}


public function getAllValues(string $AND_OR='and'){
$sql=$this->conn->prepare("select * from ".$this->table." ".bindWhereClause($this->column_vals_array,$AND_OR)."");
$sql->execute($this->column_vals_array);
$this->rowValues=$sql->fetchAll();
//mysqli_free_result($sql);
return $this->rowValues;
}

   public function getAllValuesLike(string $AND_OR='and'){

	$qry="select * from ".$this->table." ".bindWhereClause($this->column_vals_array,$AND_OR,['LIKE'=>true])."";
	$sql=$this->conn->prepare($qry);
	$sql->execute($this->column_vals_array);

	$this->rowValues=$sql->fetchAll(PDO::FETCH_ASSOC);
	//mysqli_free_result($sql);
	return $this->rowValues;

	}

public function getAllValuesLimit($btwn_start,$btwn_end,$orderby,string $AND_OR='and'){
$sql=$this->conn->prepare("select * from ".$this->table." ".bindWhereClause($this->column_vals_array,$AND_OR)." order by ".$orderby." limit ".$btwn_start.",".$btwn_end."" );
$sql->execute($this->column_vals_array);
$this->rowValues=$sql->fetchAll(PDO::FETCH_ASSOC);
//mysqli_free_result($sql);
return $this->rowValues;
}




public function insertValues(){	
	
try{
	$params=bindWhereClause($this->column_vals_array,'',['INSERT'=>true]);
      $qry="insert into ".$this->table." values (".$params.")";
      	$insert=$this->conn->prepare($qry);
      
      $resp=$insert->execute($this->column_vals_array);
      $this->insert_id=$this->conn->lastinsertid();
      return $resp;

   }catch(PDOException $e){
   	  $this->error=$e->getMessage();
   	   
   }

}


public function update($fieldname,$fieldrow_id){

	
	try{
		$params=bindWhereClause($this->column_vals_array,'',['UPDATE'=>true]);
		$qry="update ".$this->table." set {$params} where  {$fieldname}='{$fieldrow_id}' ";
		$this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
		$update=$this->conn->prepare($qry);
		$resp=$update->execute($this->column_vals_array);
    
        return $resp;

	}catch(PDOException $e){

		$this->error=$e->getMessage();
		
	}
   return $resp;
}


public function updateIn($fieldname,array $row_ids,bool $flag_NOTIN=false){

	try{

		$params=bindWhereClause($this->column_vals_array,'',['UPDATE'=>true]);
		$in_statement=!$flag_NOTIN?"in(".join(',',$row_ids).")":"not in(".join(',',$row_ids).")";

		$this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
		$update=$this->conn->prepare("update ".$this->table." set {$params} where  {$fieldname} {$in_statement} ");
		$resp=$update->execute($this->column_vals_array);

	}catch(PDOException $e){
		$this->error=$e->getMessage();
		
	}

   return $resp;
}


public function delete(string $AND_OR='and'){

	try{

		$this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
		$delete=$this->conn->prepare("delete from ".$this->table." ".bindWhereClause($this->column_vals_array,$AND_OR)."");
		$resp=$delete->execute($this->column_vals_array);

	}catch(PDOException $e){
		$this->error=$e->getMessage();
		
	}

   return $resp;
}



public function beginTransaction()
{
	return $this->conn->beginTransaction();
}
public function commit()
{
	return $this->conn->commit();
}

public function rollBack()
{
	return $this->conn->rollBack();
}

public function inTransaction()
{
	return $this->conn->inTransaction();
}


public function disableForeignKeyChecks(){

	try{
		$this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
	$update=$this->conn->prepare("set foreign_key_checks=0");
	$resp=$update->execute();
	
	return $resp;
	
	}catch(PDOException $e){
		$this->error=$e->getMessage();
	
	}
	
	}
	
	public function enableForeignKeyChecks(){
		try{
			$this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
		$update=$this->conn->prepare("set foreign_key_checks=1");
		$resp=$update->execute();
		
		return $resp;
		
		}catch(PDOException $e){
			$this->error=$e->getMessage();
		
		}
	}
	
	
	public function auto_inc($num){
	
	try{
		$this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
	$update=$this->conn->prepare("alter table ".$this->table." auto_increment=".$num."");
	$resp=$update->execute();
	
	return $resp;
	
	}catch(PDOException $e){
		$this->error=$e->getMessage();
	
	}
	
	}
	
	public function close(){
	$this->conn=null;
	}
	

}
