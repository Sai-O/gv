<?php

if(  !isset( $_SESSION['admin']) OR $_SESSION['admin']!='true')  {
	header('location:../login.php');
	exit();
}



 try{

 	//Local
	$bdd = new PDO('mysql:host=localhost;dbname=uaff;charset=utf8', 'root', '31102008');
	// Prod
	//$bdd = new PDO('mysql:host=localhost;dbname=h4090_gv;charset=utf8', 'h4090', '5ZQI7tqN');


    //$bdd=new PDO('mysql:host=db606055425.db.1and1.com;dbname=db606055425','dbo606055425','ConsInisBDD_44',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    //$bdd=new PDO('mysql:host=localhost;dbname=gousainville','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  }

  catch( exception $e){
    die('Message d\'erreur : '. $e->getMessage());
  }
