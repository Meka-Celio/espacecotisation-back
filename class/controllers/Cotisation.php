<?php

namespace controllers;

class Cotisation extends Controller
{
	protected $modelName = \models\Transaction::class;

	public function index ()
	{
		/**
		 * 2. Récupération des exemples
		 */
		$exemples = $this->model->findAll("created_at DESC");

		/**
		 * 3. Affichage
		 */
		$pageTitle = "Accueil";

		\Renderer::render('exemples/index', compact('pageTitle', 'exemples'));
	}

	public function add ()
	{
        $pageTitle = "Enregistrer une cotisation";
        \Renderer::render('views/addCotisation', compact('pageTitle'));
	}

    public function insert ()
    {

    }

	public function getRecu ()
	{
		$cin 				= "";
		$ncommande 			= "";
		$transaction_id 	= "";

		$maritMedecin		= null;
		$recusPaiement		= null;

		if (!empty($_POST['submit'])) 
		{
			$transaction_id 	= $_POST['id'];
			$transaction 		= $this->model->find($transaction_id);

			$ncommande 			= $transaction['n_commande'];
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
