<?php 

try {
	$bdd = new PDO('mysql:host=localhost;dbname=nandb3','root', 'root');
} catch(Exception $e) {
	exit('Impossible de se connecter à la base de données <br>'.$e);
} 

?>