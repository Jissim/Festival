<!-- manque le php -->
<?php
require 'Gestion.php';

try {
  $connexion = getConnexion();
  require 'Accueil.php';
}
catch (Exception $e) {
 $msgErreur = $e->getMessage();
  require 'Erreur.php';
}

