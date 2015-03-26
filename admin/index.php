<?php

require_once('init.php');

$nom_page = 'accueil';
require_once('header.php');

// listing des images
$nb_pages = get_page_count();

// on récupère le numéro de page souhaité
if(isset($_GET['page']) && is_numeric($_GET['page'])) {
    if($_GET['page'] < 1) {
        $page = 0;
    } elseif($_GET['page'] > $nb_pages) {
        $page = $nb_pages - 1;
    } else {
        $page = $_GET['page'] - 1;
    }
} else {
    $page = 0;
}

$images = get_images_from_page($page);

// pour chaque image de la liste d’images,
echo '<table><tr><th>ID</th><th>Image</th><th>Nom</th><th>Auteur</th><th>Date</th><th>Édition</th></tr>'.PHP_EOL;
foreach($images as $image) {
    $date = new DateTime($image['date']);
    echo '<tr><td>'.$image['id'].'</td>
          <td><img width="150" src="../'.$config['dossier_images'].'/mini/'.$image['fichier'].'" alt="'.$image['titre'].'" /></td>
          <td>'.$image['titre'].'</td>
          <td>'.$image['auteur'].'</td>
          <td>'.$date->format('d/m/Y H:i:s').'</td>
          <td><a href="update.php?id='.$image['id'].'">✎</a> <a href="delete.php?id='.$image['id'].'">✗</a></td>
          </tr>'.PHP_EOL;
}
echo '</table>'.PHP_EOL;

echo menu_pagination($page + 1, $nb_pages);

require_once('footer.php');