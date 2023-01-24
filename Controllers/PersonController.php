<?php
class PersonController extends Person{

    public function findPerson()
    {


       $person_data_array=self::fetchAssoc('p_id',$_GET['pid']);
        
       return View::make('personlist_view',$person_data_array);
    }
}

