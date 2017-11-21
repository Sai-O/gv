<?php 
session_start();
require_once('../configs/connexion.php');

/*
var_dump($_POST);
die();*/
$date = new DateTime($_POST['inputdate']);
$dateD = $date->format('Y-m-d');

$etat = $_POST['etat'];
$score1 = 255;
$score2 = 255;
if ($etat == 1) {
	$score1 = $_POST['score1'];
	$score2 = $_POST['score2'];
}


try{
	$stmt = $bdd->prepare("INSERT INTO `match` (championnat_id, equipe1, equipe2, journee ,date, heure, etat, score1, score2) 
								VALUES( :championnat_id, :equipe1, :equipe2, :journee, :date, :heure, :etat, :score1, :score2 )");
	$stmt->bindparam(":championnat_id",$_POST['championnat_id']);
	$stmt->bindparam(":equipe1",$_POST['equipe1']);
	$stmt->bindparam(":equipe2",$_POST['equipe2']);
	$stmt->bindparam(":journee",$_POST['journee']);
	$stmt->bindparam(":date",$dateD);
	$stmt->bindparam(":heure",$_POST['heure']);
	$stmt->bindparam(":etat",$etat);
	$stmt->bindparam(":score1",$score1);
	$stmt->bindparam(":score2",$score2);
	$stmt->execute();

	$_SESSION['info'] = 'Un nouveau match a bien été ajouté.';
	header('location:matchs.php');
	exit();

}


catch(PDOException $e)
  {
  
  	$_SESSION['info'] = $e->getMessage(); 
  	header('location:matchs.php');
  	exit();


  }



 ?>