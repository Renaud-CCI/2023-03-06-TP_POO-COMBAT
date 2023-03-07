<?php
require_once('./config/autoload.php');
require_once('./config/db.php'); ?>
<?php
function prettyDump($data) {
    highlight_string("<?php\n\$data =\n" . var_export($data, true) . ";\n?>");
}
?>
<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="./CSS/ajoutPhoto.css">
</head>
<body>

    <?php 
    if (!isset($_POST['name']) || !isset ($_SESSION['sessionStart'])){
        echo"
        <section id='loginForm' class='flex justify-center m-8'>
        <div class='grid grid-cols-1'>
            <form class='w-full max-w-sm' method='post' action='index.php' enctype='multipart/form-data'>
                <div class='flex items-center border-b border-teal-500 py-2'>

                    <div class=''>
                        <label for='name' class=''>Créez votre Héro</label>
                        <input name='name' type='text' class='' id='name' >
                    </div>

                    <div class=''>
                        <label for='photo' class=''>Importer un avatar</label>
                        <input name='photo' type='file' class='' id='photo' accept='.png, .jpg, .jpeg'>
                    </div>
            
                    <div class='preview'>
                        <p>Aucun fichier sélectionné pour le moment</p> 
                    </div>
            
                    
                    <button class='flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded' type='submit'>
                    Valider
                    </button>
                </div>

            </form>

            <form class='w-full max-w-sm' method='POST' action='index.php'>  
                <div class='flex items-center border-b border-teal-500 py-2'>
                                       
                    <input class='appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none' type='hidden' name='name' value='none'>

                    <button class='flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded' type='submit'>
                    Jouer avec un ancien Héro
                    </button>

                </div>
            </form>
        </div>
    </section>
    
        ";
    } elseif (isset ($_POST['name']) || isset ($_SESSION['sessionStart'])){

        $_SESSION['alert'] = "Choisissez un Héro";
        $heroes = new HeroesManager($db);
        prettyDump($_FILES);

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
        echo"<h2>{$_SESSION['alert']}</h2>";
    }
    
    if (isset($_SESSION['sessionStart']) && $_SESSION['sessionStart'] == 'true'){
        echo "
            <a href='./traitments/reInitIndex.php'>Créer un nouvel Héro</a>
            <br>
            <h3>liste des héros</h3>";
        echo "
            <div class=''>
                <form class='' action='' method='get'>
        ";

        // formulaire avatar  
        foreach ($heroes->findAllAlive() as $heroOfList){
            prettyDump($heroOfList);
            echo "
            <input class='avatarInputs' type='radio' name='avatar' id='avatar{$i}' value='avatars/avatar_{$i}.jpg' required>
            <label class='avatarLabels m-1' for='avatar{$i}'><img src='avatars/avatar_{$i}.jpg' alt=''></label>
            ";  
        }
        echo "<br><br>";
        // bouton submit
        
        echo "
                    <button class='' style='height: 45px; width: 120px' type='submit'>Soumettre</button>
                </form>
            </div>
        ";
    }
    
    ?>

<script type="text/javascript" src="./JS/ajoutPhoto.js"></script>
</body>
</html>