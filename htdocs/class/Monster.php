<?php

class Monster
{
    private $name;
    private $healthPoint;
    
    public function __construct(array $data)
    {
        if(isset($data['name'])){
            $this->setName($data['name']);
        }
        if(isset($data['health_point'])){
            $this->setHealthPoint($data['health_point']);
        }
    }

    public function hit(Hero $hero)
    {
        $damage = rand(0,25);
        $hero->setHealthPoint($hero->getHealthPoint() - $damage );
        return $damage;
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

}
