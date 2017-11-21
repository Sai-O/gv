

<hr>
<?php 
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
    <button type="submit" class="btn btn-primary" style="font-style:bold;padding:10px 30px;">Scorer</button>
</div>