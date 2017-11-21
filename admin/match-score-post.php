<?php 
session_start();
require_once('../configs/connexion.php');

$slug = $_POST['slug'];

if ($slug == "one match") {
	echo"match score function";
	$id = $_POST['match_id'];
	$score1 = intval($_POST['score1']);
	$score2 = intval($_POST['score2']);
	$etat =1;
	try{

		$stmt = $bdd->prepare("UPDATE `match` SET score1=:score1, score2=:score2, etat=:etat WHERE id=:id");
		$stmt->bindparam(":score1",$score1);
		$stmt->bindparam(":score2",$score2);
		$stmt->bindparam(":etat", $etat);
		$stmt->bindparam(":id",$id);
		$stmt->execute();

		$_SESSION['info'] = 'Un match a bien été scoré';
		header('location:matchs.php');
		exit();
	}


	catch(PDOException $e)
  	{
  
	  	$_SESSION['info'] = $e->getMessage(); 
	  	//header('location:matchs.php');
	  	//exit();


  	}

}

 ?>