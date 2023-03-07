<?php

class Monster {
    private $name;
    private $health_point;

    public function __construct($name){
        $this->setName($name);
        $this->setHealth_point(100);
    }
    
    /* hit() est la fonction qui fait le combat */
    public function hit(Hero $hero){
        $damage = rand(0,50);
        $heroHealth_point = $hero->getHealth_point();
        $hero->setHealth_point($heroHealth_point - $damage);
        
        return $damage;
    }



    // SETTERS & GETTERS
    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of health_point
     */ 
    public function getHealth_point()
    {
        return $this->health_point;
    }

    /**
     * Set the value of health_point
     *
     * @return  self
     */ 
    public function setHealth_point($health_point)
    {
        $this->health_point = $health_point;

        return $this;
    }
}

?>