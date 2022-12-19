<?php

namespace controllers;

class Recu extends Controller
{
	protected $modelName = \models\Recu::class;

	public function index ()
	{
		$tabNbrRecu			=	$this->model->getNumberOf();
		$nbrRecu 			=	(int)$tabNbrRecu[0]['NumberOf'];
		$msgAlert 			= 	"";
		$elementByPage 		= 	20;
		$nbrPages			=   ceil($nbrRecu / $elementByPage);
		

		if (isset($_GET['note']))
		{
			$alert = \Alert::getAlert($_GET['note']);
		}
		else 
		{
			$alert 				=	'';
		}


		if (isset($_GET['page']))
		{
			if ($_GET['page'] > 0)
			{
				$currentPage 	= $_GET['page'];
			}
			else
			{
				$currentPage 	= 1;
				$msgAlert		=	"Cette page n'existe pas !";
			}

			if ($nbrPages < $currentPage)
			{
				$currentPage = $nbrPages;
			}
		}
		else
		{
			$currentPage 	= 1;
		}

		$recus 		= 	$this->model->findAllByLimit($currentPage, $elementByPage, 'date_recu DESC');
		
		if (empty($recus)){
			$currentPage 	= 	$nbrPages;
			$recus 			= 	null;
			$msgAlert		=	"Cette page n'existe pas !";
		}
		/**
		 * 3. Affichage
		 */
		$pageTitle = "Reçus de paiement";

		\Renderer::render('views/recu', compact('pageTitle', 'recus', 'currentPage', 'nbrRecu', 'msgAlert', 'nbrPages', 'alert'));
	}

	public function show ()
	{

		if (isset($_GET['note']))
		{
			$alert = \Alert::getAlert($_GET['note']);
		}
		else 
		{
			$alert 				=	'';
		}

		/**
		 * 3. Affichage
		 */
		$pageTitle = "Génération de reçu de paiement";

		\Renderer::render('views/findRecu', compact('pageTitle', 'alert'));
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

	public function find ()
	{
		$cin 			= 	null;
		$nCommande 		=	null;
		$mMedecin 		=	null;
		$recusPaiement 	=	null;

		if (!empty($_POST['cin']))
		{
			$cin = $_POST['cin'];
		}
		
		if (!empty($_POST['nCommande'])) 
		{
			$nCommande = $_POST['nCommande'];
		}

		$_getInfoMedecin = \Marit::getInfoMedecin($cin);
		if (isset($_getInfoMedecin->GetInfoMedecinAvecAuthResult))
		{
			$mMedecin 			= 	$_getInfoMedecin->GetInfoMedecinAvecAuthResult;
			$_getRecuCotisation =	\Marit::GetRecuCotisation($nCommande, $cin); 
			if (isset($_getRecuCotisation->GetRecuCotisationPayerAvecAuthResult->MedecinCotisationPayee))
			{
				$recusPaiement = $_getRecuCotisation->GetRecuCotisationPayerAvecAuthResult->MedecinCotisationPayee;
				$alert = \Alert::getAlert('okRecuGet');

				/*  
				["TypeCotisation"]=> string(19) "Cotisation Annuelle" ["CINMedecin"]=> string(7) "A716970" 
				["ModeVersement"]=> string(17) "Paiement en ligne" ["NumRecuTransaction"]=> string(17) "WRSK0874693520726" 
				["NumRecuGenere"]=> string(12) "10000C22/RSK" ["NomMedecin"]=> string(6) "BENALI" ["PrenomMedecin"]=> string(5) "Anass" 
				["AdresseMedecin"]=> string(42) "Hôpital Militaire D'instruction Mohamed V" ["AnneeCotisation"]=> string(4) "2020" 
				["MontantCotisation"]=> string(3) "500" } 
				*/
				$pageTitle = "Reçu de paiement trouvé";

				\Renderer::render('views/findRecu', compact('pageTitle', 'recusPaiement', 'cin', 'nCommande', 'mMedecin', 'alert'));
			}
			else {
				\Http::redirect('index.php?c=recu&task=show&note=noRecuGet');
			}
		}
		else 
		{
			\Http::redirect('index.php?c=recu&task=show&note=noExistCin');
		}
	}

}
