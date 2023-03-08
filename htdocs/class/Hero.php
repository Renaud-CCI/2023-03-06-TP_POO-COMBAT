<?php

class Hero
{
    protected $id;
    protected $name;
    protected $healthPoint;
    protected $energy;
    protected $heroClass;

    public function __construct(array $data)
    {
        
        if(isset($data['id'])){
            $this->setId($data['id']);
        }
        if(isset($data['name'])){
            $this->setName($data['name']);
        }
        if(isset($data['health_point'])){
            $this->setHealthPoint($data['health_point']);
        }
        if(isset($data['hero_class'])){
            $this->setHeroClass($data['hero_class']);
        }
        if(isset($data['energy'])){
            $this->setEnergy($data['energy']);
        }
    }

    public function hit(Monster $monster)
    {
        $damage = rand(0,50);
        $monster->setHealthPoint($monster->getHealthPoint() - $damage );
        return $damage;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
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

    public function getHeroClass()
    {
        return $this->heroClass;
    }

    public function setHeroClass($heroClass)
    {
        $this->heroClass = $heroClass;

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
}
