<?php

class Ogre extends Monster {


    public function __construct(array $data)
    {
        if(!isset($data['monster_class'])){
            array_push($data, "'monster_class' => 'Ogre'");
        }
        parent::__construct($data);
    }

    public function hit(Hero $hero)
    {
        $damage = rand(0,25);

        if ($hero->getHeroClass() == 'Archer'){
            $damage *= 2;
        }

        $hero->setHealthPoint($hero->getHealthPoint() - $damage );
        return $damage;
    }
    
}


?>