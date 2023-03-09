<?php

abstract class Hero extends Warrior{

    private $damage;

    public function hit(Warrior $warrior){
        $this->damage = rand(0,50);
    }

    public function getDamage(){
        return $this->damage;
    }

}
