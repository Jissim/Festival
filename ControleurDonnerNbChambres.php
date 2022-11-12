<?php

require 'Modele.php';

try {
    if (isset($_GET['idEtab'])) {
        // intval renvoie la valeur numérique du paramètre ou 0 en cas d'échec
        $idEtab = intval($_GET['idEtab']);
        if ($idEtab != 0) {
            $billet = getBillet($id);
            $commentaires = getCommentaires($id);
            require 'vueBillet.php';
        } else
            throw new Exception("Identifiant de billet incorrect");
    } else
        throw new Exception("Aucun identifiant de billet");
} catch (Exception $e) {
    $msgErreur = $e->getMessage();
    require 'vueErreur.php';
}
