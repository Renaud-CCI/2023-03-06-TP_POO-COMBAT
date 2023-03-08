<?php

class FightsManager
{
   

    public function fight(Hero $hero, Monster $monster)
    {
        $fightResult = []; 

        do{
            $damage = $monster->hit($hero); 
            array_push($fightResult, "le monstre inflige ". $damage ." dégats au héro");
            if($hero->getHealthPoint() <= 0){
                array_push($fightResult, "le héro est mort");
                break;
            }

            $damage = $hero->hit($monster); 
            array_push($fightResult, "le héro inflige ". $damage ." dégats au monstre");
            if($monster->getHealthPoint() <= 0){
                array_push($fightResult, "le monstre est mort");
            }

        }while($monster->getHealthPoint() > 0);
     
        return $fightResult;
    }

    public function createMonster()
    {
        $name = "LE MONSTRE";
        $healthPoint = rand(100,200);
        $data = [
            'name' => $name,
            'health_point' => $healthPoint
        ];

        return new Monster($data);
    } 

    public function pretyDump($data){
        highlight_string("<?php\n\$data =\n" . var_export($data, true) . ";\n?>");
    }

}
