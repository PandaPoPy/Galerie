<?php
require_once('init.php');

$nom_page = 'accueil';

require_once('header.php');
?>
	<div class="gallery">
	<?php
// extraction de la page actuelle
// approche par array_chunk()
/*$liste_pages = array_chunk($images, $config['images_par_page']);
$images = $liste_pages[$page];*/

	
	//calcul du nombre d'images:
	$nb_images=get_images_count();
	echo '<div>Nombre Images= '.$nb_images.'</div>'.PHP_EOL;

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
				<a href="image.php?id='.$img['id'].'&amp;refpage='.($page+1).'"><img
src="'.$config['dossier_images'].'/'.$img['fichier'].'" alt="Image '.$img['fichier'].'"
width="150"/></a>
			</div>'.PHP_EOL;
	}

/*// récupérer les fichiers images de la bdd
$images_liste=get_images_liste();
//echo ps_dump($images_liste).PHP_EOL;*/

?>
</div>
<?= menu_pagination($page + 1, $nb_pages); ?>

<?php require_once('footer.php');