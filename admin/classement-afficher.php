<?php 
session_start();
require_once('../configs/connexion.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin | championnat -classement </title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">


    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
   

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include 'pages/navigation.php'; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           Classement championnat :
                           <?php 
                                $ch = $_GET['id'];
                                $query ='SELECT name FROM championnat where id =:ch';
                                $handler = $bdd->prepare($query);
                                $handler->execute(array(':ch' => $ch));
                                $result=$handler->fetch();
                                echo $result['name'];
                            ?> 
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Dashboard / Classement/ Championnat
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                 <?php 
                    
                    if (isset($_SESSION['info'])){ 
                    ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="alert alert-info alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <i class="fa fa-info-circle"></i>  <strong><?php echo $_SESSION['info'] ?></strong>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                <?php } unset($_SESSION['info']);?>
    
                <!-- CLASSEMENT DES EQUIPES -->
                <div class="row">
                    <div class="col-lg-12">
                        <h2>Classement des équipes</h2>              
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Classement</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped" style="text-align: center;">
                                        <thead style="text-align: center;">
                                            <tr>
                                                <th>N°</th>
                                                <th>Equipes</th>
                                                <th>J</th>
                                                <th>V</th>
                                                <th>N</th>
                                                <th>P</th>
                                                <th>Bp</th>
                                                <th>Bc</th>
                                                <th>Diff</th>
                                                <th>Pts</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php 
                                            $ch = $_GET['id'];
                                            $query ='SELECT * FROM classement where championnat_id =:ch  ORDER BY pts DESC, g DESC, n ASC, db DESC';
                                            $handler = $bdd->prepare($query);
                                            $handler->execute(array(':ch' => $ch));
                                            $donnees=$handler->fetchAll();
                                            $nbr =1;
                                            foreach ($donnees as  $donnee) {
                                                echo '<tr> ';
                                                    echo '<td><b>'.$nbr.'</b></td>';
                                                    echo '<td>'.$donnee['equipe'].'</td>';
                                                    echo '<td>'.$donnee['mj'].'</td>';
                                                    echo '<td>'.$donnee['g'].'</td>';
                                                    echo '<td>'.$donnee['n'].'</td>';
                                                    echo '<td>'.$donnee['p'].'</td>';
                                                    echo '<td>'.$donnee['bp'].'</td>';
                                                    echo '<td>'.$donnee['bc'].'</td>';
                                                    echo '<td>'.$donnee['db'].'</td>';
                                                    echo '<td style="color:#f30d0b;">'.$donnee['pts'].'</td>';
                                                echo '</tr>';
                                                $nbr++;
                                            }
                                               


                                            ?>
                                        </tbody>
                                        
                                    </table>
                                </div>
                                
                            </div>
                        </div>
                        <div style="text-align:right;margin:5px;">
                            <?php echo '<a href="classement-calcul.php?id='.$ch.'" class="btn btn-primary">Recalculer le classement </a></a>'; ?> 
                        </div> 
                    </div>
                </div>

                <!-- CALENDRIER DES MATCHS -->
                <div class="row">
                    <div class="col-lg-12">
                        <h2>Calendrier des matchs</h2>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Liste des matches</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Actions</th>
                                                <th>championnat</th>
                                                <th>Equipe1</th>
                                                <th>Score</th>
                                                <th>Equipe2</th>
                                                <th>Date</th>
                                                <th>Heure</th>
                                                <th>Journée</th>
                                                <th>Etat</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php
                                           
                                                $reponse = $bdd->query("SELECT match.id, championnat.name as championnat,  eq1.name as equipe1, eq2.name as equipe2, 
                                                    match.score1, match.score2,  match.date, match.heure, match.journee, match.etat   from `match`
                                                    INNER JOIN championnat ON championnat.id = match.championnat_id
                                                    INNER JOIN equipe  as eq1 ON eq1.id = match.equipe1
                                                    INNER JOIN equipe  as eq2 ON eq2.id = match.equipe2
                                                    WHERE championnat.id = '$ch'
                                                    ORDER BY journee ASC, date ASC
                                                ");
                                               
                                                
                                                while($donnees=$reponse->fetch()){
                                                    $etat = "A venir";
                                                    if($donnees['etat'] == 1) $etat ="Déja joué";

                                                    $today = date('Y-m-d');
                                                    $today_time = strtotime($today);
                                                    $match_time = strtotime($donnees['date']);
                                                    $matchPasse = false;
                                                    if ($today_time>$match_time) {
                                                        $matchPasse = true;
                                                    }
                                                    
                                                    if ($donnees['etat'] == 0 && $matchPasse && $donnees['date']!=null) {
                                                       echo '<tr style="background:#faa;"> ';
                                                    }
                                                    else{echo '<tr>';}
                                                    
                                                        echo '<td>
                                                                <a href="match-modifier.php?id='.$donnees['id'].'" class="btn btn-success" data-toggle="tooltip" data-placement="rigt" title="Modifier"> <i class="fa fa-pencil"></i></a>';

                                                                
                                                                if($etat == "A venir" && $donnees['date']!=null && $donnees['heure']!=null ){
                                                                    echo '<a href="match-scorer.php?id='.$donnees['id'].'" class="btn btn-edit" data-toggle="tooltip" data-placement="rigt" title="Scorer"> <i class="fa fa-pencil"></i></a>';
                                                                }
                                                        echo '</td>'
                                                        ;
                                                        echo '<td><b>'.$donnees['championnat'].'</b> ';
                                                        echo '<td><b>'.$donnees['equipe1'].'</b></td>';
                                                        if($etat == "A venir"){
                                                            echo "<td>''-''</td>";
                                                        }else{
                                                            echo '<td>'.$donnees['score1'].' - '.$donnees['score2'].'</td>';
                                                        }
                                                        echo '<td><b>'.$donnees['equipe2'].'</b></td>';
                                                        if($donnees['date'] == null){
                                                          $dateY = "Non défini";  
                                                        }
                                                        else{
                                                            $dateY = date("d/m/Y",strtotime($donnees['date']));
                                                        }
                                                        echo '<td>'.$dateY.'</td>';
                                                        echo '<td>'.$donnees['heure'].'</td>';
                                                        echo '<td>'.$donnees['journee'].'</td>';
                                                        echo '<td>'.$etat.'</td>';
                                                    echo '</tr>';
                                                }
                                                $reponse->closeCursor(); // Termine le traitement de la requête


                                            ?>
                                        </tbody>
                                        
                                    </table>
                                </div>
                                
                            </div>
                        </div>
                        <div style="text-align:right;margin:5px;">
                            <?php echo '<a href="match-calendar.php?ch='.$ch.'" class="btn btn-primary">Générer le calendrier des matchs</a></a>'; ?>
                        </div>
                    </div>
                </div>
                
                <!-- LISTES DES EQUIPES -->
                <div class="row">
                    <div class="col-lg-12">
                        <h2>Liste des équipes</h2>
                    </div>
                    <div class="col-lg-3">
              
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Equipes du championnat</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>equipes</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php 
                                            $query ='SELECT * FROM equipe where championnat_id =:ch  ORDER BY name';
                                            $handler = $bdd->prepare($query);
                                            $handler->execute(array(':ch' => $ch));
                                            $donnees=$handler->fetchAll();
                                            foreach ($donnees as  $donnee) {
                                                echo '<tr> ';
                                                    echo '<td>'.$donnee['name'].'</td>';
                                                echo '</tr>';
                                            }
                                            ?>
                                        </tbody>
                                        
                                    </table>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>


                <br><br><br><br><br>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

  

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <script>
        jQuery(document).ready( function(){
            $(function () {
              $('[data-toggle="tooltip"]').tooltip()
            })
        });
    </script>

</body>

</html>
