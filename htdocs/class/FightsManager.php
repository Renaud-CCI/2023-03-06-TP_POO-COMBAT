<?php

class FightsManager
{
    private $db; 

    public function __construct(PDO $db)
    {
        $this->setDb($db);
    }


    public function fight(Object $hero, Object $monster)
    {
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

    public function createMonster()
    {
        $monsterClassesArray = ['Fantassin', 'Ogre', 'Sorcier'];
        $monsterNamesArray = ['Zuglorb', 'Fartoll', 'Pristomark', 'Doglen', 'Folkmiss', 'Zuzebot', 'Vuitross', 'Hyad', 'Zenzouz', 'Culeru', 'Hu', 'Drijail', 'Kimput', 'Quanno', 'Jouib', 'Xaf', 'Derko', 'Thabili', 'Bribard', 'Nuhot', 'Din', 'Supry'];
        $monsterClass = $monsterClassesArray[array_rand($monsterClassesArray, 1)];
        $monsterName = $monsterNamesArray[array_rand($monsterNamesArray, 1)];
        $healthPoint = rand(100,200);
        $data = [
            'name' => $monsterName,
            'health_point' => $healthPoint,
            'monster_class' => $monsterClass
        ];

        $monster = new $monsterClass($data);

        $this->add($monster);

        return $monster;
    } 

    public  function add(Object $monster)
    {
        $query = $this->db->prepare('INSERT INTO heroes (name, hero_class) VALUE (:name, :hero_class)');
        $query->execute([
            'name' => $monster->getName(),
            'hero_class' => $monster->getMonsterClass(),
        ]);

    }

    public function pretyDump($data){
        highlight_string("<?php\n\$data =\n" . var_export($data, true) . ";\n?>");
    }


    public function getDb()
    {
        return $this->db;
    }


    public function setDb($db)
    {
        $this->db = $db;

        return $this;
    }
}
