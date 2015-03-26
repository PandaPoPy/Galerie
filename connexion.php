<?php
require_once('init.php');

$nom_page = 'connexion';

if(isset($_POST['password'])) {
    if(password_verify($_POST['password'], $config['admin_password'])) {
        // authentification OK
        $_SESSION['admin'] = true;
    } else {
        // authentification KO
        $erreur = 'Mot de passe incorrect.';
    }
}

if(isset($_GET['deconnexion'])) {
    $_SESSION = [];
    header('Location: index.php');
    die();
}

if(is_admin()) {
    header('Location: admin/');
    die();
}

require_once('header.php');

?>
<form method="post">
<?php
if(isset($erreur)) {
    echo '<p class="error">'.$erreur.'</p>';
}
?>
    <div><label for="id_password">Mot de passe d’administration :</label>
         <input type="password" name="password" id="id_password" />
    </div>
    <div><input type="submit" value="Connexion" /></div>
</form>
<?php

/*require_once('footer.php');*/

