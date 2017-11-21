<?php 
 	
require_once('connexion_ajax.php');


$slug = $_GET['slug'];

if ($slug =="all matchs") {
 	try{

		if(isset($_GET['championnat'])){
			$championnat = $_GET['championnat'];
			$query = 'SELECT match.id, championnat.name as championnat,  eq1.name as equipe1, eq2.name as equipe2, 
                                    match.score1, match.score2,  match.date, match.heure, match.journee, match.etat   from `match`
                                    INNER JOIN championnat ON championnat.id = match.championnat_id
                                    INNER JOIN equipe  as eq1 ON eq1.id = match.equipe1
                                    INNER JOIN equipe  as eq2 ON eq2.id = match.equipe2
                                    WHERE match.championnat_id = :championnat AND  match.etat = 0
                                    order by journee ';

			$handler = $bdd->prepare($query);
			$handler->execute(array(':championnat' => $championnat));
			if($handler->rowCount() >= 1){
				header("Content-type: application/json");
				echo json_encode($handler->fetchAll(PDO::FETCH_ASSOC));
			}
			else{
				$error =array('Error' => 'Il n\'a pas de match dans ce championnat pour le moment');
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
}


else if ($slug =="one match") { //echo "one match";
 	try{

		if(isset($_GET['match_id'])){
			$match = intval($_GET['match_id']);
			$query = 'SELECT match.id, championnat.name as championnat,  eq1.name as equipe1, eq2.name as equipe2, 
                                    match.score1, match.score2,  match.date, match.heure, match.journee as journee, match.etat   from `match`
                                    INNER JOIN championnat ON championnat.id = match.championnat_id
                                    INNER JOIN equipe  as eq1 ON eq1.id = match.equipe1
                                    INNER JOIN equipe  as eq2 ON eq2.id = match.equipe2
                                     WHERE match.id =:match';

			$handler = $bdd->prepare($query);
			$handler->execute(array(':match' => $match));
			if($handler->rowCount() >= 1){	
				while($donnees=$handler->fetch()){
					$test = include("ajax_scorer_template.php");
				}
				echo $test;
			}
			else{
				$error =array('Error' => ' Le match selectionner n\'existe pas');
				//header("Content-type: application/json");
				echo ($error);
			}
		}

		else{
			echo "erreur pas de ajax param match";
		}
	}

	catch( PDOExcerption $ex){
	}
}	



 ?>