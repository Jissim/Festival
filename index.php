<?php
// require 'Gestion.php';


include "getRacine.php";
include "$racine/controleur/controleurPrincipal.php";
include_once "$racine/modele/bd.inc.php";

include_once "$racine/modele/Gestion.php"; 


if (isset($_GET["action"])) {
    $action = $_GET["action"];
} 
else {
    $action = "template";

}


$fichier = controleurPrincipal($action);
include "$racine/controleur/$fichier";
?>
     
