<?php

class FightsManager
{
    private $db; 

    public function __construct(PDO $db){
        $this->setDb($db);
    }


    public function fight(Warrior $hero, Warrior $monster){
        $fightResult = []; 

        do{
            $damage = $monster->hit($hero); 
            array_push($fightResult, "{$monster->getName()} a {$monster->getHealthPoint()} PV et inflige {$damage} dégats au héro");
            if($hero->getHealthPoint() <= 0){
                array_push($fightResult, "{$hero->getName()} est mort");
                break;
            }

            $damage = $hero->hit($monster); 
            array_push($fightResult, "{$hero->getName()} a {$hero->getHealthPoint()} PV et inflige {$damage} dégats au monstre");
            if($monster->getHealthPoint() <= 0){
                array_push($fightResult, "{$monster->getName()} est mort");
            }

        }while($monster->getHealthPoint() > 0);
     
        return $fightResult;
    }

    public function createMonster(){
        $monsterClassesArray = ['Fantassin', 'Ogre', 'Sorcier'];
        $monsterNamesArray = ['Zuglorb', 'Fartoll', 'Pristomark', 'Doglen', 'Folkmiss', 'Zuzebot', 'Vuitross', 'Hyad', 'Zenzouz', 'Culeru', 'Hu', 'Drijail', 'Kimput', 'Quanno', 'Jouib', 'Xaf', 'Derko', 'Thabili', 'Bribard', 'Nuhot', 'Din', 'Supry'];
        $monsterClass = $monsterClassesArray[array_rand($monsterClassesArray, 1)];
        $monsterName = $monsterNamesArray[array_rand($monsterNamesArray, 1)];
        $healthPoint = rand(100,200);
        $dataArray = [
            'name' => $monsterName,
            'health_point' => $healthPoint,
            'warrior_class' => $monsterClass
        ];

        $monster = new $monsterClass($dataArray);

        $this->add($monster);

        return $monster;
    } 

    public  function add(Warrior $warrior){
        $query = $this->db->prepare('   INSERT INTO warriors (name, warrior_class) 
                                        VALUE (:name, :warrior_class)');
        $query->execute([
            'name' => $warrior->getName(),
            'warrior_class' => $warrior->getWarriorClass(),
        ]);

    }



    // GETTERS & SETTERS
 
    public function setDb($db){
        $this->db = $db;
    }

}
?>