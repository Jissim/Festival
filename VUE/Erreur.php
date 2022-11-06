<?php $titre = 'Accueil';

ob_start();
?>
<p>Une erreur est survenue : <?= $msgErreur ?></p>

<?php $contenu = ob_get_clean();

require 'Template.php'; 

?>