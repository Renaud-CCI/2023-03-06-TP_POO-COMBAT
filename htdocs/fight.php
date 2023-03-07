<?php
require_once('./config/header.php');
unset($_POST['alert']);



$heroesManager = new HeroesManager($db);
$hero = $heroesManager->find($_GET['hero_id']);

//Demarrage du fight
$fightManager = new FightsManager;
$monster = $fightManager->createMonster();
$fightResults = $fightManager->fight($hero, $monster);
$heroesManager->update($hero);


    echo "
    <section id='fightSection' class='container m-3 text-center'>

        <div class='row text-center p-3 mx-5 text-warning'>
            <h2>Combat : {$hero->getName()} VS {$monster->getName()}</h2>
        </div>
        ";

        for ( $i = 0; $i < count($fightResults); $i++) {
            if ($i%2==0){
                $color= 'bg-danger text-light';
            }else{
                $color= 'bg-success text-light';
            }

        echo "
            <div class='row text-center px-3 py-2 mx-5 {$color}'>
                {$fightResults[$i]}        
            </div>
        ";
        }


        
    echo"
    </section>

    <section id='backToIndex' class='container text-center'>
    <a href='./index.php'>Retour à l'index</a>
    </section>
    ";



require_once('./config/footer.php');
?>


