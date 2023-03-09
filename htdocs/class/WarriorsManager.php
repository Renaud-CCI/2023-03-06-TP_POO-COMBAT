<?php

class WarriorsManager
{
    private $db; 

    public function __construct(PDO $db){
        $this->setDb($db);
    }

    
    public  function add(Warrior $warrior){
        $query = $this->db->prepare('INSERT INTO warriors (name, warrior_class) VALUE (:name, :warrior_class)');
        $query->execute([
            'name' => $warrior->getName(),
            'warrior_class' => $warrior->getWarriorClass(),
        ]);
        
    }
    
    public function findAllAlive(string $warriorClass = ''){
        $query = $this->db->query('SELECT * FROM warriors WHERE health_point > 0');
        $allAlive = $query->fetchAll(PDO::FETCH_ASSOC);

        $allAliveAsObject = [];
        
        if ($warriorClass == 'heroes'){
            $catchArray = ['Archer', 'Guerrier', 'Mage'];
        } else if ($warriorClass == 'monsters'){
            $catchArray = ['Fantassin', 'Ogre', 'Sorcier'];
        } else if ($warriorClass == ''){
            $catchArray = ['Archer', 'Guerrier', 'Mage','Fantassin', 'Ogre', 'Sorcier'];
        }
        
        
        foreach ($allAlive as $warrior) {
            if (in_array($warrior['warrior_class'], $catchArray)){
                $alive = new $warrior['warrior_class']($warrior);
                array_push($allAliveAsObject, $alive);
            }
        }
        
        return $allAliveAsObject;
    }
    
    public function find(int $id){
        $query = $this->db->prepare('SELECT * FROM warriors WHERE id = :id ');
        $query->execute([
            'id' => $id
        ]); 
        
        $warriorData = $query->fetch();
        $character = new $warriorData['warrior_class']($warriorData);
        return $character;
        
        // return new Hero($query->fetch());
        
    }
    
    public function update(Warrior $warrior){
        $query = $this->db->prepare('   UPDATE warriors  
                                        SET health_point = :health_point, energy = :energy
                                        WHERE id = :id');
        $query->bindValue(':id', $warrior->getId());
        $query->bindValue(':energy', $warrior->getEnergy());
        $query->bindValue(':health_point', $warrior->getHealthPoint());
        $query->execute();
    }
    
    

    // GETTERS & SETTERS
    public function setDb($db){
        $this->db = $db;
    }
}

?>