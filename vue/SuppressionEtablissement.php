<<<<<<< HEAD:VUE/SuppressionEtablissement.php
<?php 
    $title = 'Festival -  Supprimer Etablissement'; 
?> 
<?php ob_start() ?>
<?php
$id=$_REQUEST['id'];  
$lgEtab=obtenirDetailEtablissement($connexion, $id);
$nom=$lgEtab['nom'];

// Cas 1ère étape (on vient de index.php?action=listeEtablissements)

if ($_REQUEST['modif']=='demanderSupprEtab')    
=======
<?php $titre = 'Supprimer un établissement';

require("Modele.php"); 
require("./CONTROLEUR/ControlesEtGestionErreurs.inc.php");
// CONNEXION AU SERVEUR MYSQL PUIS SÉLECTION DE LA BASE DE DONNÉES festival 
$connexion = getConnexion();

ob_start ();

// SUPPRIMER UN ÉTABLISSEMENT 

$id=$_REQUEST['id'];  

$lgEtab=obtenirDetailEtablissement($connexion, $id);
$nom=$lgEtab['nom'];

// Cas 1ère étape (on vient de listeEtablissements.php)

if ($_REQUEST['action']=='demanderSupprEtab')    
>>>>>>> 7c0bab6b4d43e48e6d88592b14883d482f922596:vue/SuppressionEtablissement.php
{
   echo "
   <br><center><h5>Souhaitez-vous vraiment supprimer l'établissement $nom ? 
   <br><br>
<<<<<<< HEAD:VUE/SuppressionEtablissement.php
   <a href='index.php?action=supressionEtablissements&amp;modif=validerSupprEtab&amp;id=$id'>
   Oui</a>&nbsp; &nbsp; &nbsp; &nbsp;
   <a href='index.php?action=listeEtablissements'>Non</a></h5></center>";
=======
   <a href='suppressionEtablissement.php?action=validerSupprEtab&amp;id=$id'>
   Oui</a>&nbsp; &nbsp; &nbsp; &nbsp;
   <a href='listeEtablissements.php?'>Non</a></h5></center>";
>>>>>>> 7c0bab6b4d43e48e6d88592b14883d482f922596:vue/SuppressionEtablissement.php
}

// Cas 2ème étape (on vient de suppressionEtablissement.php)

<<<<<<< HEAD:VUE/SuppressionEtablissement.php
else if ($_REQUEST['modif']=='validerSupprEtab')
=======
else
>>>>>>> 7c0bab6b4d43e48e6d88592b14883d482f922596:vue/SuppressionEtablissement.php
{
   supprimerEtablissement($connexion, $id);
   echo "
   <br><br><center><h5>L'établissement $nom a été supprimé</h5>
<<<<<<< HEAD:VUE/SuppressionEtablissement.php
   <a href='index.php?action=listeEtablissements'>Retour</a></center>";
}
?>
<?php $contenu = ob_get_clean();
 require './VUE/Template.php'; ?>
<?= $contenu ?>
=======
   <a href='listeEtablissements.php?'>Retour</a></center>";
}
$contenu = ob_get_clean ();

require 'Vuetemplate.php';

echo $contenu
?>
>>>>>>> 7c0bab6b4d43e48e6d88592b14883d482f922596:vue/SuppressionEtablissement.php
