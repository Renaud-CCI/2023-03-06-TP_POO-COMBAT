<?php

class Mage extends Hero {

    public function __construct(array $data) {
        if(!isset($data['warrior_class'])){
            array_push($data, "'warrior_class' => 'Fantassin'");
        }
        parent::__construct($data);
        $this->setSpecialHitCost(2);
        $this->setRestorePVCost(4);
    }
    public function specialHit(Warrior $warrior){
        $damage = rand(50,80);

        $this->setEnergy($this->getEnergy() - $this->getSpecialHitCost());
        $warrior->setHealthPoint($warrior->getHealthPoint() - $damage );
        
        return $damage;
    }

    public function restorePV(){
        $restoredPV = rand(50,110);
       
        $this->setEnergy($this->getEnergy() - $this->getRestorePVCost());
        $this->setHealthPoint($this->getHealthPoint() + $restoredPV );

        return $restoredPV;
    }


    
}


?>