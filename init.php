<?php
require_once('config.php');
require_once('functions.php');
$dsn=$config['dsn'];
$user=$config['user'];
$password=$config['mysql_pwd'];
try {
$db = new PDO($dsn, $user, $password);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
die ('Connection failed: ' . $e->getMessage());
}
?>