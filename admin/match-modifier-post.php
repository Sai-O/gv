<?php 
session_start();
require_once('../configs/connexion.php');


$date = new DateTime($_POST['inputdate']);
$dateD = $date->format('Y-m-d');


$etat = intval($_POST['etat']);
$score1 = intval($_POST['score1']);
$score2 = intval($_POST['score2']);
$id = intval($_POST['match_id']);
	if ($etat == 0) {
	echo"match score function";
	$score1 = $score2 = null;


	}
	try{

		$stmt = $bdd->prepare("UPDATE `match` SET score1=:score1, score2=:score2, journee=:journee, date=:date, heure=:heure, etat=:etat WHERE id=:id");
		$stmt->bindparam(":score1",$score1);
		$stmt->bindparam(":score2",$score2);
		$stmt->bindparam(":journee", $_POST['journee']);
		$stmt->bindparam(":date", $dateD);
		$stmt->bindparam(":heure", $_POST['heureselect']);
		$stmt->bindparam(":etat", $etat);
		$stmt->bindparam(":id",$id);
		$stmt->execute();
		//die();
		$_SESSION['info'] = 'Un match a bien été modifié';
		header('location:matchs.php');
		exit();
	}

	catch(PDOException $e)
  	{
  
	  	$_SESSION['info'] = $e->getMessage(); 
	  	//header('location:matchs.php');
	  	//exit();


  	}








 ?>