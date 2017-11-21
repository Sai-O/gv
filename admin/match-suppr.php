<?php 
session_start();
require_once('../configs/connexion.php');



try{
	if(isset($_GET['id'])){
		$stmt = $bdd->prepare("DELETE FROM `match` WHERE id=:id");
		$stmt->bindparam(":id",$_GET['id']);
		$stmt->execute();

		$_SESSION['info'] = ' Le match a bien été supprimé.';
		header('location:matchs.php');
		exit();
	}
}


catch(PDOException $e)
  {
  
  	$_SESSION['info'] = $e->getMessage(); 
  	header('location:matchs.php');
  	exit();


  }



 ?>