<?php $titre = 'Créer un établissement';

require("Gestion.php"); 
require("ControlesEtGestionErreurs.inc.php");
// CONNEXION AU SERVEUR MYSQL PUIS SÉLECTION DE LA BASE DE DONNÉES festival 
$connexion = getConnexion();

ob_start ();

// CRÉER UN ÉTABLISSEMENT 

// Déclaration du tableau des civilités
$tabCivilite=["M.","Mme","Melle"];  

$action=$_REQUEST['action'];

// S'il s'agit d'une création et qu'on ne "vient" pas de ce formulaire (on 
// "vient" de ce formulaire uniquement s'il y avait une erreur), il faut définir 
// les champs à vide sinon on affichera les valeurs précédemment saisies
if ($action=='demanderCreEtab') 
{  
   $id='';
   $nom='';
   $adresseRue='';
   $ville='';
   $codePostal='';
   $tel='';
   $adresseElectronique='';
   $type=0;
   $civiliteResponsable='Monsieur';
   $nomResponsable='';
   $prenomResponsable='';
   $nombreChambresOffertes='';
}
else
{
   $id=$_REQUEST['id']; 
   $nom=$_REQUEST['nom']; 
   $adresseRue=$_REQUEST['adresseRue'];
   $codePostal=$_REQUEST['codePostal'];
   $ville=$_REQUEST['ville'];
   $tel=$_REQUEST['tel'];
   $adresseElectronique=$_REQUEST['adresseElectronique'];
   $type=$_REQUEST['type'];
   $civiliteResponsable=$_REQUEST['civiliteResponsable'];
   $nomResponsable=$_REQUEST['nomResponsable'];
   $prenomResponsable=$_REQUEST['prenomResponsable'];
   $nombreChambresOffertes=$_REQUEST['nombreChambresOffertes'];

   verifierDonneesEtabC($connexion, $id, $nom, $adresseRue, $codePostal, $ville, 
                        $tel, $nomResponsable, $nombreChambresOffertes);      
   if (nbErreurs()==0)
   {        
      creerEtablissement($connexion, $id, $nom, $adresseRue, $codePostal, $ville,  
                         $tel, $adresseElectronique, $type, $civiliteResponsable, 
                         $nomResponsable, $prenomResponsable, $nombreChambresOffertes);
   }
}

?>

<form method='POST' action='CreationEtablissement.php?'>
   <input type='hidden' value='validerCreEtab' name='action'>
   <table width='85%' align='center' cellspacing='0' cellpadding='0' 
   class='tabNonQuadrille'>
   
      <tr class='enTeteTabNonQuad'>
         <td colspan='3'>Nouvel établissement</td>
      </tr>
      <tr class='ligneTabNonQuad'>
         <td> Id*: </td>
         <td><input type="text" value="<?=$id?>" name="id" size ="10" 
         maxlength='8'></td>
      </tr>
     
      <tr class="ligneTabNonQuad">
         <td> Nom*: </td>
         <td><input type="text" value="<?=$nom?>" name="nom" size="50" 
         maxlength="45"></td>
      </tr>
      <tr class="ligneTabNonQuad">
         <td> Adresse*: </td>
         <td><input type="text" value="<?=$adresseRue?>" name="adresseRue" 
         size="50" maxlength="45"></td>
      </tr>
      <tr class="ligneTabNonQuad">
         <td> Code postal*: </td>
         <td><input type="text" value="<?=$codePostal?>" name="codePostal" 
         size="4" maxlength="5"></td>
      </tr>
      <tr class="ligneTabNonQuad">
         <td> Ville*: </td>
         <td><input type="text" value="<?=$ville?>" name="ville" size="40" 
         maxlength="35"></td>
      </tr>
      <tr class="ligneTabNonQuad">
         <td> Téléphone*: </td>
         <td><input type="text" value="<?=$tel?>" name="tel" size ="20" 
         maxlength="10"></td>
      </tr>
      <tr class="ligneTabNonQuad">
         <td> E-mail: </td>
         <td><input type="text" value="<?=$adresseElectronique?>" name=
         "adresseElectronique" size ="75" maxlength="70"></td>
      </tr>
      <tr class="ligneTabNonQuad">
         <td> Type*: </td>
         <td>

            <?php

            if ($type==1)
            {
               ?>

               <input type='radio' name='type' value='1' checked>  
               Etablissement Scolaire
               <input type='radio' name='type' value='0'>  Autre

               <?php

             }
             else
             {

               ?>
                
                <input type='radio' name='type' value='1'> 
                Etablissement Scolaire
                <input type='radio' name='type' value='0' checked> Autre
               
               <?php

              }

            ?>

           </td>
         </tr>
         <tr class='ligneTabNonQuad'>
            <td colspan='2' ><strong>Responsable:</strong></td>
         </tr>
         <tr class='ligneTabNonQuad'>
            <td> Civilité*: </td>
            <td> <select name='civiliteResponsable'>

              <?php

               for ($i=0; $i<3; $i=$i+1)
                  if ($tabCivilite[$i]==$civiliteResponsable) 
                  {

                     ?>
                     <option selected><?=$tabCivilite[$i]?></option>
                     
                  <?php

                  }
                  else
                  {

                     ?>
                     <option><?=$tabCivilite[$i]?></option>

                  <?php

                  }

               ?>
               
               </select>&nbsp; &nbsp; &nbsp; &nbsp; Nom*: 
               <input type="text" value="<?=$nomResponsable?>" name=
               "nomResponsable" size="26" maxlength="25">
               &nbsp; &nbsp; &nbsp; &nbsp; Prénom: 
               <input type="text"  value="<?=$prenomResponsable?>" name=
               "prenomResponsable" size="26" maxlength="25">
            </td>
         </tr>
          <tr class="ligneTabNonQuad">
            <td> Nombre chambres offertes*: </td>
            <td><input type="text" value="<?=$nombreChambresOffertes?>" name=
            "nombreChambresOffertes" size ="2" maxlength="3"></td>
         </tr>
   </table>
   
 
   <table align='center' cellspacing='15' cellpadding='0'>
      <tr>
         <td align='right'><input type='submit' value='Valider' name='valider'>
         </td>
         <td align='left'><input type='reset' value='Annuler' name='annuler'>
         </td>
      </tr>
      <tr>
         <td colspan='2' align='center'><a href='ListeEtablissements.php'>Retour</a>
         </td>
      </tr>
   </table>
</form>

<?php

// En cas de validation du formulaire : affichage des erreurs ou du message de 
// confirmation
if ($action=='validerCreEtab')
{
   if (nbErreurs()!=0)
   {
      afficherErreurs();
   }
   else
   {
      ?>
      <h5><center>La création de l'établissement a été effectuée</center></h5>

   <?php

   }
}
$contenu = ob_get_clean ();

require 'Template.php';

?>
