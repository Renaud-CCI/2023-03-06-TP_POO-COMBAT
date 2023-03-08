<?php

class Monster
{
    protected $id;
    protected $name;
    protected $healthPoint;
    protected $energy;
    protected $monsterClass;
    
    public function __construct(array $data)
    {
        if(isset($data['name'])){
            $this->setName($data['name']);
        }
        if(isset($data['health_point'])){
            $this->setHealthPoint($data['health_point']);
        }
        if(isset($data['monster_class'])){
            $this->setMonsterClass($data['monster_class']);
        }
        if(isset($data['energy'])){
            $this->setEnergy($data['energy']);
        }

    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getHealthPoint()
    {
        return $this->healthPoint;
    }

    public function setHealthPoint($healthPoint)
    {
        $this->healthPoint = $healthPoint;
    }


    /**
     * Get the value of monsterClass
     */ 
    public function getMonsterClass()
    {
        return $this->monsterClass;
    }

    /**
     * Set the value of monsterClass
     *
     * @return  self
     */ 
    public function setMonsterClass($monsterClass)
    {
        $this->monsterClass = $monsterClass;

        return $this;
    }


    public function getEnergy()
    {
        return $this->energy;
    }


    public function setEnergy($energy)
    {
        $this->energy = $energy;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }


    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
