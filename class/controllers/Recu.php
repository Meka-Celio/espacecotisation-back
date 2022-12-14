<?php

namespace Controllers;

class Recu extends Controller
{
	protected $modelName = \models\Transaction::class;

	public function show ()
	{
		/**
		 * 3. Affichage
		 */
		$pageTitle = "Génération de reçu de paiement";

		\Renderer::render('views/createRecu', compact('pageTitle'));
	}


	public function create ()
	{
		$cin 				= "";
		$ncommande 			= "";
		$column 			= "transactions";

		$maritMedecin		= null;
		$recusPaiement		= null;

		if (!empty($_POST['submit'])) 
		{
			$ncommande 			= $transaction['n_commande'];
			$transaction 		= $this->model->findBySearch($transaction_id);
			$cin 				= $transaction['cin'];
			
			$getRecu = \Marit::GetRecuCotisation($ncommande, $cin); 
			$getRecuResponse = $getRecu->GetRecuCotisationPayerAvecAuthResult;

			if (isset($getRecuResponse->MedecinCotisationPayee)) 
			{ 
				$recusPaiement = $getRecu->GetRecuCotisationPayerAvecAuthResult->MedecinCotisationPayee;
				$getInfoMedecin = \Marit::getInfoMedecin($cin);
				$maritMedecin = $getInfoMedecin->GetInfoMedecinAvecAuthResult;
			}
		}
		else
		{
			echo "Aucun formulaire n'a été envoyé !";
		}

		$pageTitle = "Transaction N° $ncommande";

		\Renderer::render('views/transaction-show', compact('pageTitle', 'transaction', 'transaction_id', 'recusPaiement', 'maritMedecin'));
	} 

}
