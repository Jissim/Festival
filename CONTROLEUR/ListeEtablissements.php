<!-- Manque encore le php -->
<?php $titre = 'Liste des établissements';

require("./MODELE/Gestion.php"); 
require("./CONTROLEUR/ControlesEtGestionErreurs.inc.php");
// CONNEXION AU SERVEUR MYSQL PUIS SÉLECTION DE LA BASE DE DONNÉES festival 
$connexion = getConnexion();

ob_start ();
// AFFICHER L'ENSEMBLE DES ÉTABLISSEMENTS
// CETTE PAGE CONTIENT UN TABLEAU CONSTITUÉ D'1 LIGNE D'EN-TÊTE ET D'1 LIGNE PAR
// ÉTABLISSEMENT

echo "
<table width='70%' cellspacing='0' cellpadding='0' align='center' 
class='tabNonQuadrille'>
   <tr class='enTeteTabNonQuad'>
      <td colspan='4'>Etablissements</td>
   </tr>";
     
   // remplacement des req par sql
   $sql=obtenirReqEtablissements();
   // $rsEtab=mysql_query($sql, $connexion); adaptation à la methode pdo
   $sth=connect()->query($sql); 
   // $lgEtab=mysql_fetch_array($rsEtab); remplacement de tous les lgEtab par result
   $lgEtab=$sth->fetch(PDO::FETCH_ASSOC);
   // BOUCLE SUR LES ÉTABLISSEMENTS
   while ($lgEtab!=FALSE)
   {
      $id=$lgEtab['id'];
      $nom=$lgEtab['nom'];
      echo "
		<tr class='ligneTabNonQuad'>
         <td width='52%'>$nom</td>
         
         <td width='16%' align='center'> 
         <a href='detailEtablissement.php?id=$id'>
         Voir détail</a></td>
         
         <td width='16%' align='center'> 
         <a href='modificationEtablissement.php?action=demanderModifEtab&amp;id=$id'>
         Modifier</a></td>";
      	
         // S'il existe déjà des attributions pour l'établissement, il faudra
         // d'abord les supprimer avant de pouvoir supprimer l'établissement
			if (!existeAttributionsEtab($connexion, $id))
			{
            echo "
            <td width='16%' align='center'> 
            <a href='suppressionEtablissement.php?action=demanderSupprEtab&amp;id=$id'>
            Supprimer</a></td>";
         }
         else
         {
            $attribution=obtenirNbOccup($connexion, $id);
            echo "
            <td width='16%'>&nbsp;$attribution chambres</td>";          
			}
			echo "
      </tr>";
      // $lgEtab=mysql_fetch_array($rsEtab);
      $lgEtab=$sth->fetch(PDO::FETCH_ASSOC);
   }   
   echo "
   <tr class='ligneTabNonQuad'>
      <td colspan='4'><a href='creationEtablissement.php?action=demanderCreEtab'>
      Création d'un établissement</a ></td>
  </tr>
</table>";
$contenu = ob_get_clean ();

require 'Vuetemplate.php';

echo $contenu
?>
