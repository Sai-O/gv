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
                           Liste des articles
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Dashboard / articles /liste
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
                             <a href="article-nouveau.php" class="btn btn-primary">Nouveau</a></a>
                        </div>
                    </div>

                
                    <div class="col-lg-12">       
                        
                        <br>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Liste des articles</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Actions</th>
                                                <th>titre</th>
                                                <th>contenu</th>
                                                <th>date</th>
                                                <th>active</th>
                                                <th>top</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php 
                                                $query='SELECT * FROM article ORDER BY id DESC';
                                                $reponse = $bdd->query($query);
                                                while($donnees=$reponse->fetch()){
                                                    echo '<tr> ';
                                                        echo '<td><a href="article-modifier.php?id='.$donnees['id'].'" class="btn btn-success" data-toggle="tooltip" data-placement="rigt" title="Editer"> <i class="fa fa-pencil"></i></a>';
                                                        echo '<td><b>'.$donnees['title'].'</b> </td>';
                                                        $extract = substr($donnees['content'],0, 300);
                                                        echo '<td>'.$extract.' </td>';
                                                        echo '<td>'.$donnees['created'].'</td>';
                                                        echo '<td>'.$donnees['active'].'</td>';
                                                        echo '<td>'.$donnees['top'].'</td>';
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
