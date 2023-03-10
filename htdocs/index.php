<?php
require_once("./config/autoload.php");
$db = require_once("./config/db.php");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - TP Jeu de fight</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link href="./CSS/index.css" rel="stylesheet">
    <link href="./CSS/card.css" rel="stylesheet">
</head>
<body>
    <?php
        $title = "TP Jeu de Fight";
        $subtitle = "Un jeu de fight au tour par tour en PHP pour apprendre les bases de la POO";
        require('partials/header.php');
        function pretyDump($data){
            highlight_string("<?php\n\$data =\n" . var_export($data, true) . ";\n?>");
        }
    ?>

    <?php 
        
        $manager = new WarriorsManager($db);
        

        if(isset($_POST['name'])){
            $hero = new $_POST['warrior_class']($_POST);
            $manager->add($hero); 
        }

        unset($_POST['name']);

        $allHeroes = $manager->findAllAlive('heroes');
        $allMonsters = $manager->findAllAlive('monsters');
    ?>



    <div class="container ">
        <div class="row justify-content-center">
            
            <div class="card col-6" style=text-align:center;">
                <div class="card-body">


                    <form method="post">
                        <h5 class="card-title">Créez votre Héro</h5>
                        <!-- <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6> -->
                        <div class="mb-3">
                            <input type="text" class="form-control" id="name" placeholder="Nom" name="name">
                            <label for="warrior_class" class="form-label">
                            <select name="warrior_class" id="warrior_class" class="mt-3 rounded" required>
                                <option value="" disabled selected>Type de Héro</option>
                                <option value="Archer">Archer</option>
                                <option value="Guerrier">Guerrier</option>
                                <option value="Mage">Mage</option>
                            </select>
                        </div>
                        <button class="btn btn-primary btn-lg px-4 gap-3">Créer</button>
                        <h5 class="card-title mt-3">Ou choississez un héro existant ci-dessous</h5>
                    </form>

                </div>
            </div>
            
            <form method="get" action="fight.php" class="row">
                
                <div class="row">
                <?php foreach ($allHeroes as $hero) : ?>  
                   
                    <input class='warriorInputs' type='radio' name='hero_id' id='<?=$hero->getId()?>' value='<?=$hero->getId()?>' required>
                    <div class="card warriorCard col-12 col-sm-6 col-lg-2 m-1" style="text-align:center;">
                        <label class='warriorLabels' for='<?=$hero->getId()?>'>  

                            <h5 class="card-title">Hero existant</h5>
                            <div class="mb-3">
                                <img src="https://api.dicebear.com/5.x/adventurer/svg?seed=<?= $hero->getName() ?>">
                                <p><strong><?= $hero->getName() ?></strong></p>
                                <p>⚔️ <?= $hero->getWarriorClass() ?></p>
                                <p>❤️ <?= $hero->getHealthPoint() ?> HP</p>
                                <p>
                                    <div class="progress-wrap progress text-center">
                                      <p>🔋Energie : <?= $hero->getEnergy()?></p>
                                      <div class="progress-bar progress" style="width:<?= $hero->getEnergy()*10?>%"> </div>
                                    </div>
                                </p>
                            </div>

                        </label>
                    </div>
                <?php endforeach; ?>
                </div>

                <div class="row text-center m-3">
                    <h1 class="display-5 fw-bold">🥊 VS 🥊</h1>
                </div>

                <div class="row">

                    <input class='warriorInputs' type='radio' name='monster_id' id='create' value='create' required>
                        <div id="createCard" class="card warriorCard col-12 col-sm-6 col-lg-2 m-1 align-self-center" style="text-align:center;">
                            <label class='warriorLabels' for='create'>
                                <h5 class="card-title">Créer un Monstre aléatoire</h5>  
                            </label>
                        </div>
               
        


                <?php foreach ($allMonsters as $monster) : ?>  
                   
                    <input class='warriorInputs' type='radio' name='monster_id' id='<?=$monster->getId()?>' value='<?=$monster->getId()?>' required>
                    <div class="card warriorCard col-12 col-sm-6 col-lg-2 m-1" style="text-align:center;">

                        <label class='warriorLabels' for='<?=$monster->getId()?>'>
                            <h5 class="card-title">Monstre existant</h5>
                            <div class="mb-3">
                                <img src="https://api.dicebear.com/5.x/bottts/svg?seed=<?= $monster->getName() ?>">
                                <p><strong><?= $monster->getName() ?></strong></p>
                                <p>⚔️ <?= $monster->getWarriorClass() ?></p>
                                <p>❤️ <?= $monster->getHealthPoint() ?> HP</p>
                                <p>
                                    <div class="progress-wrap progress text-center">
                                      <p>🔋Energie : <?= $monster->getEnergy()?></p>
                                      <div class="progress-bar progress" style="width:<?= $monster->getEnergy()*10?>%"> </div>
                                    </div>
                                </p>
                                
                            </div>
                        </label>

                    </div>
                <?php endforeach; ?>
                </div>

                    


                <input class="btn btn-warning m-3" type="submit" value="🔥 Combattre ! 🔥">

            </form>
        </div>
    </div>



<script type="text/javascript" src="./JS//card.js"></script>
</body>

</html>