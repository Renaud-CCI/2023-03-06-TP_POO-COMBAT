<?php

class Guerrier extends Hero {

    public function __construct(array $data) {
        if(!isset($data['warrior_class'])){
            array_push($data, "'warrior_class' => 'Fantassin'");
        }
        parent::__construct($data);
        $this->setSpecialHitCost(4);
        $this->setRestorePVCost(2);
    }
    public function specialHit(Warrior $warrior){
        $damage = rand(50,100);

        $this->setEnergy($this->getEnergy() - $this->getSpecialHitCost());
        $warrior->setHealthPoint($warrior->getHealthPoint() - $damage );
        
        return $damage;
    }

    public function restorePV(){
        $restoredPV = rand(20,80);
       
        $this->setEnergy($this->getEnergy() - $this->getRestorePVCost());
        $this->setHealthPoint($this->getHealthPoint() + $restoredPV );

        return $restoredPV;
    }


    
}


?>