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

    <title>Admin | Equipes - Modifier</title>

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
                    $reponse = $bdd->prepare('SELECT * FROM equipe WHERE id = :id');
                    $reponse->execute(array('id' => $_GET['id']));
                    $donnees=$reponse->fetch();
                 ?>

                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           Modifier l'équipe : <?php echo $donnees['name']; ?>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Dashboard / Equipes / Modifier
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
                                <a href="equipes.php" class="btn btn-default"> Retour</a> 
                                <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Supprimer</a>
                               
                            </div>  
                        </div>
                      <!-- Horizontal Form -->
                      <div class="box box-info">
                        
                        <div class="box-header with-border">
                          <h3 class="box-title">Formulaire de modification</h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <form class="form-horizontal" method="POST" action="equipe-modifier-post.php">
                          <div class="box-body">
                            
                            <div class="form-group">
                              <label for="id" class="col-sm-2 control-label">id</label>
                              <div class="col-sm-2">
                                <input type="text" class="form-control" id="id" name="id" value="<?php echo $donnees['id'] ?>" disabled>
                                <input type="text"  name="inputIdh" value="<?php echo $donnees['id'] ?>" hidden>
                              </div>
                            </div>
                            <hr>

                            <div class="form-group">
                              <label for="name" class="col-sm-2 control-label">Nom de l'équipe</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" id="name" value="<?php echo $donnees['name'] ?>" >
                              </div>
                            </div>
                            <hr>

                            <div class="form-group">
                              <label for="championnat_id" class="col-sm-2 control-label">Championnat</label>
                              <div class="col-sm-4">
                                <select id ="championnat_id" name ="championnat_id" class="form-control">
                                    <?php 
                                      $champ= $donnees['championnat_id'];
                                      $reponseC = $bdd->query('SELECT * FROM championnat  ORDER BY ID ASC');
                          
                                      while($donneesC=$reponseC->fetch()){
                                          echo '<option value="'.$donneesC['id'].'"';
                                          if ($champ == $donneesC['id'])echo "selected";
                                          echo '> '.$donneesC['name'].'</option>';
                                      }
                                      $reponseC->closeCursor(); // Termine le traitement de la requête
                                    ?>

                                </select>
                              </div>
                            </div>
                            


                            <hr>

                            <div class="form-group">
                              <label for="description_short" class="col-sm-2 control-label">Description courte</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" name="description_short" id="description_short" value="<?php echo $donnees['description_short'] ?>" >
                                <p style="font-style : italic;">Ex: feffefsg</p>
                              </div>
                            </div>


                            <hr>
                            
                            <div class="form-group">
                              <label for="description" class="col-sm-2 control-label">Description</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" name="description" id="description" value="<?php echo $donnees['description'] ?>" >
                                <p style="font-style : italic;">Ex: feffefsg</p>
                              </div>
                            </div>


                            <hr>


                          </div><!-- /.box-body -->
                          <div class="box-footer">
                            <A href="equipes.php" class="btn btn-default">Annuler</A>
                            <button type="submit" class="btn btn-success pull-right">Confirmer</button>
                          </div><!-- /.box-footer -->
                        </form>
                      </div><!-- /.box -->
                
                      
                    </div><!--/.col (right) -->

                      
                    <!-- right column -->
                  </div>   <!-- /.row -->
                  <div class="text-right">
                    <a href="equipes.php">Retour à la liste <i class="fa fa-arrow-circle-right"></i></a>
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
                êtes vous sur de vouloir supprimer cette equipe? 
               
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                <a href=" <?php echo'equipe-suppr.php?id='.$donnees['id'] ?>" class="btn btn-danger">Supprimer</a>
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
