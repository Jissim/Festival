<!-- manque le php -->
<?php
require 'MODELE/Gestion.php';

try {
  $connexion = connect();
  require 'VUE/Accueil.php';
}
catch (Exception $e) {
 $msgErreur = $e->getMessage();
  require 'VUE/Erreur.php';
}

