<?php 
	$n = 500;
	$taux = 0.0136;
	$x = round(($n/98.68)*100*$taux, 2);
	$y = $n+$x;

	echo 'Frais : '.$x. 'pour '.$n.' dh';
	echo '<br> Le montant + les frais = '.$y;
	echo '<br> Si on enlève les frais = '.($y - $x);

	if (isset($_POST['submit'])) 
	{
		$m 			= $_POST['montant'];
		$frais 		= round(($m/98.68)*100*$taux,2);
		$montant 	= $frais + $m;
	}
	
 ?>


<form action="#" method="post">
	<input type="number" name="montant" value="" placeholder="Montant">
	<input type="submit" name="submit" value="Calcul">
</form>


<?php if (isset($montant)) { ?>
	<p>Les frais : <?php echo $frais ?></p>
	<p>Le montant est de : <?php echo $montant ?></p>
	<p>Le montant - les frais est de <?php echo $montant-$frais //round($montant-($montant*$taux), 0) ?></p>
	<?php } ?>