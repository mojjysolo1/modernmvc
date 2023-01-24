<?php
/**
 * Description of Accounts
 *
 * @author Joshua M.S
 */
class Test extends QueryBuilder{
   public $table='test';
    
   protected $columns=[];
   public string $error_msg;
   
   public function __construct(Database $db)
   {

     parent::__construct($db);

     $arr_fields=$this->fetchAllAssoc("select column_name from information_schema.columns where table_schema='".$_ENV['DB_DATABASE']."'
     and table_name='".$this->table."'");

     $this->columns=array_map(fn($rr)=>$rr['column_name'],$arr_fields);
     
   }
   
    public function create()
    {
        
        return "CREATE TABLE $this->table (
            `id` int NOT NULL AUTO_INCREMENT,
            `item` varchar(45) NOT NULL,
            PRIMARY KEY (`id`)
          ) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci";
    }


}
