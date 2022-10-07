<?php
	require '../app.soapClient.php';
	require '../model.collection.php';

	if (isset($_POST['CINMedecin'])) {
		$CINMedecin = $_POST['CINMedecin'];

		// Appel à la fonction
		$response = getInfoMedecin($CINMedecin);

		echo "<pre>";
		var_dump($response);
		echo "</pre>";

		if (!empty($response)) {
			$medecin = $response->GetInfoMedecinAvecAuthResult;
		} else {
			echo 'Non Trouvé !';
		}
	}

	// $action = updateMedecin($medecin->Email, $medecin->TelephoneMobile, $medecin->LibelleProvince, $medecin->LibelleRegion, date('Y-m-d'));

	if (isset($_POST['submit'])) {
		echo 'submit';
	}



?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Test Webservice</title>
	<link rel="stylesheet" href="">

	<style>
		th, td {
			border: 1px solid #000;
		}
		td {
			padding: 5px;
		}
	</style>
</head>
<body>
	<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
	<input type="text" name="CINMedecin" value="" placeholder="CIN" required>
	<button>Valider</button>
</form>

<?php 
/*
Cin, NomComplet, LibelleProvince, LibelleCommune, AdressePro, Telephone, Email, LibelleRegion, TelephoneMobile, SecteurMedecin, SpecialiteMedecin, DateDiplome, DateRecrutement_Installation

*/
 ?>

<div class="card">
	
</div>

<table>
	<?php var_dump($medecin); ?>
	<thead>
		<tr>
			<th>CIN</th>
			<th>Nom</th>
			<th>Email</th>
			<th>Telephone</th>
			<th>Province</th>
			<th>Region</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<?php if(isset($medecin)) { ?>
				<td><?= $medecin->Cin ?></td>
				<td><?= $medecin->NomComplet ?></td>
				<td><?= $medecin->Email ?></td>
				<td><?= $medecin->Telephone ?></td>
				<td><?= $medecin->LibelleProvince ?></td>
				<td><?= $medecin->LibelleRegion ?></td>
			<?php } else { ?>
				<td colspan="6">Cette CIN ne correspond à aucun médecin</td>
			<?php } ?>
		</tr>
	</tbody>
	<tfoot>
		<form class="" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">

			<input type="hidden" name="CINMedecin" value="<?= $medecin->Cin ?>">
			<input type="hidden" name="Nom_Medecin" value="<?= $medecin->NomComplet ?>">
			<input type="hidden" name="Email" value="<?= $medecin->Email ?>">
			<input type="hidden" name="Telephone" value="<?= $medecin->Telephone ?>">
			<input type="hidden" name="NomProvince" value="<?= $medecin->LibelleProvince ?>">
			<input type="hidden" name="NomRegion" value="<?= $medecin->LibelleRegion ?>">

			<tr>
				<td colspan="6">
						<input type="submit" name="submit" value="ajouter">
				</td>
			</tr>
		</form>
	</tfoot>
</table>
</body>
</html>
