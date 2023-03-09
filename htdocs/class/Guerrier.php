<?php

class Guerrier extends Hero {

    public function hit(Warrior $warrior){
        parent::hit($warrior);
        $damage= $this->getDamage();
        $warrior->setHealthPoint($warrior->getHealthPoint() - $damage );
        return $damage;
    }
    
}


?>