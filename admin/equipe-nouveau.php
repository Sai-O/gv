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

    <title>Admin | Equipes - Nouveau</title>

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
                          Création d'une nouvelle équipe
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Dashboard / equipes /nouveau
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
                            </div>  
                        </div>
                      <!-- Horizontal Form -->
                      <div class="box box-primary">
                        
                        <div class="box-header with-border">
                          <h3 class="box-title">Formulaire de création d'équipe</h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->
                        <form class="form-horizontal" method="POST" action="equipe-nouveau-post.php">
                          <div class="box-body">
                            
                            <div class="form-group">
                              <label for="inputId" class="col-sm-2 control-label">id</label>
                              <div class="col-sm-2">
                                <input type="text" class="form-control" id="inputId" value="auto" disabled>
                              </div>
                            </div>
                            
                            <hr>

                            <div class="form-group">
                              <label for="championnat_id" class="col-sm-2 control-label">Championnat</label>
                              <div class="col-sm-4">
                                <select  id ="championnat_id" name="championnat_id" class="form-control">
                                    <option value="" disabled selected>Selectionner le championnat</option>
                                    <?php 
                                        $reponse = $bdd->query('SELECT * FROM championnat  ORDER BY ID ASC');
                            
                                        while($donnees=$reponse->fetch()){
                                            echo '<option value="'.$donnees['id'].'"> '.$donnees['name'].'</option>';
                                        }
                                        $reponse->closeCursor(); // Termine le traitement de la requête
                                     ?> 
                                  </select>
                              </div>
                            </div>
                            
                            <hr>
                            
                            <div class="form-group">
                              <label for="name" class="col-sm-2 control-label">Nom de l'équipe</label>
                              <div class="col-sm-4">
                                <input type="text" class="form-control" name="name" id="name" value="" >
                              </div>
                            </div>
                            <hr>
                            
                            <div class="form-group">
                              <label for="description_short" class="col-sm-2 control-label">Description courte</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" name="description_short" id="description_short" value="" >
                              </div>
                            </div>

                            <hr>

                            <div class="form-group">
                              <label for="description" class="col-sm-2 control-label">Description</label>
                              <div class="col-sm-10">
                                <input type="text" class="form-control" name="description" id="description" value="" >
                              </div>
                            </div>

                            <hr>


                          </div><!-- /.box-body -->
                          <div class="box-footer">
                            <A href="equipes.php" class="btn btn-default">Annuler</A>
                            <button type="submit" class="btn btn-primary pull-right">Créer</button>
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





    



    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>



    <script>
        jQuery(document).ready( function(){

            var forma ="yapa";
            var a = {};

           
            
            var content ='<input type="radio" name="radioForma"  value="EPI" '+(forma == 'EPI'? 'checked':'')+'> <label> EPI </label></input>';
            content +='<input type="radio" name="radioForma"  value="SSIAP1" '+(forma == 'SSIAP1'? 'checked':'')+'> <label> SSIAP 1 </label></input>';
            content +='<input type="radio" name="radioForma"  value="SSIAP2" '+(forma == 'SSIAP2'? 'checked':'')+'> <label> SSIAP 2 </label></input>';
            content +='<input type="radio" name="radioForma"  value="SSIAP3" '+(forma == 'SSIAP3'? 'checked':'')+'> <label> SSIAP 3 </label></input>';
            content +='<input type="radio" name="radioForma"  value="Recyclage SSIAP1" '+(forma == 'Recyclage SSIAP1'? 'checked':'')+'> <label> Recyclage SSIAP 1 </label></input>';
            content +='<input type="radio" name="radioForma"  value="Recyclage SSIAP2" '+(forma == 'Recyclage SSIAP2'? 'checked':'')+'> <label> Recyclage SSIAP 2 </label></input>';
            content +='<input type="radio" name="radioForma"  value="Recylcage SSIAP3" '+(forma == 'Recylcage SSIAP3'? 'checked':'')+'> <label> Recyclage SSIAP 3 </label></input>';
            
            content +='<input type="radio" name="radioForma"  value="Remise a Niveau SSIAP1" '+(forma == 'Remise a Niveau SSIAP1'? 'checked':'')+' > <label> Remise à Niveau SSIAP 1 </label></input>';
            content +='<input type="radio" name="radioForma"  value="Remise a Niveau SSIAP2" '+(forma == 'Remise a Niveau SSIAP2'? 'checked':'')+' > <label> Remise à Niveau SSIAP 2 </label></input>';
            content +='<input type="radio" name="radioForma"  value="Remise a Niveau SSIAP3" '+(forma == 'Remise a Niveau SSIAP3'? 'checked':'')+' > <label> Remise à Niveau SSIAP 3 </label></input>';
            a["incendie"] = content;

            var content='<input type="radio" name="radioForma"  value="SST"'+(forma == 'SST'? 'checked':'')+'>  <label>SST</label></input>';
            content +='<input type="radio" name="radioForma"    value="MAC SST"'+(forma == 'MAC SST'? 'checked':'')+'>  <label>MAC SST</label></input>';
            content +='<input type="radio" name="radioForma"    value="PSC1"'+(forma == 'PSC1'? 'checked':'')+'>  <label>PSC1</label></input>';
            content +='<input type="radio" name="radioForma"    value="DSA"'+(forma == 'DSA'? 'checked':'')+'>  <label>DSA</label></input>';
            content +='<input type="radio" name="radioForma"    value="DAE"'+(forma == 'DAE'? 'checked':'')+'>  <label>DAE</label></input>';
            a["secourisme"] = content;

            var content='<input type="radio" name="radioForma"  value="PRAP IBC"'+(forma == 'PRAP IBC'? 'checked':'')+'>  <label>PRAP IBC</label></input>';
            content +='<input type="radio" name="radioForma"    value="PRAP 2S"'+(forma == 'PRAP 2S'? 'checked':'')+'>  <label>PRAP 2S</label></input>';
            content +='<input type="radio" name="radioForma"    value="Recyclage IBC"'+(forma == 'Recyclage IBC'? 'checked':'')+'>  <label>Recyclage IBC</label></input>';
            content +='<input type="radio" name="radioForma"    value="Geste et Posture"'+(forma == 'Geste et Posture'? 'checked':'')+'>  <label>Geste et Posture</label></input>';
            content +='<input type="radio" name="radioForma"    value="APS ASD"'+(forma == 'APS ASD'? 'checked':'')+'>  <label>APS ASD</label></input>';
            content +='<input type="radio" name="radioForma"    value="PRAP PE"'+(forma == 'PRAP PE'? 'checked':'')+'>  <label>PRAP PE</label></input>';
            content +='<input type="radio" name="radioForma"    value="PRAP HAPA"'+(forma == 'PRAP HAPA'? 'checked':'')+'>  <label>PRAP HAPA</label></input>';
            content +='<input type="radio" name="radioForma"    value="PRAP Transport"'+(forma == 'PRAP Transport'? 'checked':'')+'>  <label>PRAP Transport</label></input>';
            content +='<input type="radio" name="radioForma"    value="Permis Feu"'+(forma == 'Permis Feu'? 'checked':'')+'>  <label>Permis Feu</label></input>';
            content +='<input type="radio" name="radioForma"    value="PTI"'+(forma == 'PTI'? 'checked':'')+'>  <label>PTI</label></input>';
            content +='<input type="radio" name="radioForma"    value="Equipier evacuation"'+(forma == 'Equipier evacuation'? 'checked':'')+'>  <label>Équipier d’Évacuation</label></input>';
            a["prevention"] = content; 


            var content='<input type="radio" name="radioForma"  value="H0B0"'+(forma == 'H0B0'? 'checked':'')+'>  <label>H0B0</label></input>';
            content +='<input type="radio" name="radioForma"    value="BS"'+(forma == 'BS'? 'checked':'')+'>  <label>BS</label></input>';
            content +='<input type="radio" name="radioForma"    value="B1V"'+(forma == 'B1V'? 'checked':'')+'>  <label>B1V</label></input>';
            content +='<input type="radio" name="radioForma"    value="B2V"'+(forma == 'B2V'? 'checked':'')+'>  <label>B2V</label></input>';
            content +='<input type="radio" name="radioForma"    value="BR"'+(forma == 'BR'? 'checked':'')+'>  <label>BR</label></input>';
            content +='<input type="radio" name="radioForma"    value="BC"'+(forma == 'BC'? 'checked':'')+'>  <label>BC</label></input>';
            a["electriques"] = content;

            var content='<input type="radio" name="radioForma"  value="CQP APS"'+(forma == 'CQP APS'? 'checked':'')+'>  <label>CQP APS</label></input>';
            content +='<input type="radio" name="radioForma"    value="ASSP"'+(forma == 'ASSP'? 'checked':'')+'>  <label>ASSP</label></input>';
            a["surete"] = content;


            var content='';
            a["formateurs"] = content;

            var content='<input type="radio" name="radioForma"  value="Sensibilisation "'+(forma == 'Sensibilisation '? 'checked':'')+'>  <label>Sensibilisation </label></input>';
            a["dirigeants"] = content;

            

            $("#inputCat").change(function(){
                var cat= $(this).val();
                $('#formaRad').html(a[cat]);
            });


            var catfirst= "incendie";
                $('#formaRad').html(a[catfirst]);


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
            $( ".datepicker" ).datepicker({ minDate: +1 });










        });

    </script>

</body>

</html>
