<?php

class Sorcier extends Monster {


    public function __construct(array $data){
        if(!isset($data['warrior_class'])){
            array_push($data, "'warrior_class' => 'Sorcier'");
        }
        parent::__construct($data);
        $this->setExtraDamage('Guerrier');
        $this->setSpecialHitCost(2);
        $this->setRestorePVCost(4);
    }

}


?>