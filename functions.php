<?php

/**
* Renvoie le nombre d'images présentes en base
* @return int
*/
function get_images_count() {
	global $db;
	$images_count_query = $db->query('SELECT COUNT(id) FROM image');
	$images_count = $images_count_query->fetchColumn();
	return $images_count;
}

/**
* Renvoie le nombre de pages correspondant au nombre d’images en base
* @return int
*/
function get_page_count() {
	global $config;
	$images_count = get_images_count();
	$page_count = ceil($images_count / $config['images_par_page']);
	return $page_count;
}

/**
* Renvoie la liste de news correspondant à une page donnée
* @param int $page le numéro de page souhaité (commençant par 0)
* @return PDOStatement la liste des news, contenant les colonnes id, titre,
* image, auteur, extrait, date
*/
function get_images_from_page($page) {
	global $config, $db;
	$offset = $page * $config['images_par_page'];
	$images_select = $db->query('SELECT id, titre, fichier, auteur, description, date FROM image ORDER BY date DESC LIMIT '.$offset.','.$config['images_par_page']);
	return $images_select;
}

/**
 * Crée un menu HTML permettant de naviguer entre les pages
 * @param int $page le numéro de la page courante
 * @param int $page_count le nombre de pages
 * @return string le HTML correspondant au menu
 */
function menu_pagination($page, $page_count) {
    $html = '<ul class="menu">'.PHP_EOL;
    for($i = 1; $i <= $page_count; $i++) {
        if($i == $page) {
            $html .= '<li><strong>'.$i.'</strong></li>'.PHP_EOL;
        } else {
            $html .= '<li><a href="?page='.$i.'">'.$i.'</a></li>'.PHP_EOL;
        }
    }
    $html .= '</ul>'.PHP_EOL;
    return $html;
}

/**
 * Retourne une image identifiée par son ID, ou false si elle n’existe pas
 * @param int $id
 * @return array le tableau associatif représentant l’image, comprenant les clés
 * id, titre, description, date, fichier, auteur
 */
function get_image($id) {
    global $db;
    $image = $db->query('SELECT id,titre,description,date,fichier,auteur FROM image WHERE id = '.$db->quote($id))->fetch();
    return $image;
}


/**
 * Indique si le client est authentifié en tant qu’administrateur, selon sa 
 * session.
 * @return bool
 */
function is_admin() {
    return (isset($_SESSION['admin']) && $_SESSION['admin']);
}

/** Filtre les images selon leur terminaison*/
/*function filtre_images($valeur) {
// si l’extension de $valeur est comprise dans le tableau des extensions
// autorisées
return in_array(strtolower(strrchr($valeur, '.')),
['.jpg', '.jpeg', '.png', '.svg', '.gif']);
}
*/
/*// récupérer les fichiers images de la bdd
function get_images_liste(){
	global $db;
	$lecture_images=$db->query('SELECT id, titre, fichier, auteur, description, date FROM image');
	return $lecture_images;
}*/
/**
* Récupère les dernières news du site
* @param int $count le nombre de news à récupérer
* @return PDOStatement la liste des news, contenant les colonnes id, titre,
* image, auteur, extrait, date
*/
/*function get_last_news($count) {
global $db;
$liste_articles = $db->query('SELECT id, titre, image, auteur, extrait, date FROM news ORDER BY date DESC LIMIT '.$count);
return $liste_articles;
}*/
/**
* Récupère une news à partir de son ID
* @param int $id l’identifiant de la news
* @return array|false un tableau représentant la news, contenant les clés id, titre,
* texte, image, auteur, extrait, date ; ou false si la news n’existe pas
*/
/*function get_news($id) {
global $db;
$news = $db->query('SELECT id, titre, texte, image, auteur, extrait, date FROM news WHERE id = '.$db->quote($id))->fetch();
return $news;
}
*/
/**
* Affiche une représentation sous forme de tableau HTML d’un objet PDOStatement
* @param PDOStatement $ps un objet issu d’une requête
*/
/*function ps_dump($ps) {
echo '<table border="1">'.PHP_EOL;
foreach($ps as $num => $ligne) {
if($num == 0) {
echo '<tr>'.PHP_EOL;
foreach($ligne as $header => $_) {
echo '<th>'.$header.'</th>';
}
echo '</tr>';
}
echo '<tr>'.PHP_EOL;
foreach($ligne as $valeur) {
echo '<td>'.$valeur.'</td>'.PHP_EOL;
}
echo '</tr>'.PHP_EOL;
}
echo '</table>'.PHP_EOL;
}*/
?>