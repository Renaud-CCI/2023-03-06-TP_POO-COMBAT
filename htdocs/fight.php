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
    <title>Fight - TP Jeu de fight</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link href="/css/styles.css" rel="stylesheet">
</head>
<body>
    <?php
        $title = "🥊 Fight ! 🥊";
        $subtitle = "Voici le résultat du fight contre le monstre " ;
        require('partials/header.php');
        function pretyDump($data){
            highlight_string("<?php\n\$data =\n" . var_export($data, true) . ";\n?>");
        }
    ?>
    <?php
        $heroesManager = new HeroesManager($db);
        $fightManager = new FightsManager($db);
        $hero = $heroesManager->find($_GET['id']);
        $monster = $fightManager->createMonster();
        $fightResult = $fightManager->fight($hero, $monster);
        $heroesManager->update($hero);
        $heroesManager->update($monster);
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
                        <p>⚔️ <?= $hero->getHeroClass() ?></p>
                        <p>❤️ <?= $hero->getHealthPoint() ?> HP</p>
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
                        <p>⚔️ <?= $monster->getMonsterClass() ?></p>
                        <p>❤️ <?= $monster->getHealthPoint() ?> HP</p>
                    </div>
                </div>
            </div>
        </div>

        <ul class="list-group list-group-numbered">
            <?php foreach ($fightResult as $key => $result) : ?>
                <li class="list-group-item <?= $key % 2 ? 'list-group-item-primary' : 'list-group-item-danger' ?>"><?= $result ?></li>
            <?php endforeach; ?>   
        </ul>
    </div>

    <div style="margin:20px auto;width:200px;text-align:center;">
        <a href="./" class="btn btn-primary w-100">🔁 Rejouer 🔁</a>
    </div>





</body>
</html>