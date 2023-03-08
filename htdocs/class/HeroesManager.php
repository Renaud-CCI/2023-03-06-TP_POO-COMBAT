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

    public  function add(Hero $hero)
    {
        $query = $this->db->prepare('INSERT INTO heroes (name) VALUE (:name)');
        $query->execute([
            'name' => $hero->getName()
        ]);

    }

    public function findAllAlive()
    {
        $query = $this->db->query('SELECT * FROM heroes WHERE health_point > 0');
        $allHeroesAllive = $query->fetchAll(PDO::FETCH_ASSOC);

        $allHeroesAlliveAsObject = [];

        foreach ($allHeroesAllive as $data) {
            $hero = new Hero($data);
            array_push($allHeroesAlliveAsObject, $hero);
        }

        return $allHeroesAlliveAsObject;
    }

    public function find(int $id)
    {
        $query = $this->db->prepare('SELECT * FROM heroes WHERE id = :id ');
        $query->execute([
            'id' => $id
        ]); 

        $data = $query->fetch();
        $hero = new Hero($data);
        return $hero;

        // return new Hero($query->fetch());

    }

    public function update(Hero $hero)
    {
        $query = $this->db->prepare('UPDATE heroes SET health_point = :health_point WHERE id = :id');
        $query->bindValue(':id', $hero->getId());
        $query->bindValue(':health_point', $hero->getHealthPoint());
        $query->execute();
    }

    public function pretyDump($data){
        highlight_string("<?php\n\$data =\n" . var_export($data, true) . ";\n?>");
    }

}
