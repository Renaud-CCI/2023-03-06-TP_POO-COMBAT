<?php

abstract class Warrior {
    protected $id;
    protected $name;
    protected $healthPoint;
    protected $energy;
    protected $warriorClass;

    public function __construct(array $data){
        
        if(isset($data['id'])){
            $this->setId($data['id']);
        }
        if(isset($data['name'])){
            $this->setName($data['name']);
        }
        if(isset($data['health_point'])){
            $this->setHealthPoint($data['health_point']);
        }
        if(isset($data['warrior_class'])){
            $this->setWarriorClass($data['warrior_class']);
        }
        if(isset($data['energy'])){
            $this->setEnergy($data['energy']);
        }
    }

    abstract public function hit(Warrior $warrior);


    // GETTERS & SETTERS
    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function getHealthPoint(){
        return $this->healthPoint;
    }

    public function setHealthPoint($healthPoint){
        $this->healthPoint = $healthPoint;
    }

    public function getWarriorClass(){
        return $this->warriorClass;
    }

    public function setWarriorClass($warriorClass){
        $this->warriorClass = $warriorClass;

        return $this;
    }

    public function getEnergy(){
        return $this->energy;
    }

    public function setEnergy($energy){
        $this->energy = $energy;
    }
}

?>