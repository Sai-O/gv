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

    <title>Admin | Equipes </title>

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
                           Liste des equipes
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Dashboard / equipes /liste
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
    

                <div class="row">
                    <div class="col-lg-2"> 
                        <div class="">
                             <a href="equipe-nouveau.php" class="btn btn-primary">Nouveau</a></a>
                        </div>
                    </div>

                    <div class="col-lg-6" style="background:#fff;"> 
                        <form method="GET">
                            <div class="form-group" style="padding:10px;">
                                <label for="championnat_id" class="col-sm-2 control-label">Championnat</label>
                                <div class="col-sm-6">
                                    <select name="sc" id="selectChampionnat">
                                        <option value="" disabled selected>filtrer par championnat</option>
                                        <?php 
                                            $reponse = $bdd->query('SELECT * FROM championnat  ORDER BY ID ASC');
                                
                                            while($donnees=$reponse->fetch()){
                                                echo '<option value="'.$donnees['id'].'"> '.$donnees['name'].'</option>';
                                            }
                                            $reponse->closeCursor(); // Termine le traitement de la requête
                                         ?> 
                                        
                                    </select>
                                    <button type="submit" class="btn btn-primary pull-right">Filtrer</button>
                                </div>
                                
                            </div>
                        </form>
                    </div>

                    <div class="col-lg-12">       
                        
                        <br>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Liste des sessions</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Actions</th>
                                                <th>Equipe</th>
                                                <th>titre</th>
                                                <th>description</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php 
                                            if(isset($_GET["sc"])){
                                             $query='SELECT e.id as id, e.name as name, e.description_short as description_short, 
                                                                                e.description as description, c.name as championnat_name  
                                                                                FROM equipe e
                                                                                INNER JOIN  championnat c ON c.id = e.championnat_id
                                                                                WHERE c.id = '.$_GET["sc"].'
                                                                                ORDER BY id DESC'; 
                                            }
                                            else{
                                                $query='SELECT e.id as id, e.name as name, e.description_short as description_short, 
                                                                                e.description as description, c.name as championnat_name  
                                                                                FROM equipe e
                                                                                INNER JOIN  championnat c ON c.id = e.championnat_id

                                                                                 ORDER BY id DESC'; 
                                            }
                                            $reponse = $bdd->query($query);




                                                $reponse = $bdd->query($query);
                            
                                                while($donnees=$reponse->fetch()){
                                                    echo '<tr> ';
                                                        echo '<td><a href="equipe-modifier.php?id='.$donnees['id'].'" class="btn btn-success" data-toggle="tooltip" data-placement="rigt" title="Editer"> <i class="fa fa-pencil"></i></a>';
                                                        echo '<td><b>'.$donnees['name'].'</b> : <span style="float: right;">'.$donnees['championnat_name'].'<span></td>';
                                                        echo '<td>'.$donnees['description_short'].'</td>';
                                                        echo '<td>'.$donnees['description'].'</td>';
                                                    echo '</tr>';
                                                }
                                                $reponse->closeCursor(); // Termine le traitement de la requête


                                            ?>
                                        </tbody>
                                        
                                    </table>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

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
