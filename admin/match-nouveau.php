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

    <title>Admin | Match - Nouveau</title>

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
                          Création d'un nouveau match
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Dashboard / matchs /nouveau
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
                            </div>  
                        </div>
                      <!-- Horizontal Form -->
                      <div class="box box-primary">
                        
                        <div class="box-header with-border">
                          <h3 class="box-title">Formulaire de création d'un match</h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <form class="form-horizontal" method="POST" action="match-nouveau-post.php">
                          <div class="box-body">
                            
                            <div class="form-group">
                              <label for="championnat_id" class="col-sm-2 control-label">Championnat</label>
                              <div class="col-sm-4">
                                <select  id ="championnat_id" name="championnat_id" class="form-control">
                                    <option value="" disabled selected>Selectionner le championnat</option>
                                    <?php 
                                        $reponse = $bdd->query('SELECT * FROM championnat  ORDER BY id ASC');
                            
                                        while($donnees=$reponse->fetch()){
                                            echo '<option value="'.$donnees['id'].'"> '.$donnees['name'].'</option>';
                                        }
                                        $reponse->closeCursor(); // Termine le traitement de la requête
                                     ?> 
                                  </select>
                              </div>
                            </div>
                            
                            
                            <div id="formAjax">
                                <hr>
                                <div class="form-group">
                                  <label for="equipe1" class="col-sm-2 control-label">Equipes</label>
                                  <div class="col-sm-4">
                                    <select  id ="equipe1" name="equipe1" class="form-control" required>
                                        
                                    </select>
                                  </div>
                                  <label for="equipe2" class="col-sm-1 control-label"> VS </label>
                                  <div class="col-sm-4">
                                    <select  id ="equipe2" name="equipe2" class="form-control" required>
                                        
                                    </select>
                                  </div>
                                </div>
                                <hr>
                                
                                <div class="form-group">
                                  <label for="inputdate" class="col-sm-2 control-label">Date</label>
                                  <div class="col-sm-3">
                                    <input type="text" class="form-control datepicker" name="inputdate" id="inputdate" value="" required>
                                  
                                  </div>
                                  <label for="heure" class="col-sm-1 control-label"> Heure </label>
                                  <div class="col-sm-2">
                                    <select  id ="heure" name="heure" class="form-control" required>
                                        <option value="" disabled selected>HH : mm </option>
                                        <option value="08:00" >08h00</option>
                                        <option value="09:00" >08h00</option>
                                        <option value="10:00" >10h00</option>
                                        <option value="11:00" >11h00</option>
                                        <option value="12:00" >12h00</option>
                                    </select>
                                  </div>
                                </div>

                                <hr>

                                <div class="form-group">
                                  <label for="journee" class="col-sm-2 control-label">Journée</label>
                                  <div class="col-sm-2">
                                    <input type="text" class="form-control" name="journee" id="journee" value="" required>
                                  </div>
                                </div>
                                
                                <hr>

                                <div class="form-group" id="etatBlock">
                                  <label for="inputForma" class="col-sm-2 control-label">Etat</label>
                                  <div class="col-sm-4">
                                    <label style="margin-right:10px;"><input type="radio" name="etat" id="etat0" value="0" checked > A venir </input></label>
                                    <label style="margin-right:10px;"><input type="radio" name="etat" id="etat1" value="1"  > Joué </input></label>
                                  </div>
                                </div>

                               
                                
                                <div id="scoreBlock">
                                    <hr>
                                <div class="form-group">
                                  <label for="score" class="col-sm-2 control-label">Score</label>
                                  <div class="col-sm-1">
                                    <input type="text" class="form-control" name="score1" id="score1" value="" >
                                  </div>
                                  <div class="col-sm-1">
                                    <input type="text" class="form-control" name="score2" id="score2" value="" >
                                  </div>
                                  </div>
                                </div>
                                <hr>
                                </div>

                                <div class="box-footer">
                                    <A href="matchs.php" class="btn btn-default">Annuler</A>
                                    <button type="submit" class="btn btn-primary pull-right">Créer</button>
                              </div><!-- /.box-footer -->
                            </div><!-- /.box-body -->
                          
                         </div>
                        </form>
                      </div><!-- /.box -->
                
                      
                    </div><!--/.col (right) -->

                      
                    <!-- right column -->
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




    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>


    <script>
        jQuery(document).ready( function(){
            $('#formAjax').css('display','none');
            $('#scoreBlock').css('display','none');

            /*========================SELECT CHAMPIONNAT =============================*/
            $("#championnat_id").change(function(){
                var championnat= $(this).val();
                console.log(championnat);
                //$('#ajaxform').html('');
                $('#equipe1').html('<option value="" disabled selected>Selectionner l\'equipe 1 </option>');
                $('#equipe2').html('<option value="" disabled selected>Selectionner l\'equipe 2 </option>');

                $.ajax({
                    url:'pages/ajax_equipes.php',
                    type:'GET',
                    data:{championnat:championnat},
                    dataType:'json',
                    success:function(data){
                        var length = data.length;
                        if(data.Error =='Il n\'a pas d\'equipe dans ce championnat'){
                            $('#ajaxInfos').append(data.Error);
                            //
                            return false;
                        }

                        var options='';
                        for(i=0;i<length;i++){   
                            options=options+ '<option value ="'+data[i].id+'">'+data[i].name+' </option>';

                            
                        }

                        $('#formAjax').css('display','block');    
                        $('#equipe1').append(options);
                        $('#equipe2').append(options);



                        //$('#datesFormation').css('visibility','visible');
                    },
                    error:function(xhr,textStatus,errorThrown){
                        alert(xhr.responseText);
                    }

                });
            });
            
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
            /*-------------------------select radio joué ----------------------------------*/
            $('#etatBlock input').change(function(){
                let val_etat = $("input[name='etat']:checked").val();
                if( val_etat == 1){
                    $('#scoreBlock').css('display','block');
                }
                else{
                    $('#scoreBlock').css('display','none');
                }
            })
        });

    </script>

</body>

</html>
