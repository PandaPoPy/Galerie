<?php
require_once('init.php');
require_once('functions.php');
?>
<!DOCTYPE html>
<html>
<head>
<title><?= $config['nom_site'] ?> : accueil</title>
<link rel="stylesheet" href="galerie.css"/>
<meta charset="utf-8" />
</head>
<body>
<h1><?= $config['nom_site'] ?> : accueil</h1>
<div class="gallery">
<?php
// extraction de la page actuelle
// approche par array_chunk()
/*$liste_pages = array_chunk($images, $config['images_par_page']);
$images = $liste_pages[$page];*/
// récupérer les fichiers images de la bdd
$images_liste=get_images_liste();
//echo ps_dump($images_liste).PHP_EOL;
//calcul du nombre d'images:
$nb_images=get_images_count();
echo '<div>Nombre Images= '.$nb_images.'</div>'.PHP_EOL;
//calcul du nombre de pages créées:
$nb_pages=get_page_count();
echo '<div>Nombre pages= '.$nb_pages.'</div>'.PHP_EOL;
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
// approche par array_slice()
$images_affichees=get_images_from_page($page);
//echo ps_dump($images_affichees);
// pour chaque image de la liste d’images,
foreach($images_affichees as $img) {
// afficher le HTML correspondant à une image
echo '<div class="image">
<a href="image.php?name='.$img['fichier'].'&amp;refpage='.($page+1).'"><img
src="'.$config['dossier_images'].'/'.$img['fichier'].'" alt="Image '.$img['fichier'].'"
width="150"/></a>
</div>'.PHP_EOL;
}
?>
</div>
<ul class="navigation">
<?php
// sélecteur de pages
$page_affichage = $page + 1;
if($page_affichage > 1) {
echo '<li><a href="?page='.($page_affichage-1).'">← Précédent</a></li>'.PHP_EOL;
}
// affichage des différents liens par page
for($num_page = 1; $num_page <= $nb_pages; $num_page++) {
if($num_page == $page_affichage) {
echo '<li><strong>'.$num_page.'</strong></li>'.PHP_EOL;
} else {
echo '<li><a href="?page='.$num_page.'">'.$num_page.'</a></li>'.PHP_EOL;
}
}
if($page_affichage < $nb_pages) {
echo '<li><a href="?page='.($page_affichage+1).'">Suivante →</a></li>'.PHP_EOL;
}
?>
</ul>
</body>
</html>
