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
					// Récupération de la chaine années Payées
					$anneesPayees = $transaction['anneesPayees'];
					
					// Tableau recevant les anneesPayees de la transaction
					$reverseTabYears = explode(',', $anneesPayees);

					// Renverser le tableau
					$tabYears = array_reverse($reverseTabYears);

					// Tableau des ID de cotisations
					$TabIdCotisation = array();

					// Ajouter les Id des cotisations
					for ($z=0; $z<count($tabYears); $z++) {
						if ($tabYears[$z] == '2009') {
							array_push($TabIdCotisation, 25);
						}
						else if ($tabYears[$z] == '2010') { array_push($TabIdCotisation, 26); }
						else if ($tabYears[$z] == '2011') { array_push($TabIdCotisation, 27); }
						else if ($tabYears[$z] == '2012') { array_push($TabIdCotisation, 28); }
						else if ($tabYears[$z] == '2013') { array_push($TabIdCotisation, 29); }
						else if ($tabYears[$z] == '2014') { array_push($TabIdCotisation, 30); }
						else if ($tabYears[$z] == '2015') { array_push($TabIdCotisation, 31); }
						else if ($tabYears[$z] == '2016') { array_push($TabIdCotisation, 32); }
						else if ($tabYears[$z] == '2017') { array_push($TabIdCotisation, 33); }
						else if ($tabYears[$z] == '2018') { array_push($TabIdCotisation, 34); }
						else if ($tabYears[$z] == '2019') { array_push($TabIdCotisation, 35); }
						else if ($tabYears[$z] == '2020') { array_push($TabIdCotisation, 36); }
						else if ($tabYears[$z] == '2021') { array_push($TabIdCotisation, 37); }
						else { array_push($TabIdCotisation, 38); }
					}

					// Chaine d'identifiant
					$stringIdCotisation = implode(',', $TabIdCotisation);

					// Comparation de la chaine d'identifiant avec celle envoyée par le formulaire
					if ($idCotisation == $stringIdCotisation)
					{
						$query = \Marit::AjoutCotisation($cin, $nCommande, $idCotisation);
						if ($query) {
							$note = "okAddCotisation";
							\Http::redirect ("index.php?c=cotisation&task=add&note=$note");
						}
						else 
						{
							$note = "failAddQuery";
							\Http::redirect ("index.php?c=cotisation&task=add&note=$note");
						}
					}
					else 
					{
						$note = "noEqualsYears";
						\Http::redirect ("index.php?c=cotisation&task=add&note=$note");
					}
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
