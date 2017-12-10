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
                          Scorer un match
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                <i class="fa fa-dashboard"></i> Dashboard / matchs /scorer
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <!-- /.row -->

                <!-- Main content -->
                <section class="content" style="background:#fff;padding:15px;">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel-heading">
                                <div class="text-right">
                                    <a href="matchs.php" class="btn btn-default"> Retour</a>
                                </div>
                            </div>
                            <!-- Horizontal Form -->
                            <div class="box box-primary" style="min-height: 390px;">

                                <div class="box-header with-border">
                                  <h3 class="box-title">Scorer un match</h3>
                                </div><!-- /.box-header -->

                                <!-- form start -->
                                <form class="form-horizontal" method="POST" action="match-score-post.php">
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
                                                echo "<div id='ajaxScore'><hr>";
                                                $num ="ème";
                                                if ($donnees['journee'] == 1)$num ="ère";
                                                echo "<h3>".$donnees['journee']." ".$num." journée du championnat : ".$donnees['championnat']."</h3>";
                                                echo " <h5> Match joué le ".$donnees['date']." à ".$donnees['heure']."</h5>";


                                             ?>
                                             <div class="form-group" style="width:100%;margin : 0 auto">
                                              <label for="score1" class="col-sm-3 control-label"><?php echo $donnees['equipe1']; ?></label>
                                              <div class="col-sm-2">
                                                <input type="number" class="form-control scoreInput" name="score1" id="score1" value="" required>
                                              </div>
                                                <div class="col-sm-2" style="text-align:center;font-style:bold;font-size:25px;font-weight: bold;margin-top:5px;"> - </div>
                                              <div class="col-sm-2">
                                                <input type="number" class="form-control scoreInput" name="score2" id="score2" value="" required>

                                              </div>
                                              <label for="score2" class="col-sm-3 control-label" style="text-align: left;"><?php echo $donnees['equipe2']; ?></label>
                                            </div>


                                            <div class="box-footer" style="text-align:center;margin-top: 30px;">
                                                <input type="hidden" name="slug" value="one match">
                                                <input type="hidden" name="match_id" value="<?php echo $match ?>">
                                                <button type="submit" class="btn btn-primary" style="font-style:bold;padding:10px 30px;">Scorer</button>
                                            </div>
                                        <?php echo "</div>"; ?>
                                        <?php }
                                        else{ /*===============================================================================*/
                                        ?>


                                        <div class="form-group">
                                          <label for="championnatSelector" class="col-sm-2 control-label">Championnat</label>
                                          <div class="col-sm-4">
                                            <select  id ="championnatSelector" name="championnatSelector" class="form-control">
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
                                          <div class="col-sm-5">
                                                <div id="ajaxSelectMatch">
                                                </div>
                                            </div>
                                        </div>
                                        <div id="ajaxScore"></div>

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




    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>


    <script>
        jQuery(document).ready( function(){
           // $('#formAjax').css('display','none');
            //$('#scoreBlock').css('display','none');

            /*========================SELECT CHAMPIONNAT =============================*/
            $("#championnatSelector").change(function(){
                var championnat= $(this).val();
                console.log(championnat);
                $('#ajaxSelectMatch, #ajaxScore').html("");

                $.ajax({
                    url:'pages/ajax_matchs.php',
                    type:'GET',
                    data:{championnat:championnat, slug:"all matchs"},
                    dataType:'json',
                    success:function(data){
                        var length = data.length;
                        if(data.Error =='Il n\'a pas d\'equipe dans ce championnat'){
                            $('#ajaxInfos').append(data.Error);
                            //
                            return false;
                        }
                        console .log(data);
                        var options='';
                        for(i=0;i<length;i++){
                            options=options+ '<option value ="'+data[i].id+'"> J: '+data[i].journee+' | '+data[i].date +' | '+data[i].heure+' | '+data[i].equipe1+' vs '+data[i].equipe2+'   </option>';


                        }
                        var selectMatch ='<select  id ="matchSelector" name="match_id" class="form-control"><option value="" disabled selected>Selectionner le match</option>'+options+'</select>';
                       //$('#formAjax').css('display','block');
                        $('#ajaxSelectMatch').append(selectMatch);


                        /*========================SELECT Match =============================*/
                        $("#matchSelector").change(function(){
                            var match_id = $(this).val();
                            console.log(match_id);
                            $('#ajaxScore').html("");

                            $.ajax({
                                url:'pages/ajax_matchs.php',
                                type:'GET',
                                data:{match_id:match_id, slug:'one match'},
                                dataType:'html',
                                success:function(data){
                                    var length = data.length;
                                    if(data.Error =='Il n\'a pas d\'equipe dans ce championnat'){
                                        $('#ajaxInfos').append(data.Error);
                                        //
                                        return false;
                                    }
                                    console .log(data);
                                    $('#ajaxScore').html(data);
                                },
                                error:function(xhr,textStatus,errorThrown){
                                    alert(xhr.responseText);
                                }

                            });
                        });


                        //$('#datesFormation').css('visibility','visible');
                    },
                    error:function(xhr,textStatus,errorThrown){
                        alert(xhr.responseText);
                    }

                });
            });






            /*-------------------------calendar-----------------------------------*/

            });

    </script>

</body>

</html>
