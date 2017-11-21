<div id="wrapper-ajax" style="min-width:400px;">
    <div id="page-wrapper">

        <div class="container-fluid">
            
            <?php 
                require_once('connexion.php');
            
                $id = $_GET['id'];

                $query ='SELECT * FROM championnat where championnat.id =:id';
                $handler = $bdd->prepare($query);
                $handler->execute(array(':id' => $id));
                $donnees=$handler->fetchAll();
                foreach ($donnees as  $donnee) {
                    echo '<h1 style="font-size:30px;text-align:center;margin-bottom:40px;"> Championnat : '.$donnee['name'].'</h1>';
                }
            ?>

            <div class="tabs1 championnat">
                <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Classement</h3>
                <table class="table table-bordered table-hover table-striped" style="text-align: center;">
                    <thead style="text-align: center; background:#4C85AF;">
                        <tr style="text-align: center; background:#4C85AF;">
                            <th>N°</th>
                            <th>Equipes</th>
                            <th>Pts</th>
                            <th>J</th>
                            <th>V</th>
                            <th>N</th>
                            <th>P</th>
                            <th>Bp</th>
                            <th>Bc</th>
                            <th>Diff</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php 
                        $ch = $_GET['id'];
                        $query ='SELECT * FROM classement where championnat_id =:ch  ORDER BY pts DESC, n ASC';
                       

                        $handler = $bdd->prepare($query);
                        $handler->execute(array(':ch' => $ch));
                        $donnees=$handler->fetchAll();
                        $nbr =1;

                        foreach ($donnees as  $donnee) {
                            echo '<tr> ';
                                echo '<td><b>'.$nbr.'</b></td>';
                                echo '<td>'.$donnee['equipe'].'</td>';
                                echo '<td style="color:#f30d0b;">'.$donnee['pts'].'</td>';
                                echo '<td>'.$donnee['mj'].'</td>';
                                echo '<td>'.$donnee['g'].'</td>';
                                echo '<td>'.$donnee['n'].'</td>';
                                echo '<td>'.$donnee['p'].'</td>';
                                echo '<td>'.$donnee['bp'].'</td>';
                                echo '<td>'.$donnee['bc'].'</td>';
                                echo '<td>'.$donnee['db'].'</td>';
                            echo '</tr>';
                            $nbr++;
                        }
                        ?>
                    </tbody>
                                    
                </table>
            </div>
            <!-- /.tabs1 championnat -->


            <div class="tabs2 derniers-resultats">
                <h3 class="panel-title"> Prochains matchs</h3>
                <table class="table ">
                    <tbody>
                       <?php 
                        $ch = $_GET['id'];
                        $reponse = $bdd->query('SELECT match.id, championnat.name as championnat,  eq1.name as equipe1, eq2.name as equipe2, 
                                            match.score1, match.score2,  match.date, match.heure, match.journee, match.etat   from `match`
                                            INNER JOIN championnat ON championnat.id = match.championnat_id
                                            INNER JOIN equipe  as eq1 ON eq1.id = match.equipe1
                                            INNER JOIN equipe  as eq2 ON eq2.id = match.equipe2
                                             WHERE championnat.id = '.$_GET["id"].' AND match.etat = 0
                                             AND `date` >= CURDATE() 
                                            order by date ASC, heure ASC LIMIT 3');
                        while($donnees=$reponse->fetch()){
                                echo '<tr><td>
                                	<b>'.$donnees['equipe1'].' - '.$donnees['equipe2'].'</b>';
                                $dateY = date("d/m/Y",strtotime($donnees['date']));
                                echo '<br>'.$dateY.' : '.$donnees['heure'];
                                echo '<br>'.$donnees['journee'].'ème journée';
                            echo '</td></tr>';
                        }
                        $reponse->closeCursor(); // Termine le traitement de la requête
                
                        ?>
                    </tbody>    
                </table>
            </div>
            <!-- /.tabs2 derniers-resultats-->

            <div class="tabs2 prochains-matchs">
                <h3 class="panel-title"> Derniers résultats</h3>
                <table class="table ">
                    <tbody>
                       <?php 
                        $reponse = $bdd->query('SELECT match.id, championnat.name as championnat,  eq1.name as equipe1, eq2.name as equipe2, 
                                            match.score1, match.score2,  match.date, match.heure, match.journee, match.etat   from `match`
                                            INNER JOIN championnat ON championnat.id = match.championnat_id
                                            INNER JOIN equipe  as eq1 ON eq1.id = match.equipe1
                                            INNER JOIN equipe  as eq2 ON eq2.id = match.equipe2
                                             WHERE championnat.id = '.$_GET["id"].' AND match.etat = 1
                                            order by date ASC, heure ASC LIMIT 3');
                        while($donnees=$reponse->fetch()){
                                echo '<tr><td>
                                	<b>'.$donnees['equipe1'].'</b> '.$donnees['score1'].' - '.$donnees['score2'].'<b> '.$donnees['equipe2'].'</b>';
                                $dateY = date("d/m/Y",strtotime($donnees['date']));
                                echo '<br>'.$dateY .' : '.$donnees['heure'];
                                echo '<br>'.$donnees['journee'].'ème journée';
                            echo '</td></tr>';
                        }
                        $reponse->closeCursor(); // Termine le traitement de la requête
                
                        ?>
                    </tbody>    
                </table>
            </div>
            <!-- /.tabs2 prochains-matchs-->

            <hr/>
            <div class="all-matchs">
                <h3 class="panel-title"> Tous les matchs à venir</h3>
                <table class="table ">
                    <tbody>
                       <?php 
                        $ch = $_GET['id'];
                        $reponse = $bdd->query('SELECT match.id, championnat.name as championnat,  eq1.name as equipe1, eq2.name as equipe2, 
                                            match.score1, match.score2,  match.date, match.heure, match.journee, match.etat   from `match`
                                            INNER JOIN championnat ON championnat.id = match.championnat_id
                                            INNER JOIN equipe  as eq1 ON eq1.id = match.equipe1
                                            INNER JOIN equipe  as eq2 ON eq2.id = match.equipe2
                                             WHERE championnat.id = '.$_GET["id"].' AND match.etat = 0
                                             AND `date` >= CURDATE() 
                                            order by date ASC, heure ASC');
                        $day=1;$nbr=1;
                        while($donnees=$reponse->fetch()){
                                if($nbr>1 && ($donnees['journee'] !=$day)){
                                    echo '<tr><td class="new-day">';
                                }
                                else{echo '<tr><td>';}
                                $day=$donnees['journee'];
                                $nbr++;

                                echo '<b>'.$donnees['equipe1'].' - '.$donnees['equipe2'].'</b>';
                                $dateY = date("d/m/Y",strtotime($donnees['date']));
                                echo '<br>'.$dateY.' : '.$donnees['heure'];
                                echo '<br>'.$donnees['journee'].'ème journée';
                            echo '</td></tr>';
                        }
                        $reponse->closeCursor(); // Termine le traitement de la requête
                
                        ?>
                    </tbody>    
                </table>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
