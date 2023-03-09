<?php

abstract class Monster extends Warrior{

    private $damage;

    public function hit(Warrior $warrior){
        $this->damage = rand(0,25);
    }

    public function getDamage(){
        return $this->damage;
    }

}
