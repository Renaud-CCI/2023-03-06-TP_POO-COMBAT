<?php include_once('./config/header.php') ?>

    <?php 
    $heroes = new HeroesManager($db);

    if (isset($_POST['name'])){

        if ($_POST['name']!="none"){
            //--------------Préparation de la photo

            // récupération de l'extension de la photo (.jpeg, .png...)
            $photoExtensionBrute = explode('.', $_FILES['photo']['name']);
            $photoExtension = strtolower(end($photoExtensionBrute));
            //Tableau des extensions que l'on accepte
            $extensions = ['jpg', 'png', 'jpeg', 'gif'];

            // Vérification si l'on accepte ou pas
            if(in_array($photoExtension, $extensions) && $_FILES['photo']['error'] == 0){
                $uniqueName = uniqid('', true);
                //uniqid génère quelque chose comme ca : 5f586bf96dcd38.73540086
                $photo = "./Images/Avatars/" . $uniqueName.".".$photoExtension;
                //$file = 5f586bf96dcd38.73540086.jpg
                move_uploaded_file($_FILES['photo']['tmp_name'], $photo);
            }


            $heroes->add(new Hero($_POST['name'], $photo));
        }
    
        $_SESSION['sessionStart'] = 'true';
        unset ($_SESSION['name']);
        

    } elseif (!isset ($_SESSION['sessionStart'])){
        unset($_SESSION['alert']);
        echo"
            <section id='loginForm' class=''>
                <div class='container text-center'>
                    <form class='' method='post' action='index.php' enctype='multipart/form-data'>

                        <div class='row'>

                            <div class='m-3 col col-4 align-self-center'>
                                <input name='name' type='text' class='' id='name' placeholder='Choisissez un pseudo'>
                            </div>

                            <div class='m-3 col col-4 align-self-center border border-primary rounded'>
                                <label for='photo' class='label-file'>Importer un avatar</label>
                                <input name='photo' type='file' class='input-file' id='photo' accept='.png, .jpg, .jpeg'>
                            </div>
                            
                            <button class='m-3 col col-2 btn btn-outline-success' type='submit'>
                                Créer Héro
                            </button>

                            <div class='preview col col-12'>
                                <p></p> 
                            </div>
            
                        </div>

                    </form>
                    
                    <p>OU</p>

                    <form class='' method='POST' action='index.php'>  
                        <div class=''>
                                       
                            <input class='' type='hidden' name='name' value='none'>

                            <button class='btn btn-outline-info' type='submit'>
                                Jouer avec un ancien Héro
                            </button>

                        </div>
                    </form>
                </div>
            </section>    
        ";
    }
    
    if (isset($_SESSION['sessionStart']) && $_SESSION['sessionStart'] == 'true'){

        echo "<section id='chooseHero' class='container text-center'>";

        if (isset($_SESSION['alert'])){
            echo"<h2>{$_SESSION['alert']}</h2>";
        }

        echo"<div class='row text-center p-3 text-warning'>
                <h2>Choisissez un Héro</h2>
            </div>
        ";
        
        echo "
        <form class='' action='fight.php' method='get'>
            <div class='row text-center justify-content-center p-3'>
        ";

                // formulaire avatar  
                foreach ($heroes->findAllAlive() as $heroOfList){
                    echo "
                    <div class='col col-2'>
                        <input class='avatarInputs' type='radio' name='hero_id' id='{$heroOfList['id']}' value='{$heroOfList['id']}' required>
                        <label class='avatarLabels' for='{$heroOfList['id']}'><img src='{$heroOfList['avatar']}' alt=''></label>
                        <p>{$heroOfList['name']} : {$heroOfList['health_point']} PV</p>
                        </div>
                    ";  
                }
            
                echo "<br><br>";
                // bouton submit
        echo "
            </div>

            <div class='row text-center justify-content-center p-3'>
                <button class='btn btn-warning btn-lg btn-block' type='submit'>Faire un combat</button>
            </div>
        </form>

            <a href='./traitments/reInitIndex.php'>Créer un nouvel Héro</a>
        </section>
        ";
    }
    

require_once('./config/footer.php');
    ?>

