<?php 
session_start();
require_once('../configs/connexion.php');


try{
	$stmt = $bdd->prepare("UPDATE equipe SET name=:name, championnat_id=:championnat_id, description_short=:description_short, description=:description WHERE id=:id");
	
	$stmt->bindparam(":name",$_POST['name']);
	$stmt->bindparam(":championnat_id",$_POST['championnat_id']);
	$stmt->bindparam(":description_short",$_POST['description_short']);
	$stmt->bindparam(":description",$_POST['description']);
	$stmt->bindparam(":id",$_POST['inputIdh']);
	$stmt->execute();

	$_SESSION['info'] = 'l\'équipe '.$_POST['name'].' bien été modifiée.';
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