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

    <title>Admin | championnats </title>

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
                           Liste des classements
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Dashboard / classements /liste
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
                    <div class="col-lg-12">
                        <div class="">
                             <a href="classement-nouveau.php" class="btn btn-primary">Nouveau</a></a>
                        </div>
                            
                        
                        <br>
                        
                        <h2>Garçons</h2>
                         <div id="champ-btn-g">                 
                        <?php 
                        $reponse = $bdd->query('SELECT * FROM championnat  WHERE genre ="G" ORDER BY id ASC ');
                        while($donnees=$reponse->fetch()){
                            echo '<br> ';
                            echo '<a href="classement-afficher.php?id='.$donnees['id'].'"  title="Editer"> <i class="fa fa-pencil"></i> '.$donnees['name'].'</a>';
                        }
                        $reponse->closeCursor(); // Termine le traitement de la requête
                        ?>
                        </div>
                        <h2>Filles</h2>
                        <div id="champ-btn-f">              
                        <?php 
                        $reponse = $bdd->query('SELECT * FROM championnat  WHERE genre ="F" ORDER BY id ASC ');
                        while($donnees=$reponse->fetch()){
                            echo '<br> ';
                            echo '<a href="classement-afficher.php?id='.$donnees['id'].'"  title="Editer"> <i class="fa fa-pencil"></i> '.$donnees['name'].'</a>';
                        }
                        $reponse->closeCursor(); // Termine le traitement de la requête
                        ?>
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
