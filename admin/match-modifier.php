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

    <title>Admin | Match - Modifier</title>

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
                

                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                          Modifier un match
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Dashboard / Match / Modifier
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
                                    <a href="matchs.php" class="btn btn-default"> Retour</a> 
                                    <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#myModal"> Suprimer</a> 
                                </div>  
                            </div>
                            <!-- Horizontal Form -->
                            <div class="box box-primary" style="min-height: 490px;">
                            
                                <div class="box-header with-border">
                                </div><!-- /.box-header -->
                                
                                <!-- form start -->
                                <form class="form-horizontal" method="POST" action="match-modifier-post.php">
                                    <div class="box-body">
                                        <?php 
                                    
                                        if(isset($_GET['id'])){
                                             $match = $_GET['id'];
                                            $query = 'SELECT match.id, championnat.name as championnat,  eq1.name as equipe1, eq2.name as equipe2, 
                                                    match.score1, match.score2,  match.date, match.heure, match.journee as journee, match.etat   from `match`
                                                    INNER JOIN championnat ON championnat.id = match.championnat_id
                                                    INNER JOIN equipe  as eq1 ON eq1.id = match.equipe1
                                                    INNER JOIN equipe  as eq2 ON eq2.id = match.equipe2
                                                     WHERE match.id =:match';

                                            $handler = $bdd->prepare($query);
                                            $handler->execute(array(':match' => $match));
                                            $donnees=$handler->fetch();
                                            echo "";
                                            $num ="ème";
                                            if ($donnees['journee'] == 1)$num ="ère";

                                            echo "<div style='text-align:center;' ><h3>".$donnees['journee']." ".$num." journée du championnat : ".$donnees['championnat']."</h3>";
                                            echo " <h5> Le ".$donnees['date']." à ".$donnees['heure']."</h5>";
                                            echo " <h2 style='color: #fff;background: #122a62;padding: 5px;' >".$donnees['equipe1']." vs ".$donnees['equipe2']."</h2>";
                                            if($donnees['etat'] ==0){
                                                $donnees['score1'] =$donnees['score2'] ="";

                                            $heure = $donnees['heure'];
                                            }?>
                                            <hr>
                                            <div class="form-group">
                                               
                                                <div class="col-sm-2">
                                                     <label for="journee" class="">Journee</label>
                                                    <input type="number" class="form-control " name="journee"   value="<?php echo $donnees['journee']; ?>" required>
                                                </div>
                                                <div class="col-sm-2">
                                                     <label for="date" class="">Date</label>
                                                    <input type="text" class="form-control datepicker" name="inputdate" id="inputdate" value="<?php echo $donnees['date']; ?>" required>
                                                </div>
                                                
                                                <div class="col-sm-2">
                                                    <label for="heure">Heure</label>
                                                    <select  id ="heureselect" name="heureselect" class="form-control" required>
                                                        <option value="" disabled selected>HH : mm </option>
                                                        <option value="08:00" <?php if($heure =="08:00:00") echo "selected" ?> >08h00</option>
                                                        <option value="09:00" <?php if($heure =="09:00:00") echo "selected" ?> >09h00</option>
                                                        <option value="10:00" <?php if($heure =="10:00:00") echo "selected" ?> >10h00</option>
                                                        <option value="11:00" <?php if($heure =="11:00:00") echo "selected" ?> >11h00</option>
                                                        <option value="12:00" <?php if($heure =="12:00:00") echo "selected" ?> >12h00</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-4" id="etatBlock">
                                                     <label for="etat" class="">Etat</label><br>
                                                    <label style="margin-right:10px;"><input type="radio" name="etat" id="etat0" value="0"  <?php if($donnees['etat'] == 0)echo "checked"; ?> > A venir </input></label>
                                                    <label style="margin-right:10px;"><input type="radio" name="etat" id="etat1" value="1"  <?php if($donnees['etat'] == 1)echo "checked"; ?> > Joué </input></label>
                              
                                                </div>
                                            </div>
                                            <hr>
                                            <div id='ajaxScore'>
                                                <div class="form-group" style="width:100%;margin : 0 auto" id="scoreBlock">
                                                    <label for="score1" class="col-sm-3 control-label"><?php echo $donnees['equipe1']; ?></label>
                                                    <div class="col-sm-2">
                                                        <input type="number" class="form-control scoreInput" name="score1" id="score1" value="<?php echo $donnees['score1']; ?>" >
                                                    </div>
                                                    <div class="col-sm-2" style="text-align:center;font-style:bold;font-size:25px;font-weight: bold;margin-top:5px;"> - </div>
                                                    <div class="col-sm-2">
                                                        <input type="number" class="form-control scoreInput" name="score2" id="score2" value="<?php echo $donnees['score2']; ?>" >
                                                    </div>
                                                    <label for="score2" class="col-sm-3 control-label" style="text-align: left;"><?php echo $donnees['equipe2']; ?></label>
                                                </div>  


                                                <div class="box-footer" style="text-align:center;margin-top: 30px;">
                                                    <input type="hidden" name="slug" value="one match">
                                                    <input type="hidden" name="match_id" value="<?php echo $match ?>">
                                                    <button type="submit" class="btn btn-primary" style="font-style:bold;padding:10px 30px;">Modifier</button>
                                                </div>
                                            </div>
                                        <?php }
                                        else{ /*===============================================================================*/
                                        ?>
                                    

                                
                                        <?php }?>
                                    </div>

                                </form>
                            </div><!-- /.box -->
                        </div><!--/.col (right) -->
                    </div>   <!-- /.row -->
                    <div class="text-right">
                        <a href="matchs.php">Retour à la liste <i class="fa fa-arrow-circle-right"></i></a>
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
                êtes vous sur de vouloir supprimer ce match? 
               
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                <a href=" <?php echo'match-suppr.php?id='.$donnees['id'] ?>" class="btn btn-danger">Supprimer</a>
              </div>
            </div>
          </div>
        </div>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>


    <script>
        jQuery(document).ready( function(){

            if($("input[name='etat']:checked").val() == 0){$('#scoreBlock').css('display','none');}


            $('#etatBlock input').change(function(){
                let val_etat = $("input[name='etat']:checked").val();
                if( val_etat == 1){
                    $('#scoreBlock').css('display','block');
                }
                else{
                    $('#scoreBlock').css('display','none');
                }
            })




            



            /*-------------------------calendar-----------------------------------*/
            var iNbr = 0;

          $.datepicker.regional['fr'] = {
            closeText: 'Fermer',
            prevText: 'Précédent',
            nextText: 'Suivant',
            currentText: 'Aujourd\'hui',
            monthNames: ['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre'],
            monthNamesShort: ['Janv.','Févr.','Mars','Avril','Mai','Juin','Juil.','Août','Sept.','Oct.','Nov.','Déc.'],
            dayNames: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
            dayNamesShort: ['Dim.','Lun.','Mar.','Mer.','Jeu.','Ven.','Sam.'],
            dayNamesMin: ['D','L','M','M','J','V','S'],
            weekHeader: 'Sem.',
            dateFormat: 'dd-mm-yy',
            firstDay: 1,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: ''};

            $.datepicker.setDefaults($.datepicker.regional['fr']);
            $( ".datepicker" ).datepicker();
            });

    </script>

</body>

</html>
