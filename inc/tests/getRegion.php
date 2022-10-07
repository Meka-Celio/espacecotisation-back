<?php 

require '../model.collection.php';
require '../app.soapClient.php';

	if (isset($_POST['submit'])) 
	{
		$CINMedecin = 	$_POST['CINMedecin'];
		// $Region 	=	$_POST['Region'];

		$infoMecedin = getInfoMedecin($CINMedecin);
		$medecin = $infoMecedin->GetInfoMedecinAvecAuthResult;
		var_dump($medecin);

		$getRegion = getOneRegion($medecin->LibelleRegion);

		if ($getRegion)
		{
			echo '<pre>';
			var_dump($getRegion);
			echo '</pre>';
		}
	}

?>


<form action="#" method="post">
	<input type="text" name="CINMedecin" value="" placeholder="CIN">
	<!-- <input type="text" name="Region" value="" placeholder="REGION"> -->
	<input type="submit" name="submit" value="Rechercher">
</form>

<table>
	<thead>
		<tr>
			<th>Conventions</th>
			<th>Téléchargement</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>ACCORD DE PARTENARIAT ENTRE CNOM ET CHAABI</td>
			<td>
				<a href="https://cnom.ma/wp-content/uploads/2021/11/ACCORD-DE-PARTENARIAT-ENTRE-CNOM-ET-CHAABI.pdf">
					<img src="https://cnom.ma/wp-content/uploads/2019/10/Pdf.ico" alt="PDF_accord_partenaria_cnom-chaabi">
				</a>
				
			</td>
		</tr>
		<tr>
			<td>Convention de partenariat adhesion programme DATA-TIKA</td>
			<td>
				<a href="https://cnom.ma/wp-content/uploads/2021/11/convention-de-partenariat-adhesion-programme-DATA-TIKA.pdf">
					<img src="https://cnom.ma/wp-content/uploads/2019/10/Pdf.ico" alt="convention-de-partenariat-adhesion-programme-DATA-TIKA">
				</a>
			</td>
		</tr>
	</tbody>
</table>


<a href="https://cnom.ma/publications/"><div id="new"><span>Actualités CNOM</span></div></a><br/><h2>Nouvelles Conventions <strong>25-11-2021</strong>.</h2>
<a href="https://cnom.ma/partenaires/" class="button">Voir Publication....</a>
