<?php 
session_start();
require_once('../configs/connexion.php');

/*$date = new DateTime($_POST['inputdateD']);
$dateD = $date->format('Y-m-d HH:MM:SS');*/

try{
	$stmt = $bdd->prepare("INSERT INTO equipe(name,championnat_id,description_short,description) 
								VALUES(:name, :championnat_id, :description_short, :description)");
	$stmt->bindparam(":name",$_POST['name']);
	$stmt->bindparam(":championnat_id",$_POST['championnat_id']);
	$stmt->bindparam(":description_short",$_POST['description_short']);
	$stmt->bindparam(":description",$_POST['description']);
	$stmt->execute();

	$_SESSION['info'] = 'Une nouvelle equipe a bien été ajouté.';
	header('location:equipes.php');
	exit();

}


catch(PDOException $e)
  {
  
  	$_SESSION['info'] = $e->getMessage(); 
  	header('location:equipes.php');
  	exit();


  }



 ?>