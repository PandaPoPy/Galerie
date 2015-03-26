<?php
/**
 * Cette page permet d’afficher les détails d’une image
 *
 * @author popy
 * @version 1.0
 * @copyright (C) 2015 popy <https://github.com/Popy33>
 * @license MIT
 */

require_once('init.php');

if(isset($_GET['id'])) {
    $image = get_image($_GET['id']);
    if($image) {
        $date = new DateTime($image['date']);
        $contenu = '<div class="image"><p><img src="'.$config['dossier_images'].'/'.$image['fichier'].'" alt="'.$image['titre'].'" /></p>
            <h2>'.$image['titre'].'</h2>
            <em>Publiée le '.$date->format('d/m/Y à H:i:s').' par '.$image['auteur'].'</em>
            <p>'.$image['description'].'</p></div>';
        $nom_page = $image['titre'];
    } else {
        $contenu = '<p>Cette image n’existe pas.</p>';
        $nom_page = 'Erreur';
    }
} else {
    $contenu = '<p>Veuillez choisir une image</p>';
    $nom_page = 'Erreur';
}

require_once('header.php');

echo $contenu;

if(isset($_GET['refpage']) && is_numeric($_GET['refpage'])) {
    $refpage = htmlspecialchars($_GET['refpage']);
} else {
    $refpage = 1;
}
?>
    <p><a href="index.php?page=<?= $refpage ?>">Retour</a></p>
</body>
</html>

