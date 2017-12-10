<?php

try
{
	//Local
	$bdd = new PDO('mysql:host=localhost;dbname=uaff;charset=utf8', 'root', '31102008');
	// Prod
	//voir gv2017-11
}
catch(Exception $e)
{
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}
 ?>
