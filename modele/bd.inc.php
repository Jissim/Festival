<?php

function connexionPDO() {
    $login = "root";
    $mdp = "root";
    $bd = "festival";
    $serveur = "localhost";

    try {
        $conn = new PDO("mysql:host=$serveur;dbname=$bd", $login, $mdp, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'')); 
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        print "Erreur de connexion PDO ";
        die();
    }
}

// {
//    $user="root";
//    $pass="root";
//    $dsn = 'mysql:host=localhost;dbname=festival';
//    $dbh= new PDO($dsn, $user, $pass); 
//    return $dbh;
// }

/*function connect()
{
   $hote="localhost";
   $login="festival";
   $mdp="secret";
   return mysql_connect($hote, $login, $mdp);
}*/

?>