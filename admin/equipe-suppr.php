<?php 
session_start();
require_once('../configs/connexion.php');



try{
	$stmt = $bdd->prepare("DELETE FROM equipe WHERE id=:id");
	$stmt->bindparam(":id",$_GET['id']);
	$stmt->execute();

	$_SESSION['info'] = ' L\'équipe a bien été supprimé.';
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