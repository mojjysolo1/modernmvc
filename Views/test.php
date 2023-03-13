<?php

$name = array("firstname"=>1, "lastname"=>2);
$name =array_fill_keys(['lastname'],'');

$name['firstname']=1;
print_r($name);
?>