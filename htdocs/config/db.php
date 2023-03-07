<?php
$dns = 'mysql:host=127.0.0.1;dbname=combat';
$user = 'root';
$password = '';

try{
    $db = new PDO( $dns, $user, $password);
    // echo "connection établie" ;

}
catch (Exception $message){
    echo "ya un blem <br>" . "<pre>$message</pre>" ;
}