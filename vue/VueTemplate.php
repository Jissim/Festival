<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" 
"http://www.w3.org/TR/html4/loose.dtd">
<!-- TITRE ET MENUS -->
<html lang="fr">
<head>
<title><?= $titre ?></title> <!-- Element spécifique -->
<meta http-equiv="Content-Language" content="fr">
<meta http-equiv="Content-Type" content="²text/html; charset=utf-8">
<link href="cssGeneral.css" rel="stylesheet" type="text/css">
</head>
<body class="basePage">

<!--Tableau contenant le titre -->
<table width="100%" cellpadding="0" cellspacing="0">
   <tr> 
      <td class="titre">Festival Folklores du Monde <br>
      <span id="texteNiveau2" class="texteNiveau2">
      H&eacute;bergement des groupes</span><br>&nbsp;
      </td>
   </tr>
</table> 

<!--  Tableau contenant les menus -->
<table width="80%" cellpadding="0" cellspacing="0" class="tabMenu" align="center">
   <tr>
<<<<<<< HEAD:VUE/Template.php
      <td class="menu"><a href="index.php">Accueil</a></td>
      <td class="menu"><a href="index.php?change=Gestion_eta">
      Gestion établissements</a></td>
      <td class="menu"><a href="index.php?change=Attri_chambre">
=======
      <td class="menu"><a href="./VUE/Accueil.php">Accueil</a></td>
      <td class="menu"><a href="/CONTROLEUR/listeEtablissements.php">
      Gestion établissements</a></td>
      <td class="menu"><a href="/CONTROLEUR/ConsultationAttributions.php">
>>>>>>> 7c0bab6b4d43e48e6d88592b14883d482f922596:vue/VueTemplate.php
      Attributions chambres</a></td>
   </tr>
</table>
<br> 
<?php
echo $contenu 
?>