<?php

class Ogre extends Monster {

    public function __construct(array $data){
        if(!isset($data['warrior_class'])){
            array_push($data, "'warrior_class' => 'Ogre'");
        }
        parent::__construct($data);
        $this->setExtraDamage('Archer');
        $this->setSpecialHitCost(4);
        $this->setRestorePVCost(2);
    }

    
    
}


?>