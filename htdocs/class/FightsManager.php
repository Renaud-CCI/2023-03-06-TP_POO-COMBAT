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

    public function fightDisplay(Warrior $hero, Warrior $monster, string $action){

        switch($action){

            case 'hero_hit':
                $damage = $hero->hit($monster); 
                $returnString="{$hero->getName()} inflige {$damage} dégats à {$monster->getName()}. ";
                if($monster->getHealthPoint() <= 0){
                    $returnString .= "{$monster->getName()} est mort. ";
                }
                return $returnString;
                break;

            case 'hero_specialHit':
                $damage = $hero->specialHit($monster); 
                $returnString="{$hero->getName()} inflige {$damage} dégats à {$monster->getName()} et perd {$hero->getSpecialHitCost()}🔋. ";
                if($monster->getHealthPoint() <= 0){
                    $returnString .= "{$monster->getName()} est mort. ";
                }
                return $returnString;
                break;

            case 'hero_restorePV':
                $restoredPV = $hero->restorePV(); 
                $returnString="{$hero->getName()} récupère {$restoredPV} PV et perd {$hero->getRestorePVCost()}🔋. ";
                if($monster->getHealthPoint() <= 0){
                    $returnString .= "{$monster->getName()} est mort. ";
                }
                return $returnString;
                break;

            case 'hero_poison':
                $damage = $hero->hit($monster);
                $monster->setPoisoned(1);
                $hero->setEnergy($hero->getEnergy() - 8);
                $returnString="{$hero->getName()} inflige {$damage} dégats à {$monster->getName()} et l'empoisonne.\n";
                if($monster->getHealthPoint() <= 0){
                    $returnString .= "{$monster->getName()} est mort.\n";
                }
                return $returnString;
                break;

            case 'monster':
                return $this->monsterRandomAction($hero, $monster);
                break;

            default:
                return 'error';
        }
        
    }

    /*fonction qui fait faire une action au hasard au monstre*/
    public function monsterRandomAction(Warrior $hero, Warrior $monster){
        $actionsArray = ['hit'];
        if ($monster->getEnergy() >= $monster->getSpecialHitCost()){
            array_push($actionsArray, 'specialHit');
        }
        if ($monster->getEnergy() >= $monster->getRestorePVCost()){
            array_push($actionsArray, 'restorePV');
        }


        $monsterAction = $actionsArray[array_rand($actionsArray, 1)];
        switch($monsterAction){

            case 'hit':
                $damage = $monster->hit($hero); 
                $returnString="{$monster->getName()} inflige {$damage} dégats à {$hero->getName()}.\n";
                if($hero->getHealthPoint() <= 0){
                    $returnString .= "{$hero->getName()} est mort.\n";
                }
                return $returnString;
                break;

            case 'specialHit':
                $damage = $monster->specialHit($hero); 
                $returnString="{$monster->getName()} inflige {$damage} dégats à {$hero->getName()} et perd {$monster->getSpecialHitCost()}🔋.\n";
                if($hero->getHealthPoint() <= 0){
                    $returnString .= "{$hero->getName()} est mort.\n";
                }
                return $returnString;
                break;

            case 'restorePV':
                $restoredPV = $monster->restorePV(); 
                $returnString="{$monster->getName()} récupère {$restoredPV} PV et perd {$monster->getRestorePVCost()}🔋.\n";
                if($hero->getHealthPoint() <= 0){
                    $returnString .= "{$hero->getName()} est mort.\n";
                }
                return $returnString;
                break;

        }
    }

    public function createMonster(){
        $monsterClassesArray = ['Fantassin', 'Ogre', 'Sorcier'];
        $monsterNamesArray = ['Zuglorb', 'Felge', 'Selpert', 'Xuros', 'Tuyangle', 'Foska', 'Jiccim', 'Gual', 'Hermontais', 'Folowi', 'Cressail', 'Fartoll', 'Pristomark', 'Doglen', 'Folkmiss', 'Zuzebot', 'Vuitross', 'Hyad', 'Zenzouz', 'Culeru', 'Hu', 'Drijail', 'Kimput', 'Quanno', 'Jouib', 'Xaf', 'Derko', 'Thabili', 'Bribard', 'Nuhot', 'Din', 'Supry'];
        $monsterClass = $monsterClassesArray[array_rand($monsterClassesArray, 1)];
        $monsterName = $monsterNamesArray[array_rand($monsterNamesArray, 1)];
        $healthPoint = rand(100,200);
        $dataArray = [
            'name' => $monsterName,
            'health_point' => $healthPoint,
            'warrior_class' => $monsterClass
        ];

        $monster = new $monsterClass($dataArray);

        $id = $this->add($monster);
        $monster->setId($id);

        return $monster;
    } 

    public  function add(Warrior $warrior){
        $query = $this->db->prepare('   INSERT INTO warriors (name, warrior_class) 
                                        VALUE (:name, :warrior_class)');
        $query->execute([
            'name' => $warrior->getName(),
            'warrior_class' => $warrior->getWarriorClass(),
        ]);

        $query = $this->db->query('SELECT LAST_INSERT_ID() FROM warriors');
        $data = $query->fetch();
        
        return $data[0];
       

    }



    // GETTERS & SETTERS
 
    public function setDb($db){
        $this->db = $db;
    }

}
?>