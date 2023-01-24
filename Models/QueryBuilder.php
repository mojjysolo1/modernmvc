<?php
/**
 * Description of Model
 *
 * @author Joshua M.S
 */
abstract class QueryBuilder{

    protected static $database=null;
    public string $error_msg;
    public int $rowCount=0;
    public int $insert_id;
    
    public function __construct(Database $conn) {
         self::$database=$conn;

        
    }
    
    public function fetch($column,$cell,$assoc=false):array
    {
        self::$database->set($this->table,$column,$cell);
        $this->rowCount=self::$database->getCount();
       
        $resp_arr=self::$database->getValues($assoc);

        return is_array($resp_arr)?$resp_arr:[];

    }

    public function fetchPairs($column1,$row1,$column2,$row2):array
    {
        self::$database->setPairs($this->table,$column1,$row1,$column2,$row2);
        $this->rowCount=self::$database->getPairCount();
       
        $resp_arr=self::$database->getPairValues();

        return is_array($resp_arr)?$resp_arr:[];

    }


    public function fetchAssoc($column,$cell):array
    {
       
        return $this->fetch($column,$cell,true);
        
    }

    
    public function fetchAllAssoc($statement=''):array 
    {
        if(empty($statement))
           $statement="SELECT * FROM $this->table";

        $data=self::$database->selectAllValues($statement);
        $this->rowCount=self::$database->numRows;
        return is_array($data)?$data:[];
    }

    public function fetchRowCount($sql):int
    {
        $this->rowCount=self::$database->rowCount($sql)??0;
        return $this->rowCount;
    }
    

    public function store(array $arr_insert_values):bool
    {
        
      foreach($arr_insert_values as $key=>$val){
          if(!in_array($key,$this->columns)){
             $this->error_msg=$key." Column on ".$this->table." table Doesn't  Exist";
             return false;
          
          }
      }

      if(count($arr_insert_values)!==count($this->columns)){
             $this->error_msg="Some table felds are missing";
             return false;
      }
     

      self::$database->set($this->table,1,1);

      $response=self::$database->insertValues($arr_insert_values);

      if(!$response){
        $this->error_msg=self::$database->error;
        return false;
      }
          
      $this->insert_id=self::$database->insert_id;
      
      return $response;
     
    }



    
    public function update(array $arr_insert_values,$update_row_field,$update_row_val):bool
    {
      foreach($arr_insert_values as $key=>$val){
          if(!in_array($key,$this->columns)){
             $this->error_msg=$key." Column on ".$this->table." table Doesn't  Exist";
             return false;
          
          }
      }

      self::$database->set($this->table,1,1);

      $response=self::$database->update($arr_insert_values,$update_row_field,$update_row_val);

      return $response??false;
    }

    public function updateIn(array $arr_insert_values,$fieldname,array $row_ids,bool $flag_NOTIN=false):bool
    {
      foreach($arr_insert_values as $key=>$val){
          if(!in_array($key,$this->columns)){
             $this->error_msg=$key." Column on ".$this->table." table Doesn't  Exist";
             return false;
          
          }
      }

      self::$database->set($this->table,1,1);

      $response=self::$database->updateIn($arr_insert_values,$fieldname,$row_ids,$flag_NOTIN);

      return $response??false;
    }

    public function delete($field,$row):bool
    {
        self::$database->set($this->table,$field,$row);
        $response=self::$database->delete();
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
