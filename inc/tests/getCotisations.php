<?php
	require '../app.soapClient.php';


function voirCotisationImpayees ($cinmedecin)
{
	
	$cotisationsNonPayer  = getCotisationNonPayer($cinmedecin);
  	$yearListNotPaid    =   $cotisationsNonPayer->GetCotisationNonPayerAvecAuthResult->MedecinCotisation->listeAnnee;

//   if (isset($yearListPaid->AnneeVM)) {
//     if (is_array($yearListPaid->AnneeVM)) {
//       $AllYearPaid = $yearListPaid->AnneeVM;
//       $LastYearPaid = $AllYearPaid[0];
//     }
//     else {
//       $LastYearPaid = $yearListPaid->AnneeVM;
//     }
//   }
//   else {
//     $LastYearPaid = (object)array(
//       'Annee' => 0,
//       'AnneeMontant'  => 0
//     );
//   }
	return $yearListNotPaid;
}
  
function voirCotisationsPayees ($cin) 
{
	$cotisationsPayer     = getCotisationPayer($cin);
	$yearListPaid       =   $cotisationsPayer->GetCotisationPayerAvecAuthResult->MedecinCotisation->listeAnnee;
	
	
	return $yearListPaid;
}

$impayees = voirCotisationImpayees('BE869839');

$AnneeVMPaid = voirCotisationsPayees('D139249');


?>


<table>
	<thead>
		<tr>
			<td>Années</td>
			<td>Montant</td>
		</tr>
		<tr>
			
		</tr>
	</thead>
	<tbody>
		<?php if (isset($yearListPaid->AnneeVM)) { ?>

			<?php $AnneeVMPaid = $yearListPaid->AnneeVM;
				if(is_array($AnneeVMPaid))  { ?>
				<?php for($i=0; $i<count($AnneeVMPaid);$i++) { ?>

				<?php } ?>
			<?php } ?>

		<?php } ?>
	</tbody>
</table>
