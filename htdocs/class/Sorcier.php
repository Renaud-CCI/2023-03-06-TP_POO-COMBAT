<?php

class Sorcier extends Monster {


    public function __construct(array $data){
        if(!isset($data['warrior_class'])){
            array_push($data, "'warrior_class' => 'Sorcier'");
        }
        parent::__construct($data);
    }

    public function hit(Warrior $warrior){
        
        parent::hit($warrior);
        $damage= $this->getDamage();

        if ($warrior->getWarriorClass() == 'Guerrier'){
            $damage *= 2;
        }

        $warrior->setHealthPoint($warrior->getHealthPoint() - $damage );
        return $damage;
    }
    
}


?>