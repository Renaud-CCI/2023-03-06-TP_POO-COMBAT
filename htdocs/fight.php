<?php
require_once("./config/autoload.php");
$db = require_once("./config/db.php");

$warriorsManager = new WarriorsManager($db);
$fightManager = new FightsManager($db);

$hero = $warriorsManager->find($_GET['hero_id']);

if ($_GET['monster_id']=='create'){
    $monster = $fightManager->createMonster();
    $newUrl = "fight.php?hero_id={$hero->getId()}&monster_id={$monster->getId()}";
    header('Location: ' . $newUrl);
    exit;
} else {
    $monster = $warriorsManager->find($_GET['monster_id']);
}


// $fightResult = $fightManager->fight($hero, $monster);

if ($hero->getHealthPoint() > 0 && $monster->getHealthPoint() > 0){
    if (!isset($_GET['action']) || substr($_GET['action'], 0, 4) == 'hero'){
        $monsterButtonVisibility = 'visible';
        $heroButtonVisibility = 'hidden';
    } else if ($_GET['action'] == 'monster'){
        $monsterButtonVisibility = 'hidden';
        $heroButtonVisibility = 'visible';
    }
}

if (isset($_GET['action'])){
    $fightStep = $fightManager->fightDisplay($hero, $monster, $_GET['action']);

    $warriorsManager->update($hero);
    $warriorsManager->update($monster);
} else {
    $fightStep = var_dump($monster);
}
    
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fight - TP Jeu de fight</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link href="./CSS/card.css" rel="stylesheet">
</head>
<body>
    <?php
        $title = "🥊 Fight ! 🥊";
        // $subtitle = "Voici le résultat du fight contre le monstre " ;
        require('partials/header.php');
        function pretyDump($data){
            highlight_string("<?php\n\$data =\n" . var_export($data, true) . ";\n?>");
        }
    ?>



    <div class="container">
        <div class="row justify-content-center p-2" style="text-align:center;">
            <div class="card col-5 col-lg-3 m-1" style="text-align:center;">
                <div class="card-body">
                    <h5 class="card-title">Hero</h5>
                    <!-- <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6> -->
                    <div class="mb-3">
                        <img src="https://api.dicebear.com/5.x/adventurer/svg?seed=<?= $hero->getName() ?>">
                        <p><?= $hero->getName() ?></p>
                        <p>⚔️ <?= $hero->getWarriorClass() ?></p>
                        <p>❤️ <?= $hero->getHealthPoint() ?> HP</p>
                        <p>
                            <div class="progress-wrap progress text-center">
                                <p>🔋Energie : <?= $hero->getEnergy()?></p>
                                <div class="progress-bar progress" style="width:<?= $hero->getEnergy()*10?>%"> </div>
                            </div>
                        </p>
                        <div style="visibility:<?= $heroButtonVisibility ?>">
                            <form action="fight.php" method="get">
                                <input type="hidden" name='hero_id' value="<?=$_GET['hero_id']?>">
                                <input type="hidden" name='monster_id' value="<?=$_GET['monster_id']?>">
                                <input type="hidden" name='action' value="hero_hit">
                                <input class="btn btn-warning m-1" type="submit" value="Hit">                            
                            </form>
                            <form action="fight.php" method="get">
                                <input type="hidden" name='hero_id' value="<?=$_GET['hero_id']?>">
                                <input type="hidden" name='monster_id' value="<?=$_GET['monster_id']?>">
                                <input type="hidden" name='action' value="hero_specialHit">
                                <input class="btn btn-warning m-1" type="submit" value="Special Hit">                            
                            </form>
                            <form action="fight.php" method="get">
                                <input type="hidden" name='hero_id' value="<?=$_GET['hero_id']?>">
                                <input type="hidden" name='monster_id' value="<?=$_GET['monster_id']?>">
                                <input type="hidden" name='action' value="hero_restorePV">
                                <input class="btn btn-warning m-1" type="submit" value="Restore PV">                            
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-1 m-1 align-self-center" style="text-align:center;">
                <div class="card-body">
                    <h2 class="card-title">🌩️</h2>
                </div>
            </div>

            <div class="card col-5 col-lg-3 m-1" style="text-align:center;">
                <div class="card-body">
                    <h5 class="card-title">Monstre</h5>
                    <!-- <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6> -->
                    <div class="mb-3">
                        <img src="https://api.dicebear.com/5.x/bottts/svg?seed=<?= $monster->getName() ?>">
                        <p><?= $monster->getName() ?></p>
                        <p>⚔️ <?= $monster->getWarriorClass() ?></p>
                        <p>❤️ <?= $monster->getHealthPoint() ?> HP</p>
                        <p>
                            <div class="progress-wrap progress text-center">
                                <p>🔋Energie : <?= $monster->getEnergy()?></p>
                                <div class="progress-bar progress" style="width:<?= $monster->getEnergy()*10?>%"> </div>
                            </div>
                        </p>
                        <div style="visibility:<?= $monsterButtonVisibility ?>">
                            <form action="fight.php" method="get">
                                <input type="hidden" name='hero_id' value="<?=$_GET['hero_id']?>">
                                <input type="hidden" name='monster_id' value="<?=$_GET['monster_id']?>">
                                <input type="hidden" name='action' value="monster">
                                <input class="btn btn-warning m-1" type="submit" value="Action Aléatoire">                            
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="fightComment">
            <?= $fightStep ?>
        </div>
    </div>

    <div style="margin:20px auto;width:200px;text-align:center;">
        <a href="./" class="btn btn-primary w-100">🔁 Rejouer 🔁</a>
    </div>





</body>
</html>