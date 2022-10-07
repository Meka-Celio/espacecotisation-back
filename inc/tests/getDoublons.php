<?php 
	require '../app.soapClient.php';
	require '../model.collection.php';

	if (isset($_POST['submit']))
	{
		$cin = $_POST['CIN'];
		$searchTurple = searchTurple($cin);
		if ($searchTurple)
		{
			$turples 		= 	getTurple($cin);
			$response 		= 	getInfoMedecin($cin);
			$infoMedecin 	=	$response->GetInfoMedecinAvecAuthResult;
		}

	}

 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Get Doublons</title>
	<link rel="stylesheet" href="">
</head>
<body>
	<div>
		<form action="#" method="post">
			<input type="text" name="CIN" value="" placeholder="CIN du médecin">
			<input type="submit" name="submit" value="Voir">
		</form>
	</div>

	<h2>Original</h2>
	<div class="col-md-6">
		<div class="card">
			<div class="col-md-4"></div>
			<div class="col-md-8">
				<h4><?php echo $infoMedecin->Cin ?></h4>
				<div class="ligne-1">
					<p>Nom : <b><?php echo $infoMedecin->NomComplet ?></b></p>
					<p>Email : <b><?php echo $infoMedecin->Email ?></b></p>
					<p>Gsm : <b><?php echo $infoMedecin->TelephoneMobile ?></b></p>
				</div>

				<div class="ligne-2">
					<p>Adresse pro : <b><?php echo $infoMedecin->AdressePro ?></b></p>
					<p>Date de recrutement/installation : <b><?php echo $infoMedecin->DateRecrutement_Installation ?></b></p>
				</div>

				<div class="ligne-3">
					<p>Province : <b><?php echo $infoMedecin->LibelleProvince ?></b></p>
					<p>Region : <b><?php echo $infoMedecin->LibelleRegion ?></b></p>
					<p>Telephone : <b><?php echo $infoMedecin->Telephone ?></b></p>
				</div>

				<div class="ligne-4">
					<p>Date du Diplome : <b><?php echo $infoMedecin->DateDiplome ?></b></p>
					<p>Secteur Médecin : <b><?php echo $infoMedecin->SecteurMedecin ?></b></p>
					<p>Spécialité : <b><?php echo $infoMedecin->SpecialiteMedecin ?></b></p>
				</div>
			</div>
		</div>
	</div>

	<h2>Turples</h2>
	<?php foreach ($turples as $double) { ?>
		<div class="col-md-4">
			<div class="card">
				<div class="user-img col-md-4"></div>
				<div class="user-info col-md-8">
					<h4><?php echo $double->CINMedecin ?></h4>
					<div class="ligne-1">
						<p>Nom : <b><?php echo $double->Nom_Medecin ?></b></p>
						<p>Email : <b><?php echo $double->Email ?></b></p>
					</div>

					<div class="ligne-2">
						<p>Province : <b><?php echo $double->NomProvince ?></b></p>
						<p>Région : <b><?php echo $double->NomRegion ?></b></p>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>



<!-- 

 ["ID_Medecin"]=>
  string(5) "23635"
  ["CINMedecin"]=>
  string(7) "QA77539"
  ["Nom_Medecin"]=>
  string(17) "Dr MUSTAPHI Ilham"
  ["Email"]=>
  string(0) ""
  ["Pwd"]=>
  string(5) "12345"
  ["Telephone"]=>
  string(0) ""
  ["IdProvince"]=>
  string(2) "47"
  ["NomProvince"]=>
  string(9) "Marrakech"
  ["IdRegion"]=>
  string(1) "7"
  ["NomRegion"]=>
  string(16) "Marrakech - Safi"
  ["Date_Inscription"]=>
  string(10) "2021-10-04"
  ["Date_Modification"]=>
  NULL

 -->

</body>
</html>