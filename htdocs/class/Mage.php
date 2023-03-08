<?php

class Mage extends Hero {


    public function __construct(array $data)
    {
        if(!isset($data['hero_class'])){
            array_push($data, "'hero_class' => 'Mage'");
        }
        parent::__construct($data);
    }

    public function hit(Monster $monster){
        parent::hit($monster);
    }
    
}


?>