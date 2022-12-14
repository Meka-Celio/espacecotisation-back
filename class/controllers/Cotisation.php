<?php

namespace controllers;

class Cotisation extends Controller
{
	protected $modelName = \models\Transaction::class;

	public function add ()
	{	
		$alert = "";

		if (isset($_GET['note']))
		{
			$codeAlert 	= $_GET['note'];
			$alert 		= \Alert::getAlert($codeAlert);
		}

        $pageTitle = "Enregistrer une cotisation";
        \Renderer::render('views/addCotisation', compact('pageTitle', 'alert'));
	}

    public function insert ()
    {
		$cin 				= 	"";
		$nCommande 			= 	"";
		$idCotisation 		= 	"";
		$anneeCotisation 	=	"";

		

		// VALIDATION DU FORMULAIRE
		// SI FORM
		if (isset($_POST['submit']))
		{
			// VERIFICATION DES DONNEES
			// SI CIN
			if (empty($_POST['cin']))
			{	
				$note = "noCin";
				\Http::redirect ("index.php?c=cotisation&task=add&note=$note");
			}
			// SINON
			else 
			{
				$cin = $_POST['cin'];
			}

			// SI NCOMMANDE
			if (empty($_POST['nCommande']))
			{
				$note = "nCommandeNum";
				\Http::redirect ("index.php?c=cotisation&task=add&note=$note");
			}
			// SINON
			else 
			{
				$nCommande = $_POST['nCommande'];
			}

			// SI ANNEES COCHEES
			if (isset($_POST['idCotisation']))
			{
				$idCotisation = implode(',', $_POST['idCotisation']);
			}
			// SINON
			else 
			{
				$note = "noYearsAdd";
				\Http::redirect ("index.php?c=cotisation&task=add&note=$note");
			}

			// VERIFICATION EXISTENCE DE LA CIN DANS MARIT
			$getInfoMedecin = \Marit::getInfoMedecin($cin);
			if ($getInfoMedecin)
			{
				// VERIFICATION DU NCOMMANDE DANS LES TRANSACTIONS
				$transaction = $this->model->findBySearch('n_commande', $nCommande);
				if ($transaction)
				{
					if ( $anneeCotisation == $transaction->anneesPayees)
					$query = \Marit::AjoutCotisation($cin, $nCommande, $idCotisation);
					echo '<pre>';
					var_dump($query);
					echo '</pre>';
				}
				else 
				{
					$note = "noTransactionFind";
					\Http::redirect ("index.php?c=cotisation&task=add&note=$note");
				}
			}
			else 
			{
				$note = "noExistCin";
				\Http::redirect ("index.php?c=cotisation&task=add&note=$note");
			}
		}
		// SINON
		else 
		{
			$note = "noForm";
			\Http::redirect ("index.php?c=cotisation&task=add&note=$note");
		}
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
