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
<p><a href="connexion.php"><small>Administration</small></a></p>
</body>
</html>