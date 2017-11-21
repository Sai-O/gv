<?php 

try
{
	//Local
	$bdd = new PDO('mysql:host=localhost;dbname=goussainville;charset=utf8', 'root', '');
	// Prod
	//$bdd = new PDO('mysql:host=localhost;dbname=h4090_gv;charset=utf8', 'h4090', '5ZQI7tqN');
}
catch(Exception $e)
{
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}
 ?>