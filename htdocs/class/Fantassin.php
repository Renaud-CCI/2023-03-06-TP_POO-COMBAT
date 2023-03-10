<?php

class Fantassin extends Monster {

    public function __construct(array $data) {
        if(!isset($data['warrior_class'])){
            array_push($data, "'warrior_class' => 'Fantassin'");
        }
        parent::__construct($data);
        $this->setExtraDamage('Mage');
        $this->setSpecialHitCost(3);
        $this->setRestorePVCost(3);
    }

}



?>