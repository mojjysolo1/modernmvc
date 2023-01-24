<?php
$db=new Database;

$data=[
    "item"=>'typescript'
 ];

 $db->set('test',$data);

 
echo "<pre>";
// $resp=$db->select("select * from test where item=:item");
// var_dump($db->getCount());
echo "</pre>";


