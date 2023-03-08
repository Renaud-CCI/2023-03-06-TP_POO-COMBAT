<?php

class Hero
{
    private $id;
    private $name;
    private $healthPoint;

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
}
