<?php

function controleurPrincipal($action) {
    $lesActions = array();
    $lesActions["template"] = "vue/Template.php";
    $lesActions["accueil"] = "Accueil.php";
    $lesActions["etablissement"] = "ListeEtablissements.php";
    $lesActions["attribution"] = "ConsultationAttributions.php";

    if (array_key_exists($action, $lesActions)) {
        return $lesActions[$action];
    } 
    else {
        return $lesActions["template"];
    }
}

?>
