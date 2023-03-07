<?php
class HeroesManager {
    private $db;

    //FUNCTIONS

    /*Constructeur*/
    public function __construct($db){
        $this->setDb($db);
    }

    /*Insere l'objet Hero en DB s'il n'existe pas et récupère son id*/
    public function add(Hero $hero){
        
        $req = $this->db->prepare("SELECT count(id) FROM heroes WHERE LOWER(name) = :name");
        $req->execute([ 'name' => strtolower($hero->getName())
                        ]);

        if($req->fetchColumn() > 0) {
            // Pseudo existant : on récupère les données et on set les variables
            $req = $this->db->prepare("SELECT * FROM heroes WHERE LOWER(name) = :name");
            $req->execute([ 'name' => strtolower($hero->getName())
                        ]);
            $heroInformations = $req->fetch();
            $hero->setId($heroInformations['id']);
            $hero->setname($heroInformations['name']);
            $hero->setHealth_point($heroInformations['health_point']);
            $hero->setAvatar($heroInformations['avatar']);

            if ($hero->getHealth_point() > 0) {
                $_SESSION['alert'] = "{$hero->getName()} existe déjà avec {$hero->getHealth_point()} PV";
            } else {
                $_SESSION['alert'] = "{$hero->getName()} est déjà mort, choisissez-en un autre";
            } 
        } else {
            // 'Pseudo libre :-)' le héro est créé et on set les variables
            $request = $this->db->prepare("INSERT INTO heroes (name, avatar) VALUES (:name, :avatar)");
            $request->execute([ 'name' => $hero->getName(),
                                'avatar' => $hero->getAvatar()
                            ]);

            $id = $this->db->lastInsertId();
            $hero->setId($id);
            $hero->setHealth_point(100);
            $_SESSION['alert'] = "{$hero->getName()} créé avec 100 PV";
        }

    }

    /*Récupère en DB tous les héros avec PV>0 et les stocke dans un tableau */
    public function findAllAlive(){
        $request = $this->db->query("SELECT * FROM heroes WHERE health_point>0");
        $heroes = $request->fetchAll();

        $heroesArray = [];

        foreach($heroes as $hero){
            array_push($heroesArray, $hero);
        }

        return $heroesArray;
    }




    // GETTERS & SETTERS

    /**
     * Get the value of db
     */ 
    public function getDb()
    {
        return $this->db;
    }

    /**
     * Set the value of db
     *
     * @return  self
     */ 
    public function setDb($db)
    {
        $this->db = $db;

        return $this;
    }
}

?>