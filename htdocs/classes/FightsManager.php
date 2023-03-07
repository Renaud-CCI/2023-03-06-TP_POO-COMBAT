<?php

class FightsManager {
    private $monster;

    /*instancie un nouvel objet Monster avec un ‘name’ et ses points de vie à 100*/
    public function createMonster(){
        // $uniqueName = uniqid('', false);
        $this->setMonster('Monster');

        return $this->monster;
    }

    /*Fait combattre le hero et le monster*/
    public function fight(Hero $hero,Monster $monster){
        $fightArray = [];
        while ($monster->getHealth_point() > 0 && $hero->getHealth_point() > 0){
            
            $fightStep = $monster->hit($hero);
            array_push($fightArray, "{$monster->getName()} à {$monster->getHealth_point()} PV et inflige {$fightStep} dégats à {$hero->getName()}");
            
            if ($hero->getHealth_point() > 0){
                $fightStep = $hero->hit($monster);
                array_push($fightArray, "{$hero->getName()} à {$hero->getHealth_point()} PV et inflige {$fightStep} dégats à {$monster->getName()}");
            } else {
                array_push($fightArray, "{$hero->getName()} est mort !");
                return $fightArray;
            }
        } 
        
        if ($monster->getHealth_point() <= 0) {
            array_push($fightArray, "{$monster->getName()} est mort !");
            return $fightArray;
        }
    }



    // GETTERS & SETTERS
    /**
     * Get the value of monster
     */ 
    public function getMonster()
    {
        return $this->monster;
    }

    /**
     * Set the value of monster
     *
     * @return  self
     */ 
    public function setMonster($monster)
    {
        $this->monster = new Monster($monster);

        return $this;
    }
}

?>