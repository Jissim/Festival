<?php
// require 'Gestion.php';

// try {
//   $connexion = getConnexion();
//   require 'Accueil.php';
// }
// catch (Exception $e) {
//  $msgErreur = $e->getMessage();
//   require 'Erreur.php';
// }  

include "getRacine.php";
include "$racine/controleur/controleurPrincipal.php";
include_once "$racine/modele/authentification.inc.php"; // pour pouvoir utiliser isLoggedOn()

if (isset($_GET["action"])) {
    $action = $_GET["action"];
} 
else {
    $action = "accueil";
}

$fichier = controleurPrincipal($action);
include "$racine/controleur/$fichier";
?>
     