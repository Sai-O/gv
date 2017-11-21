<?php 
session_start();
require_once('../configs/connexion.php');




// ================ AJOUTER ===================
if($_POST['type']=="ajouter"){

	$date = new DateTime();
	$dateD = $date->format('Y-m-d');


	$active=0;
	if(isset($_POST['active']) ){$active=1;}

	$top=0;
	if(isset($_POST['top']) ){$top=1;}

	try{
		$stmt = $bdd->prepare("INSERT INTO article(title,content,auteur,active,created,top) 
									VALUES(:title, :content,:auteur, :active, :created, :top)");
		$stmt->bindparam(":title",$_POST['titre']);
		$stmt->bindparam(":content",$_POST['content']);
		$stmt->bindparam(":auteur",$_POST['auteur']);
		$stmt->bindparam(":active",$active);
		$stmt->bindparam(":created",$dateD);
		$stmt->bindparam(":top",$top);
		$stmt->execute();
		
		$_SESSION['info'] = 'Une nouvelle actu a bien été ajouté.';
		header('location:articles.php');
		exit();

	}


	catch(PDOException $e)
	  {
	  
	  	$_SESSION['info'] = $e->getMessage(); 
	  	header('location:articles.php');
	  	exit();


	  }
}



// ================ MODIFIER ==================


if($_POST['type']=="modifier"){
	$active=0;
	if(isset($_POST['active']) ){$active=1;}

	$top=0;
	if(isset($_POST['top']) ){$top=1;}
	try{
		
		$stmt = $bdd->prepare("UPDATE article SET title=:title ,content=:content ,auteur=:auteur ,active=:active ,top=:top WHERE id=:id"); 
									
		$stmt->bindparam(":title",$_POST['titre']);
		$stmt->bindparam(":content",$_POST['content']);
		$stmt->bindparam(":auteur",$_POST['auteur']);
		$stmt->bindparam(":active",$active);
		$stmt->bindparam(":top",$top);
		$stmt->bindparam(":id",$_POST['id']);
		$stmt->execute();

		$_SESSION['info'] = 'Un article a bien été modifié.';
		header('location:articles.php');

		exit();

	}


	catch(PDOException $e)
	  {
	  
	  	$_SESSION['info'] = $e->getMessage(); 
	  	header('location:articles.php');
	  	exit();


	  }
}

//================= SUPPRIMER =================
if( $_GET['action']=="suppr"){

	$id=$_GET['id'];

	try{
		$stmt = $bdd->prepare("DELETE FROM article WHERE id=:id");
		$stmt->bindparam(":id",$id);
		$stmt->execute();
		$_SESSION['info'] = ' L\'article a bien été supprimé.';
		header('location:articles.php');
		exit();

	}


	catch(PDOException $e)
  	{
	  	$_SESSION['info'] = $e->getMessage(); 
	  	header('location:articles.php');
	  	exit();
  	}

}




 ?>