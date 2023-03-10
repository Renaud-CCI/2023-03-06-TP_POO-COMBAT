<?php

abstract class Monster extends Warrior{

    private $extraDamage;


    public function hit(Warrior $warrior){
        $damage = rand(0,25);

        if ($warrior->getWarriorClass() == $this->getExtraDamage()){
            $damage *= 2;
        }

        $warrior->setHealthPoint($warrior->getHealthPoint() - $damage );

        return $damage;
    }
    
    public function specialHit(Warrior $warrior){
        $damage = rand(50,100);

        if ($warrior->getWarriorClass() == $this->getExtraDamage()){
            $damage *= 2;
        }

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


    // GETTERS & SETTERS

    public function getExtraDamage(){
        return $this->extraDamage;
    }

    public function setExtraDamage($extraDamage){
        $this->extraDamage = $extraDamage;

        return $this;
    }

}

?>
