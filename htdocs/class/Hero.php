<?php

abstract class Hero extends Warrior{


    public function hit(Warrior $warrior){
        $damage = rand(0,50);
        $warrior->setHealthPoint($warrior->getHealthPoint() - $damage );
        return $damage;
    }

    public function specialHit(Warrior $warrior){
    }

    public function restorePV(){
    }



}

?>
