<?php
/**
 * Description of Model
 *
 * @author Joshua M.S
 */
abstract class QueryBuilder{

    protected $database=null;
    public string $error_msg;
    public int $rowCount=0;
    public int $insert_id;
    public array $data=[];
    
    public function __construct(Database $conn) {
         $this->database=$conn;
    }

    public function parseData(array $data_array=[])
    {
        $this->data=$data_array;
        $this->database->set($this->table,$data_array);

        return $this;
    }


    public function fetchAssoc(string $AND_OR='and'):array
    {
       
        $this->rowCount=$this->database->getCount($AND_OR);
       
        $resp_arr=$this->database->getValues($AND_OR);

        return is_array($resp_arr)?$resp_arr:[];
        
    }

    
    public function fetchAllAssoc($statement=''):array 
    {
        if(empty($statement))
           $statement="SELECT * FROM $this->table";

        $data=$this->database->selectAllValues($statement);
        $this->rowCount=$this->database->numRows;
        return is_array($data)?$data:[];
    }

    public function fetchRowCount($sql):int
    {
        $this->rowCount=$this->database->rowCount($sql)??0;
        return $this->rowCount;
    }
    

    public function store():bool
    {
        $client_fields=array_keys($this->data);
        $invalid_matches=array_diff($this->columns,$client_fields);

        if(count($invalid_matches)>0){

            $this->error_msg="Invalid ".join(',',$invalid_matches)." Columns on ".$this->table." table.";
            throw new TableFieldsDontMatchException($this->error_msg);
        }
 

      if(count($this->data)!==count($this->columns)){
             throw new \Exception('Table fields dont match '.$this->table);
      }
    

      $response=$this->database->insertValues();

      if(!$response){
        echo $this->database->error;
        return false;
      }
          
      $this->insert_id=$this->database->insert_id;
      
      return $response;
     
    }
    
    public function update($update_row_field,$update_row_val):bool
    {
      $client_fields=array_keys($this->data);
      $invalid_matches=array_diff($client_fields,$this->columns);

      if(count($invalid_matches)>0){

          $this->error_msg="Invalid ".join(',',$invalid_matches)." Columns on ".$this->table." table.";
          throw new TableFieldsDontMatchException($this->error_msg);
      }

      $response=$this->database->update($update_row_field,$update_row_val);

      return $response??false;
    }

    public function updateIn($fieldname,array $row_ids,bool $flag_NOTIN=false):bool
    {
        $client_fields=array_keys($this->data);
        $invalid_matches=array_diff($client_fields,$this->columns);
  
        if(count($invalid_matches)>0){
  
            $this->error_msg="Invalid ".join(',',$invalid_matches)." Columns on ".$this->table." table.";
            throw new TableFieldsDontMatchException($this->error_msg);
        }

      $response=$this->database->updateIn($fieldname,$row_ids,$flag_NOTIN);

      return $response??false;
    }

    public function delete(string $AND_OR='and'):bool
    {
        $response=$this->database->delete($AND_OR);
        return $response??false;
    }

    abstract public function create();
    

//    abstract public function seeder();
//
//     public function seeder()
//    {
//        return "INSERT INTO $this->tablename (`p_id`,`names`,`salary`) VALUES (1,'joshua','1000');
//        INSERT INTO $this->tablename (`p_id`,`names`,`salary`) VALUES (2,'yehu','2000');
//        INSERT INTO $this->tablename (`p_id`,`names`,`salary`) VALUES (3,'dennish','3000');
//        INSERT INTO $this->tablename (`p_id`,`names`,`salary`) VALUES (4,'joan','2000');
//        INSERT INTO $this->tablename (`p_id`,`names`,`salary`) VALUES (5,'daisy','1500');";
//    }
}
