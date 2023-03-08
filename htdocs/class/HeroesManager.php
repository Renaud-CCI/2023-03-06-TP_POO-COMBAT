<?php

class HeroesManager
{
    private $db; 

    public function __construct(PDO $db)
    {
        $this->setDb($db);
    }


    public function setDb($db)
    {
        $this->db = $db;
    }

    public  function add(Object $hero)
    {
        $query = $this->db->prepare('INSERT INTO heroes (name, hero_class) VALUE (:name, :hero_class)');
        $query->execute([
            'name' => $hero->getName(),
            'hero_class' => $hero->getHeroClass(),
        ]);

    }

    public function findAllAlive($param)
    {
        $query = $this->db->query('SELECT * FROM heroes WHERE health_point > 0');
        $allAlive = $query->fetchAll(PDO::FETCH_ASSOC);

        $allAliveAsObject = [];

        if ($param == 'heroes'){
            $catchArray = ['Archer', 'Guerrier', 'Mage'];
        } else if ($param == 'monsters'){
            $catchArray = ['Fantassin', 'Ogre', 'Sorcier'];
        }


        foreach ($allAlive as $data) {
            if (in_array($data['hero_class'], $catchArray)){
                $alive = new $data['hero_class']($data);
                array_push($allAliveAsObject, $alive);
            }
        }

        return $allAliveAsObject;
    }

    public function find(int $id)
    {
        $query = $this->db->prepare('SELECT * FROM heroes WHERE id = :id ');
        $query->execute([
            'id' => $id
        ]); 

        $data = $query->fetch();
        $character = new $data['hero_class']($data);
        return $character;

        // return new Hero($query->fetch());

    }

    public function update(Object $hero)
    {
        $query = $this->db->prepare('   UPDATE heroes  
                                        SET health_point = :health_point, energy = :energy
                                        WHERE id = :id');
        $query->bindValue(':id', $hero->getId());
        $query->bindValue(':energy', $hero->getEnergy());
        $query->bindValue(':health_point', $hero->getHealthPoint());
        $query->execute();
    }

    public function pretyDump($data){
        highlight_string("<?php\n\$data =\n" . var_export($data, true) . ";\n?>");
    }

}
