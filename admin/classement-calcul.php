<?php 
session_start();
require_once('../configs/connexion.php');

$ch = $_GET['id'];

$query ='SELECT name FROM equipe where championnat_id =:ch ';
$handler = $bdd->prepare($query);
$handler->execute(array(':ch' => $ch));
$donnees=$handler->fetchAll();

$eq_array=array();
foreach ($donnees as  $donnee) {
    var_dump($donnee['name']);
    $eq_array[]=$donnee['name'];
}


$tempClassement = initClassement($eq_array);

function initClassement($eqipesArray){
    $classementArray=array();
    foreach ($eqipesArray as $equipe) {
        $name = $equipe;
        $classementArray[$name]['name'] =$name ;
        $classementArray[$name]['mj'] =0;
        $classementArray[$name]['g'] =0;
        $classementArray[$name]['n'] =0;
        $classementArray[$name]['p'] =0;
        $classementArray[$name]['bp'] =0;
        $classementArray[$name]['bc'] =0;
        $classementArray[$name]['db'] =0;
        $classementArray[$name]['pts'] =0;
    }
    return $classementArray;

}

$query = 'SELECT match.id, championnat.name as championnat,  eq1.name as equipe1, eq2.name as equipe2, 
            match.score1, match.score2,  match.date, match.heure, match.journee, match.etat   from `match`
            INNER JOIN championnat ON championnat.id = match.championnat_id
            INNER JOIN equipe  as eq1 ON eq1.id = match.equipe1
            INNER JOIN equipe  as eq2 ON eq2.id = match.equipe2
             WHERE championnat.id =:ch AND etat=1
            order by journee ASC, date ASC';

$handler = $bdd->prepare($query);
$handler->execute(array(':ch' => $ch));
$matches=$handler->fetchAll();


foreach ($matches as  $match) {
    $equipe1 = $match['equipe1'];
    $equipe2 = $match['equipe2'];

    $tempClassement[$equipe1]['mj'] ++;
    $tempClassement[$equipe2]['mj'] ++;

    $tempClassement[$equipe1]['bp'] += $match['score1'];
    $tempClassement[$equipe2]['bp'] += $match['score2'];

    $tempClassement[$equipe1]['bc'] += $match['score2'];
    $tempClassement[$equipe2]['bc'] += $match['score1'];

    $tempClassement[$equipe1]['db'] += ($match['score1'] - $match['score2']);
    $tempClassement[$equipe2]['db'] += $match['score2'] -$match['score1'];


    if( $match['score1'] == $match['score2']){// match nul

        $tempClassement[$equipe1]['n'] ++;
        $tempClassement[$equipe2]['n'] ++;

        $tempClassement[$equipe1]['pts'] += 2;
        $tempClassement[$equipe2]['pts'] += 2;
    }

    if( $match['score1'] > $match['score2']){// equipe1 gagne

        $tempClassement[$equipe1]['g'] ++;
        $tempClassement[$equipe2]['p'] ++;

        $tempClassement[$equipe1]['pts'] += 4;
        $tempClassement[$equipe2]['pts'] += 1;
    }

    if( $match['score1'] < $match['score2']){// equipe1 perd

        $tempClassement[$equipe1]['p'] ++;
        $tempClassement[$equipe2]['g'] ++;

        $tempClassement[$equipe1]['pts'] += 1;
        $tempClassement[$equipe2]['pts'] += 4;
    }
}


    $stmt1 = $bdd->prepare("DELETE FROM `classement` WHERE championnat_id=:championnat_id");
    $stmt1->bindparam(":championnat_id",$ch);
    $stmt1->execute();


    foreach ($tempClassement as $cl) {
    $stmt = $bdd->prepare("INSERT INTO `classement` (equipe, mj, g, n, p, bp, bc, db, pts, championnat_id) 
                                VALUES(:equipe, :mj, :g, :n, :p, :bp, :bc, :db, :pts, :championnat_id)");
    $stmt->bindparam(":equipe", $cl['name']);
    $stmt->bindparam(":mj",     $cl['mj']);
    $stmt->bindparam(":g",      $cl['g']);
    $stmt->bindparam(":n",      $cl['n']);
    $stmt->bindparam(":p",      $cl['p']);
    $stmt->bindparam(":bp",     $cl['bp']);
    $stmt->bindparam(":bc",     $cl['bc']);
    $stmt->bindparam(":db",     $cl['db']);
    $stmt->bindparam(":pts",    $cl['pts']);
    $stmt->bindparam(":championnat_id",    $ch);
    $stmt->execute();
    }

    $_SESSION['info'] = 'Le classement a été mis à jour.';
    
    header("Location:classement-afficher.php?id=$ch");
    exit();

