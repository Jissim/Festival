<!-- manque le php -->
<?php
require '/MODELE/Gestion.php';

try {
  $connexion = connect();
  require 'VueAccueil.php';
}
catch (Exception $e) {
 $msgErreur = $e->getMessage();
  require 'Erreur.php';
}

