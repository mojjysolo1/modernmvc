<?php
/**
 * Description of Accounts
 *
 * @author Joshua M.S
 */
class Books extends QueryBuilder{
   public $table='books';
    
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
            `book_id` int(11) NOT NULL AUTO_INCREMENT,
            `bookcode` varchar(15) NOT NULL,
            `bookname` varchar(45) NOT NULL,
            `created_at` datetime NOT NULL,
            `updated_at` datetime NOT NULL,
            `stamp` varchar(15) NOT NULL,
            PRIMARY KEY (`book_id`)
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3";
    }


}
