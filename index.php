<?php
// require 'Gestion.php';


include "getRacine.php";
include "$racine/controleur/controleurPrincipal.php";
include_once "$racine/modele/bd.inc.php";

include_once "$racine/modele/Gestion.php"; 
// try {
//   require 'Accueil.php';
// }
// catch (Exception $e) {
//  $msgErreur = $e->getMessage();
//   require 'Erreur.php';
// }  

if (isset($_GET["action"])) {
    $action = $_GET["action"];
} 
else {
    $action = "template";

}
catch (Exception $e) {
 $msgErreur = $e->getMessage();
  require 'Erreur.php';
}  


//if (isset($_GET["action"])) {
//    $action = $_GET["action"];
//} 
//else {
//    $action = "accueil";
//}

$fichier = controleurPrincipal($action);
include "$racine/controleur/$fichier";
?>
     
