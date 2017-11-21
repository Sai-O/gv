<?php 
session_start();
require_once('../configs/connexion.php');

//championnat id
$ch_id = intval($_GET['ch']);


$nb_equipes = $bdd->query("SELECT COUNT(*) FROM equipe WHERE championnat_id='$ch_id' ")->fetchColumn();

// si impaire on ajoute l'equipe Exempt à ce championnat et $nb_equipes+=1
if ($nb_equipes % 2 == 1){
	$bdd->exec("INSERT INTO `equipe`(championnat_id,name) VALUES('$ch_id','Anonyme')");
	$nb_equipes+= 1;
}

// on récupère les ids des équipes pour crée le tableau $teams_array
$equipes = $bdd->query("SELECT id FROM equipe where championnat_id ='$ch_id' ")->fetchAll();
$teams_array=array();
foreach ($equipes as $equipe) {
	array_push($teams_array, $equipe['id']);
}

//On importe la variable $all_matchs contenu dans le fichier matrice du championnat au bon nombre d'équipe.
require('pages/all_matchs'.$nb_equipes.'.php');


//on supprime les matchs non joués(à venir)
$bdd->exec("DELETE FROM `match` where championnat_id ='$ch_id' AND etat=0");


//on boucle sur les matchs des journées
foreach ($all_matchs as $j_nbr => $j_matchs) {
	foreach ($j_matchs as $match) {


		$int_j_nbr 	= intval($j_nbr);
		$equipe1_id = intval($teams_array[$match[0]-1]);
		$equipe2_id = intval($teams_array[$match[1]-1]);
		$zero=0;

		//Si le match a déja été joué dans le passé on passe au match suivant
		$match_played = $bdd->query("SELECT COUNT(*) FROM `match`
							WHERE championnat_id='$ch_id'
							AND equipe1 ='$equipe1_id'
							AND equipe2 ='$equipe2_id'
							")->fetchColumn();
		if($match_played>0){continue;}

		//Sinon on insère le match en base
		try{
			$stmt = $bdd->prepare("INSERT INTO `match` (championnat_id, equipe1, equipe2, journee , etat, score1, score2) 
								VALUES( :championnat_id, :equipe1, :equipe2, :journee,   :etat, :score1, :score2 )");
			$stmt->bindparam(":championnat_id",$ch_id);
			$stmt->bindparam(":equipe1",$equipe1_id);
			$stmt->bindparam(":equipe2",$equipe2_id);
			$stmt->bindparam(":journee",$int_j_nbr);

			$stmt->bindparam(":etat", $zero);
			$stmt->bindparam(":score1",$zero);
			$stmt->bindparam(":score2",$zero);
			$stmt->execute();
		}
		catch(PDOException $e)
		{
		  	echo "<br>Error<br>";
		  	$_SESSION['info'] = $e->getMessage(); 
		}
	}
}

$_SESSION['info'] = 'Le calendrier des matchs à été regénéré.';
header('location:classement-afficher.php?id='.$ch_id);	
exit();	

/*
Modifs
Table match > date et heure null
Table equipe

pages/all_matchs8.php

matchs.php
match_modifier.php 			> ajout de select date et select heure
match-modifier-post.php

classement-afficher

https://www.artstation.com/artwork/LOnm0
https://www.artstation.com/artwork/zqnzD
https://www.artstation.com/artwork/PBD61
*/


 ?>