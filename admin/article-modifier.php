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

    <title>Admin | Article - Modifier</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
   
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include 'pages/navigation.php'; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <?php 
                    $reponse = $bdd->prepare('SELECT * FROM article WHERE id = :id');
                    $reponse->execute(array('id' => $_GET['id']));
                    $donnees=$reponse->fetch();
                 ?>

                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           Modifier l'article : <?php echo $donnees['title']; ?>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Dashboard / Article / Modifier
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <!-- /.row -->
                 
                <!-- Main content -->
                <section class="content" style="background:#fff;padding:15px;">
                    <div class="row">
                      <div class="col-md-8">
                        <div class="panel-heading">    
                            <div class="text-right">
                                <a href="articles.php" class="btn btn-default"> Retour</a> 
                                <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Supprimer</a>
                               
                            </div>  
                        </div>
                      <!-- Horizontal Form -->
                      <div class="box box-info">
                        
                        <div class="box-header with-border">
                          <h3 class="box-title">Formulaire de modification</h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <form class="form-horizontal" method="POST" action="article-post.php">
                          <input type="hidden" name="type" value="modifier">
                          <input type="hidden" name="id" value="<?php echo $donnees['id'] ?>">
                          <div class="box-body">
                            <div class="form-group">
                              <label for="titre" class="col-sm-2 control-label">Titre : </label>
                              <div class="col-sm-9">
                                <input type="text" class="form-control" name="titre" id="titre" value="<?php echo $donnees['title'] ?>" >
                              </div>
                            </div>
                            <hr>
                            
                            <div class="form-group">
                              <label for="description_short" class="col-sm-2 control-label">Contenu :</label>
                              <div class="col-sm-9">
                                <textarea name="content"  rows="15" style="width:100%;"><?php echo $donnees['content'] ?></textarea>
                              </div>
                            </div>

                            <hr>

                            <div class="form-group">
                              <label for="auteur" class="col-sm-2 control-label">Auteur :</label>
                              <div class="col-sm-4">
                                <input type="text" class="form-control" name="auteur" id="auteur" value="<?php echo $donnees['auteur'] ?>" >
                              </div>
                            </div>
                            <hr>

                            <div class="form-group">
                              <label for="active" class="col-sm-2 control-label">Active :</label>
                              <div class="col-sm-4">
                                <input type="checkbox" class="form-control" name="active" id="active" <?php if($donnees['active'] ==1) echo'checked'; ?> />
                              </div>
                            </div>
                            <hr>

                            <div class="form-group">
                              <label for="top" class="col-sm-2 control-label">Top :</label>
                              <div class="col-sm-4">
                                <input type="checkbox" class="form-control" name="top" id="top" <?php if($donnees['top'] ==1) echo'checked'; ?> >
                              </div>
                            </div>
                            <hr>
                            
                            

                          </div><!-- /.box-body -->
                          <div class="box-footer">
                            <A href="articles.php" class="btn btn-default">Annuler</A>
                            <button type="submit" class="btn btn-success pull-right">Confirmer</button>
                          </div><!-- /.box-footer -->
                        </form>
                      </div><!-- /.box -->
                
                      
                    </div><!--/.col (right) -->

                      
                    <!-- right column -->
                  </div>   <!-- /.row -->
                  <div class="text-right">
                    <a href="articles.php">Retour à la liste <i class="fa fa-arrow-circle-right"></i></a>
                </div>

                </section><!-- /.content -->

               

                
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->



    </div>
    <!-- /#wrapper -->


    <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Confirmation de suppression</h4>
              </div>
              <div class="modal-body">
                êtes vous sur de vouloir supprimer cet article? 
               
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                <a href=" <?php echo'article-post.php?action=suppr&id='.$donnees['id'] ?>" class="btn btn-danger">Supprimer</a>
              </div>
            </div>
          </div>
        </div>
        <?php $reponse->closeCursor(); // Termine le traitement de la requête ?>
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>


</body>

</html>
