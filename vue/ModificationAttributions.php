<?php $titre = 'Attribution des chambres';

require("Gestion.php");
require("ControlesEtGestionErreurs.inc.php");
// CONNEXION AU SERVEUR MYSQL PUIS SÉLECTION DE LA BASE DE DONNÉES festival 
$connexion = getConnexion();

ob_start();

?>
<table width='80%' cellpadding='0' cellspacing='0' align='center'>
   <tr>
      <td align='center'><a href='index.php'>Accueil > </a><a href='ConsultationAttributions.php'>Consultation Attributions > <a href='ModificationAttributions.php'>Modification Attributions</td>
   </tr>
</table>

<?php
// EFFECTUER OU MODIFIER LES ATTRIBUTIONS POUR L'ENSEMBLE DES ÉTABLISSEMENTS

// CETTE PAGE CONTIENT UN TABLEAU CONSTITUÉ DE 2 LIGNES D'EN-TÊTE (LIGNE TITRE ET 
// LIGNE ÉTABLISSEMENTS) ET DU DÉTAIL DES ATTRIBUTIONS 
// UNE LÉGENDE FIGURE SOUS LE TABLEAU

// Recherche du nombre d'établissements offrant des chambres pour le 
// dimensionnement des colonnes
$nbEtabOffrantChambres = obtenirNbEtabOffrantChambres($connexion);
$nb = $nbEtabOffrantChambres + 1;
// Détermination du pourcentage de largeur des colonnes "établissements"
$pourcCol = 50 / $nbEtabOffrantChambres;

$action = $_REQUEST['action'];

// Si l'action est validerModifAttrib (cas où l'on vient de la page 
// donnerNbChambres.php) alors on effectue la mise à jour des attributions dans 
// la base 
if ($action == 'validerModifAttrib') {
   $idEtab = $_REQUEST['idEtab'];
   $idGroupe = $_REQUEST['idGroupe'];
   $nbChambres = $_REQUEST['nbChambres'];
   modifierAttribChamb($connexion, $idEtab, $idGroupe, $nbChambres);
}

?>
<br>
<table width='80%' cellspacing='0' cellpadding='0' align='center' class='tabQuadrille'>

   <!-- AFFICHAGE DE LA 1ÈRE LIGNE D'EN-TÊTE -->
   <tr class='enTeteTabQuad'>
      <td colspan=<?= $nb ?>><strong>Attributions</strong></td>
   </tr>

   <!-- AFFICHAGE DE LA 2ÈME LIGNE D'EN-TÊTE (ÉTABLISSEMENTS) -->
   <tr class='ligneTabQuad'>
      <td>&nbsp;</td>

      <?php

      $sql = obtenirReqEtablissementsOffrantChambres();
      // $rsEtab=mysql_query($req, $connexion);
      $rsEtab = $connexion->query($sql);
      // $lgEtab=mysql_fetch_array($rsEtab);
      $lgEtab = $rsEtab->fetch(PDO::FETCH_ASSOC);

      // Boucle sur les établissements (pour afficher le nom de l'établissement et 
      // le nombre de chambres encore disponibles)
      while ($lgEtab != FALSE) {
         $idEtab = $lgEtab["id"];
         $nom = $lgEtab["nom"];
         $nbOffre = $lgEtab["nombreChambresOffertes"];
         $nbOccup = obtenirNbOccup($connexion, $idEtab);

         // Calcul du nombre de chambres libres
         $nbChLib = $nbOffre - $nbOccup;

      ?><td valign='top' width='$pourcCol%'><i>Disponibilités : <?= $nbChLib ?> </i> <br>
            <?= $nom ?> </td>

      <?php

         //$lgEtab=mysql_fetch_array($rsEtab);
         $lgEtab = $rsEtab->fetch(PDO::FETCH_ASSOC);
      }

      ?>
   </tr>

   <?php
   // CORPS DU TABLEAU : CONSTITUTION D'UNE LIGNE PAR GROUPE À HÉBERGER AVEC LES 
   // CHAMBRES ATTRIBUÉES ET LES LIENS POUR EFFECTUER OU MODIFIER LES ATTRIBUTIONS

   $sql = obtenirReqIdNomGroupesAHeberger();
   //$rsGroupe=mysql_query($req, $connexion);
   $rsGroupe = $connexion->query($sql);
   //$lgGroupe=mysql_fetch_array($rsGroupe);
   $lgGroupe = $rsGroupe->fetch(PDO::FETCH_ASSOC);

   // BOUCLE SUR LES GROUPES À HÉBERGER 
   while ($lgGroupe != FALSE) {
      $idGroupe = $lgGroupe['id'];
      $nom = $lgGroupe['nom'];

   ?><tr class='ligneTabQuad'>
         <td width='25%'><?= $nom ?></td>

         <?php

         $sql = obtenirReqEtablissementsOffrantChambres();
         //$rsEtab=mysql_query($req, $connexion);
         $rsEtab = $connexion->query($sql);
         //$lgEtab=mysql_fetch_array($rsEtab);
         $lgEtab = $rsEtab->fetch(PDO::FETCH_ASSOC);

         // BOUCLE SUR LES ÉTABLISSEMENTS
         while ($lgEtab != FALSE) {
            $idEtab = $lgEtab["id"];
            $nbOffre = $lgEtab["nombreChambresOffertes"];
            $nbOccup = obtenirNbOccup($connexion, $idEtab);

            // Calcul du nombre de chambres libres
            $nbChLib = $nbOffre - $nbOccup;

            // On recherche si des chambres ont déjà été attribuées à ce groupe
            // dans cet établissement
            $nbOccupGroupe = obtenirNbOccupGroupe($connexion, $idEtab, $idGroupe);

            // Cas où des chambres ont déjà été attribuées à ce groupe dans cet
            // établissement
            if ($nbOccupGroupe != 0) {
               // Le nombre de chambres maximum pouvant être demandées est la somme 
               // du nombre de chambres libres et du nombre de chambres actuellement 
               // attribuées au groupe (ce nombre $nbmax sera transmis si on 
               // choisit de modifier le nombre de chambres)
               $nbMax = $nbChLib + $nbOccupGroupe;

         ?><td class='reserve'>
                  <a href='DonnerNbChambres.php?idEtab=<?= $idEtab ?>&amp;idGroupe=<?= $idGroupe ?>&amp;nbChambres=<?= $nbMax ?>'>
                     <?= $nbOccupGroupe ?></a>
               </td>

               <?php

            } else {
               // Cas où il n'y a pas de chambres attribuées à ce groupe dans cet 
               // établissement : on affiche un lien vers donnerNbChambres s'il y a 
               // des chambres libres sinon rien n'est affiché     
               if ($nbChLib != 0) {

               ?><td class='reserveSiLien'>
                     <a href='DonnerNbChambres.php?idEtab=<?= $idEtab ?>&amp;idGroupe=<?= $idGroupe ?>&amp;nbChambres=<?= $nbChLib ?>'>
                        __</a>
                  </td>

               <?php

               } else {
               ?><td class='reserveSiLien'>&nbsp;</td>

      <?php
               }
            }
            //$lgEtab=mysql_fetch_array($rsEtab);
            $lgEtab = $rsEtab->fetch(PDO::FETCH_ASSOC);
         } // Fin de la boucle sur les établissements    
         //$lgGroupe=mysql_fetch_array($rsGroupe); 
         $lgGroupe = $rsGroupe->fetch(PDO::FETCH_ASSOC);
      } // Fin de la boucle sur les groupes à héberger

      ?>
</table> <!-- Fin du tableau principal -->

<!-- AFFICHAGE DE LA LÉGENDE -->

<table align='center' width='80%'>
   <tr>
      <td width='34%' align='left'><a href='ConsultationAttributions.php'>Retour</a>
      </td>
      <td class='reserveSiLien'>&nbsp;</td>
      <td width='30%' align='left'>Réservation possible si lien</td>
      <td class='reserve'>&nbsp;</td>
      <td width='30%' align='left'>Chambres réservées</td>
   </tr>
</table>

<?php

$contenu = ob_get_clean();

require 'Template.php';

?>