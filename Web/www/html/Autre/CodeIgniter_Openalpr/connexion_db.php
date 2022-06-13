<?php
/* Connexion à une base MySQL avec l'invocation de pilote */
$dsn = 'mysql:dbname=testdb;host=172.16.151.180';
$user = 'openalpr';
$password = '';

$dbh = new PDO($dsn, $user, $password);
if($dbh){
echo "connecte";
}
?>

