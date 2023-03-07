<?php
class Hero{
    private $id;
    private $name;
    private $avatar;
    private $health_point;
    
    // FUNCTIONS

    /*construction de la classe */
    public function __construct($name, $avatar){
        $this->setName($name);
        $this->setAvatar($avatar);
    }
    

    /* hitMonster() est la fonction qui fait le combat */

    public function hitMonster(){

    }


    // GETTERS & SETTERS

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

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

    /**
     * Get the value of avatar
     */ 
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Set the value of avatar
     *
     * @return  self
     */ 
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }
}




?>