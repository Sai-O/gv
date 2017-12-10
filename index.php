<?php require_once('connexion.php'); ?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
		<meta charset="UTF-8">
		<meta name="google" content="notranslate">
		<meta name="description" content="est un regroupement d'associations qui organise plusieurs catégories de Championnats de Futsal ">
		<meta name="keywords" content="futsal, uaff, goussainville, foot, footbal,">

		<title>UAFF | Union des Associations de Futsal Français</title>

		<link rel="icon" type="image/ico" href="assets/img/favicon.ico">
		<link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">
		<link rel="icon" href="/favicon.ico" type="image/x-icon">
		<link rel="stylesheet" type="text/css" href="assets/css/icones.css">
		<link rel="stylesheet" type="text/css" href="assets/css/stylesheet.css">

		<!-- ================== FOR AJAX LIGHTBOX =================== -->
		<!-- Add jQuery library -->
		<script type="text/javascript" src="assets/fancybox/lib/jquery-1.10.2.min.js"></script>

		<!-- Add mousewheel plugin (this is optional) -->
		<script type="text/javascript" src="assets/fancybox/lib/jquery.mousewheel.pack.js?v=3.1.3"></script>

		<!-- Add fancyBox main JS and CSS files -->
		<script type="text/javascript" src="assets/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
		<link rel="stylesheet" type="text/css" href="assets/fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />
		<!-- ================== END FOR AJAX LIGHTBOX =================== -->
	</head>

	<body>

		<section id="switch">
		<section class="ct">
			<ul>

				<li><a title="Jeu steam gratuit" href="#">Union des Associations de Futsal Français</a></li>

			</ul>
		</section>
	</section>


		<div id="action"></div>
		<a data-nav=""></a>

		<section id="top" style="">
			<section class="ct">
				<nav role="navigation" style="top: -400px; opacity: 0;">
					<section>
						<ul id="nav">
							<li class="active"><a data-go="#top" title="Revenir à l'accueil du site">Accueil</a></li>
							<li class=""><a data-go="#game" title="Jeux à gagner dans les box">Championnats</a></li>
							<li class=""><a data-go="#chance" title="Présentation du service">Actus</a></li>
							<li class=""><a data-go="#avis" title="Acheter une box gaming">Galerie</a></li>

						</ul>
					</section>
				</nav>
				<header id="welcome" role="header">
					<img id="logotype" alt="uaff logo" src="assets/img/playhappyclub-phc_logo.png">


					<h2 id="one" style="color:#fff;">Nos prochains matchs</h2>

					<div id="next-matchs">
					<?php
					$today = date('Y-m-d');
                            $reponse = $bdd->query('SELECT match.id, championnat.name as championnat,  eq1.name as equipe1, eq2.name as equipe2,
                                                match.score1, match.score2,  match.date, match.heure, match.journee, match.etat from `match`
																								INNER JOIN championnat ON championnat.id = match.championnat_id
                                                INNER JOIN equipe  as eq1 ON eq1.id = match.equipe1
                                                INNER JOIN equipe  as eq2 ON eq2.id = match.equipe2

                                                WHERE `date` >= CURDATE() AND etat =0
                                                order by date ASC, heure ASC LIMIT 3');
                            while($donnees=$reponse->fetch()){
                            	?>
                            	<div class="next-date">
                            		<p class="champ"><?php echo 'Championnat : '.$donnees['championnat'];  ?></p>
                            		<p class="journee"><?php  echo $donnees['journee'].'ème journée'; ?></p>
                            		<p class="equipes"><?php echo'<b>'.$donnees['equipe1'].' - '.$donnees['equipe2'].'</b>'; ?></p>
                    				<p class="date"><?php echo 'Le '.date("d/m/Y",strtotime($donnees['date'])) .' à '.$donnees['heure']; ?></p>

                            	</div>
                            	<?php
                            }
                            $reponse->closeCursor(); // Termine le traitement de la requête
                     ?>
					</div>

				</header>
			</section>
		</section>
		<section id="game" style="">
			<ul>
					<?php
					$reponse = $bdd->query('SELECT id, name FROM championnat');
					while($donnees=$reponse->fetch()){

						$championnat_image = str_replace("uaff u", "u_", $donnees['name']);
						?>
						<li style="background-image:url('assets/img/championnats/<?php echo $championnat_image ?>.jpg');">
							<a href="ajax.php?id=<?php echo $donnees['id'];?>" class="fancybox fancybox.ajax">
								<figure>
									<figcaption>
									</figcaption>
								</figure>
							</a>
						</li>
						<?php
					}
					?>
<br>
<br>
<br>
<br>
<br>

			</ul>
		</section>
		<section id="chance" style="">
			<section class="ct">
				<h2> <span style="color:#fff;"><strong>UAFF</strong><br> est un regroupement d'associations <br>qui organise plusieurs catégories de </span><br><br><strong class="r">Championnats de Futsal</strong><br><span style="color:#fff;"><br>Ile-de-France</span></h2>

			</section>
		</section>
		<section id="comment">
			<section class="ct">
				<section>
					<?php
                        $query='SELECT * FROM article  WHERE active=1 and top = 1 ORDER BY id DESC LIMIT 1';
                        $reponse = $bdd->query($query);
                        while($donnees=$reponse->fetch()){
                        ?>
                        <h2><?php echo html_entity_decode($donnees['title']); ?></h2>
                        <p><?php echo '<p>'.substr($donnees['content'],0, 400).' </p>'; ?></p>
                        <?php
                       }
                        $reponse->closeCursor(); // Termine le traitement de la requête
                    ?>
				</section>
				<img alt="uaff" src="assets/img/perso-rainbow.png" class="illu">
			</section>
		</section>
		<section id="avis" style="">
			<section class="ct">
				<ul>
					<?php
                        $query='SELECT * FROM article  WHERE active=1 and top = 0 ORDER BY id DESC LIMIT 3';
                        $reponse = $bdd->query($query);
                        while($donnees=$reponse->fetch()){
                            echo '<li><div class="note"> ';
                                echo '<h2><span>'.$donnees['title'].'</span></h2>';
                                $extract = substr($donnees['content'],0, 300);
                                echo '<p>'.$extract.' </p>';
                                echo '<span class="author"> Article rédigé par <strong>'.$donnees['auteur'].'</strong></span>';
                            echo '</div></li>';
                        }
                        $reponse->closeCursor(); // Termine le traitement de la requête
                    ?>

				</ul>
			</section>
		</section>
<!--
		<section>
			<iframe width="420" height="315"
				src="https://www.youtube.com/embed/-yi1g17UyiI">
			</iframe>
		</section> -->

		<footer role="footer">
			<section class="ct">
				<p>© <strong><?php echo date('Y');?></strong> - Tout droits réservés.</p>
				<ul>
					<li><a title="Admin" href="admin/index.php">Admin</a></li>
				</ul>
			</section>
		</footer>



		<script type="text/javascript">
			$(document).ready(function() {


				$('.fancybox').fancybox();
				// Change title type, overlay closing speed
				$(".fancybox-effects-a").fancybox({
					helpers: {
						title : {
							type : 'outside'
						},
						overlay : {
							speedOut : 0
						}
					}
				});

			});
		</script>
		<style type="text/css">
			.fancybox-custom .fancybox-skin {
				box-shadow: 0 0 50px #222;
			}
			.fancybox-wrap{    width: 90% !important;   left:0!important; margin: 0 5% !important;}
			.fancybox-inner{width: 100% !important;}
			#wrapper-ajax h3{text-align: center;}
			table {
			    border-collapse: collapse;
			    width: 100%;
			}
			table, th, td {
			    border: 1px solid black;text-align: center;
			}
			tr:nth-child(even) {background-color: #f2f2f2}
			th {
			    background-color: #4CAF50;
			    color: white;
			}
			.tabs1, .tabs2{display: inline-block;}
			.tabs1{width: 45%;}
			.tabs2{width: 25%;}
			@media screen and (max-width: 1000px){
				body{font-size:11px;}
				.tabs1{width: 90%;}
				.tabs2{width: 90%;}

			}
		</style>

		<!-- <script type="text/javascript" src="assets/js/jquery-3.js"></script> -->
		<script type="text/javascript" src="assets/js/phc.js"></script>

</body></html>
