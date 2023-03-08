<?php

class Archer extends Hero {


    public function __construct(array $data)
    {
        if(!isset($data['hero_class'])){
            array_push($data, "'hero_class' => 'Archer'");
        }
        parent::__construct($data);
    }

    public function hit(Monster $monster){
        parent::hit($monster);
    }
    
}


?>