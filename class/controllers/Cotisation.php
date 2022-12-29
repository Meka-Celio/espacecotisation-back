<?php

namespace controllers;

class Cotisation extends Controller
{
	protected $modelName = \models\Cotisation::class;

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
				$transactionModel = new \models\Transaction();
				$transaction = $transactionModel->findBySearch('n_commande', $nCommande);
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

	public function check ()
	{
		/**
		 * Pour valider un enregistrement de cotisation à payer;
		 * il faut envoyer à la fonction de MARIT : 
		 * La CIN du médecin
		 * Le N°Commande 
		 * La liste sous forme de chaine de caractère en ordre croissant des ID de cotisation
		 * des années à payer
		 * @return array(CIN, n_commande, idCotisation)
		 */

		$transactionModel 	=	new \models\Transaction();
		$transaction_id		=	0;
		$transaction 		=	null;

		$cin 				= 	"";
		$n_commande 		= 	"";
		$anneesPayees		=	"";

		$lastYearNotPaid 	=	null;
		$firstYearNotPaid   =	null;
		$lastYearPaid 		=	null;

		if (isset($_POST['submit']))
		{
			// Récupération de la transaction à traiter
			if (!empty($_POST['transaction_id']))
			{
				$transaction_id = $_POST['transaction_id'];
			}
			else 
			{
				echo 'La transaction n\'a pas d\'identifiant et ne peut donc être définie !';
			}

			/**
			 * @var array $transaction 
			 * @var string cin
			 * @var string n_commande
			 * @var string anneesPayees
			 */

			$transaction 	= 	$transactionModel->find($transaction_id);
			$cin 			= 	$transaction['cin'];
			$n_commande 	= 	$transaction['n_commande'];
			$anneesPayees	=	$transaction['anneesPayees'];
			$reverse 		=	array_reverse(explode(',',$anneesPayees));
			$anneesPayees	=	implode(',', $reverse);


			/** ================================================
			 * Récupération des cotisations payées et non-payées
			 * ==================================================
			 */
			// Cotisation Payer ------------------------------
			/**
			 * @var string lastYearPaid
			 */
			$getCotisationPayer = \Marit::getCotisationPayer($cin);
			$yearsPaid          = $getCotisationPayer->GetCotisationPayerAvecAuthResult->MedecinCotisation->listeAnnee;
			if (isset($yearsPaid->AnneeVM))
			{
				if (is_array($yearsPaid->AnneeVM))
				{
					$cotisationPayer = $yearsPaid->AnneeVM;
					$reverseCotisationPayer = array_reverse($cotisationPayer);
					$lastYearPaid = $reverseCotisationPayer[count($cotisationPayer) - 1]->Annee;
				}
				else 
				{
					$lastYearPaid = $yearsPaid->AnneeVM->Annee;
				}
			}
			else 
			{
				$lastYearPaid = null;
			}

			// Cotisation NonPayer ---------------------------------
			/**
			 * @var string stringYearNotPaid
			 * @var string firstYearNotPaid
			 * @var string lastYearNotPaid
			 * @var int tailleStringYearNotPaid
			 */
			$getCotisationNonPayer = \Marit::getCotisationNonPayer($cin);
			$yearsNotPaid          = $getCotisationNonPayer->GetCotisationNonPayerAvecAuthResult->MedecinCotisation->listeAnnee;
			
			if (isset($yearsNotPaid->AnneeVM))
			{
				if (is_array($yearsNotPaid->AnneeVM))
				{
					$cotisationNonPayer = array();
					for ($i=0; $i<count($yearsNotPaid->AnneeVM); $i++)
					{
						if ($lastYearPaid < $yearsNotPaid->AnneeVM[$i]->Annee)
						{
							array_push($cotisationNonPayer, $yearsNotPaid->AnneeVM[$i]->Annee);
						}
					} 
					// Inverser le tableau des cotisations impayées
					$cotisationNonPayer = array_reverse($cotisationNonPayer);

					// Définir le 1er element du tableau comme 1ere année à régler 
					$firstYearNotPaid = $cotisationNonPayer[0];

					// Définir le dernier élément du tableau comme la dernière année à payer
					$lastYearNotPaid = $cotisationNonPayer[count($cotisationNonPayer) - 1];

					// Récupération de la taille de la chaine allant de a premiere année a payer à la derniere
					$stringYearNotPaid = implode(',',$cotisationNonPayer);
				}
				else 
				{	
					$cotisationNonPayer	=	$yearsNotPaid->AnneeVM->Annee;
					$lastYearNotPaid 	= 	$cotisationNonPayer;
					$firstYearNotPaid 	= 	$lastYearNotPaid;
					$stringYearNotPaid	=	(string)$cotisationNonPayer;
				}
				$tailleStringYearNotPaid = strlen($stringYearNotPaid);
			}
			else 
			{
				$note = "allCotPaid";
				\Http::redirect ("index.php?c=transaction&task=show&note=$note&id=$transaction_id");
			}

			// SI LA DERNIERE ANNEE EN DATE EST PAYEE
			if ($lastYearPaid == '2022') 
			{
				$note = "allCotPaid";
				\Http::redirect ("index.php?c=transaction&task=show&note=$note&id=$transaction_id");
			}

			/**
			 * =======================================================
			 * Vérification des années à payer
			 * =======================================================
			 * Varialbles concernées
			 * @var string stringYearNotPaid
			 * @var string firstYearNotPaid
			 * @var string lastYearNotPaid
			 * @var int tailleStringYearNotPaid
			 * 
			 * @var string cin
			 * @var string n_commande
			 * @var string anneesPayees
			 * =======================================================
			*/
			
			if (stristr($stringYearNotPaid, $anneesPayees))
			{
				// Récupérer le tableau des années à payer 
				// Faire une correspondance avec les id de cotisations
				$tabAnneesPayees = explode(',', $anneesPayees);

				$tabIdCotisation = array();
				$idCotisation = '';

				for ($i=0; $i < count($tabAnneesPayees); $i++)
				{
					$cotisation = $this->model->findBySearch('anneeCotisation', $tabAnneesPayees[$i]);
					array_push($tabIdCotisation, $cotisation['idCotisation']);
				}
				$idCotisation = implode(',',$tabIdCotisation);

				\Http::redirect ("marit/addCotisation.php?cin=$cin&n_commande=$n_commande&idCotisation=$idCotisation&transaction_id=$transaction_id");

			}
			else 
			{
				$note = "omitYearNotPaid";
				\Http::redirect ("index.php?c=transaction&task=show&note=$note&id=$transaction_id");
			}

			// $tabNbrTransactions	=	$this->model->getNumberOf();

			// $tabYearsMustPaid = array_reverse(explode(',',$anneesPayees));
			// $stringYearsMustPaid = implode(',', $tabYearsMustPaid);
			
			// $tabIdCotisationMustPaid = array();
			// $stringIdCotisationMustPaid = "";

			// $stringAnneesCotisation = 	implode(',', $tabAnneeCotisation);
			// $stringIdCotisation		=	implode(',', $tabIdCotisation);

			// // Chercher position dans une chaine
			// $position = strpos($stringAnneesCotisation, $lastYearPaid);
			// if ($position)
			// {
			// 	$stringAnneesCotisation = substr($stringAnneesCotisation, $position+5);
			// }

			// echo "Dernière année payée : ";
			// echo "<p> Chaine années restante pouvant être payer : $stringAnneesCotisation</p>";

			// // Ajouter les Id des cotisations
			// for ($z=0; $z<count($tabYears); $z++) {
			// 	if ($tabYears[$z] == '2009') {
			// 		array_push($TabIdCotisation, 25);
			// 	}
			// 	else if ($tabYears[$z] == '2010') { array_push($TabIdCotisation, 26); }
			// 	else if ($tabYears[$z] == '2011') { array_push($TabIdCotisation, 27); }
			// 	else if ($tabYears[$z] == '2012') { array_push($TabIdCotisation, 28); }
			// 	else if ($tabYears[$z] == '2013') { array_push($TabIdCotisation, 29); }
			// 	else if ($tabYears[$z] == '2014') { array_push($TabIdCotisation, 30); }
			// 	else if ($tabYears[$z] == '2015') { array_push($TabIdCotisation, 31); }
			// 	else if ($tabYears[$z] == '2016') { array_push($TabIdCotisation, 32); }
			// 	else if ($tabYears[$z] == '2017') { array_push($TabIdCotisation, 33); }
			// 	else if ($tabYears[$z] == '2018') { array_push($TabIdCotisation, 34); }
			// 	else if ($tabYears[$z] == '2019') { array_push($TabIdCotisation, 35); }
			// 	else if ($tabYears[$z] == '2020') { array_push($TabIdCotisation, 36); }
			// 	else if ($tabYears[$z] == '2021') { array_push($TabIdCotisation, 37); }
			// 	else { array_push($TabIdCotisation, 38); }
			// }


			// for ($i=0; $i < count($tabAnneeCotisation); $i++)
			// {
			// 	if ($tabYearsMustPaid[$i] == $tabAnneeCotisation[$i])
			// 	{	
			// 		array_push($tabIdCotisationMustPaid, $tabIdCotisation[$i]);
			// 		echo "Ajout de $tabIdCotisation[$i]<br><br>"; 
			// 	}
			// }

			// $stringIdCotisationMustPaid = implode(',', $tabIdCotisationMustPaid);

			// echo "<p> Tableau années a payer</p>";
			// var_dump($tabYearsMustPaid);

			// echo "<p> Tableau idCotisation a payer</p>";
			// var_dump($tabIdCotisationMustPaid);

			// echo "<p> Tableau des IdCotisations</p>";
			// var_dump($tabIdCotisation);

			// echo "<p> IDCotisation</p>";
			// var_dump($stringIdCotisationMustPaid);






		}
		else
		{
			echo 'Aucun formulaire n\'a été envoyé !';
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
