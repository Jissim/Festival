<?php

function controleurPrincipal($action) {
    $lesActions = array();
    $lesActions["accueil"] = "Accueil.php";
    $lesActions["etablissement"] = "ListeEtablissements.php";
    $lesActions["attribution"] = "ConsultationAttributions.php";
    $lesActions["recherche"] = "rechercheResto.php";
    $lesActions["connexion"] = "connexion.php";
    $lesActions["deconnexion"] = "deconnexion.php";
    $lesActions["profil"] = "monProfil.php";

    if (array_key_exists($action, $lesActions)) {
        return $lesActions[$action];
    } 
    else {
        return $lesActions["defaut"];
    }
}

?>