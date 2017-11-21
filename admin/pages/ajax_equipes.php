<?php 
 	
	require_once('connexion_ajax.php');

 	try{

		if(isset($_GET['championnat'])){
			$championnat = $_GET['championnat'];
			$query = 'SELECT equipe.id, equipe.name FROM equipe  WHERE equipe.championnat_id=:championnat ORDER BY name ASC';

			$handler = $bdd->prepare($query);
			$handler->execute(array(':championnat' => $championnat));
			if($handler->rowCount() >= 1){
				header("Content-type: application/json");
				echo json_encode($handler->fetchAll(PDO::FETCH_ASSOC));
			}
			else{
				$error =array('Error' => 'Il n\'a pas de equipe dans ce championnat pour le moment');
				header("Content-type: application/json");
				echo json_encode($error);
			}
		}

		else{
			echo "erreur pas de ajax param championnat";
		}
	}

	catch( PDOExcerption $ex){
	}



	




/*
	if(isset($_GET['formation'])){
		$forma = $_GET['formation'];
		$query = 'SELECT * FROM sessiondate';

		$handler = $bdd->prepare($query);
		$handler->execute();
		if($handler->rowCount() >= 1){
			echo "string2";
			echo ($handler->fetchAll(PDO::FETCH_ASSOC));
		}
		else{
			$error =array('Error' => 'Il n\'a pas de dates de prévues pour le moment');
			echo json_encode($error);
		}
	}

	else{
		header('location:devis.php');
	}
*/

 ?>