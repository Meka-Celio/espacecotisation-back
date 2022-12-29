<?php

namespace controllers;

class Medecin extends Controller
{
	protected $modelName = \models\Medecin::class;

	public function index ()
	{
		/**
		 * 2. Récupération des medecins
		 * 15 à afficher avec pagination
		 */
		$tabNbrMedecins		=	$this->model->getNumberOf();
		$nbrMedecins 		= 	(int)$tabNbrMedecins[0]['NumberOf'];
		$msgAlert			=	"";

		$regionModel 			= 	new \models\Region();
		$specialiteModel 		=	new \models\Specialite();

		$regions 				=	$regionModel->findAll('id ASC');
		$specialites 			=	$specialiteModel->findAll('id ASC');

		$elementByPage 		= 20;
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
		}
		else
		{
			$currentPage 	= 1;
		}

		$nbrPages			=   ceil($nbrMedecins / $elementByPage);
		$medecins 			= 	$this->model->findAllByLimit($currentPage, $elementByPage, 'nom ASC');
		
		if (empty($medecins)){
			$currentPage 	= $nbrPages;
			$medecins 			= 	$this->model->findAllByLimit($currentPage, $elementByPage, 'nom ASC');
			$msgAlert		=	"Cette page n'existe pas !";
		}

		/**
		 * 3. Affichage
		 */
		$pageTitle = "Accueil";

		\Renderer::render('views/medecins', compact('pageTitle', 'medecins','nbrMedecins', 'elementByPage', 'currentPage', 'nbrPages', 'msgAlert', 'regions', 'specialites'));
	}


	public function show ()
	{
		/**
		 * 1. Récupération du param "id" et vérification de celui-ci
		 */
		// On part du principe qu'on ne possède pas de param "id"
		$medecin_id = null;

		// Mais si il y'en a un et que c'est un nombre entier, alors c'est cool
		if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
		    $medecin_id = $_GET['id'];
		}

		// On peut désormais décider : erreur ou pas ?!
		if (!$medecin_id) {
		    die("Vous devez préciser un paramètre `id` dans l'URL !");
		}
		/**
		 * 3. Récupération de l'exemple en question
		 * On va ici utiliser une requête préparée car elle inclue une variable qui provient de l'utilisateur : Ne faites
		 * jamais confiance à ce connard d'utilisateur ! :D
		 */
		$medecin = $this->model->find($medecin_id);

		$mMedecin = \Marit::getInfoMedecin($medecin['cin']); 
		$mMedecin = $mMedecin->GetInfoMedecinAvecAuthResult;

		$getCotisationNonPayer 	=	\Marit::getCotisationNonPayer($medecin['cin']);
		$getCotisationNonPayerResponse = $getCotisationNonPayer->GetCotisationNonPayerAvecAuthResult->MedecinCotisation->listeAnnee;

		$getCotisationPayer 	=	\Marit::getCotisationPayer($medecin['cin']);
		$getCotisationPayerResponse = $getCotisationPayer->GetCotisationPayerAvecAuthResult->MedecinCotisation->listeAnnee;
		$montantNonPayer 	= 	0;
		$montantCacher 		=	0;
		$montantRegler 		=	0;
		$lastyearPaid 		=	0;


		if (isset($getCotisationPayerResponse->AnneeVM))
		{
			$cotisationPayer = $getCotisationPayerResponse->AnneeVM;
			if (is_array($cotisationPayer))
			{
				$lastyearPaid = $cotisationPayer[0]->Annee;
				for ($y = 0; $y < count($cotisationPayer); $y++)
				{
					$montantRegler += $cotisationPayer[$y]->AnneeMontant;
				}
			}
			else
			{
				$lastyearPaid = $cotisationPayer->Annee;
				$montantRegler += $cotisationPayer->AnneeMontant;
			}
		}
		else
		{
			$cotisationPayer = null;
		}

		if (isset($getCotisationNonPayerResponse->AnneeVM))
		{
			$cotisationNonPayer = $getCotisationNonPayerResponse->AnneeVM;
			if (is_array($cotisationNonPayer))
			{
				for ($i = 0; $i < count($cotisationNonPayer); $i++) {
					if ($cotisationNonPayer[$i]->Annee > $lastyearPaid)
					{
						$montantNonPayer += substr($cotisationNonPayer[$i]->AnneeMontant, 7);
					}	
					else
					{
						$montantCacher += substr($cotisationNonPayer[$i]->AnneeMontant, 7);
					}
				}
			}
			else 
			{
				$montantNonPayer += substr($cotisationNonPayer->AnneeMontant, 7);
			}
		}
		else
		{
			$cotisationNonPayer = null;
			$this->model->update("situation", 1, $medecin['id']);
			$medecin = $this->model->find($medecin_id);
		}
 
		/**
		 * 5. On affiche 
		 */
		$pageTitle = 'Voir medecin - '.$medecin['nom_complet'];
		\Renderer::render ('views/medecin-show', compact('pageTitle', 'medecin', 'medecin_id', 'mMedecin', 'cotisationPayer', 'cotisationNonPayer', 'montantNonPayer', 'lastyearPaid', 'montantCacher', 'montantRegler'));
	}


	public function delete ()
	{

		/**
		 * 1. On vérifie que le GET possède bien un paramètre "id" (delete.php?id=202) et que c'est bien un nombre
		 */
		if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
		    die("Ho ?! Tu n'as pas précisé l'id de l'exemple !");
		}

		$id = $_GET['id'];

		/**
		 * 3. Vérification que l'exemple existe bel et bien
		 */
		$exemple = $this->model->find($id);
		if (!$exemple) {
		    die("L'exemple $id n'existe pas, vous ne pouvez donc pas le supprimer !");
		}

		/**
		 * 4. Réelle suppression de l'exemple
		 */
		$this->model->delete($id);

		/**
		 * 5. Redirection vers la page d'accueil
		 */
		\Http::redirect ('index.php');
	}

	public function insert ()
	{
		$exempleModel = new \Models\exemple();

		/**
		 * 1. On vérifie que les données ont bien été envoyées en POST
		 * D'abord, on récupère les informations à partir du POST
		 * Ensuite, on vérifie qu'elles ne sont pas nulles
		 */
		// On commence par l'author
		$author = null;
		if (!empty($_POST['author'])) {
		    $author = $_POST['author'];
		}

		// Ensuite le contenu
		$content = null;
		if (!empty($_POST['content'])) {
		    // On fait quand même gaffe à ce que le gars n'essaye pas des balises cheloues dans son commentaire
		    $content = htmlspecialchars($_POST['content']);
		}

		// Enfin l'id de l'exemple
		$other_id = null;
		if (!empty($_POST['other_id']) && ctype_digit($_POST['other_id'])) {
		    $other_id = $_POST['other_id'];
		}

		// Vérification finale des infos envoyées dans le formulaire (donc dans le POST)
		// Si il n'y a pas d'auteur OU qu'il n'y a pas de contenu OU qu'il n'y a pas d'identifiant d'exemple
		if (!$author || !$other_id || !$content) {
		    die("Votre formulaire a été mal rempli !");
		}

		$exemple = $exempleModel->find($other_id);

		// Si rien n'est revenu, on fait une erreur
		if (!$exemple) {
		    die("Ho ! L'exemple $other_id n'existe pas boloss !");
		}

		// 3. Insertion du commentaire
		$this->model->insert($author, $content, $other_id);

		// 4. Redirection vers l'exemple en question :
		\Http::redirect ('index.php?controller=exemple&task=show&id=' . $other_id);
	}

	public function find ()
	{	
		$pageTitle = "Recherche médecin";

		if (isset($_POST['submit']))
		{
			$keys 	= array_keys($_POST);
			$values = array_values($_POST);

			$column = "";
			$search = "";

			for ($i=0; $i < count($keys); $i++)
			{
				$column .= $keys[$i].',';
			}

			for ($i=0; $i < count($values); $i++)
			{
				$search .= $values[$i].',';
			}	

			$search = explode(',',$search);
			$column = explode(',', $column);

			$col0 = $column[0];
			$col1 = $column[1];
			$col2 = $column[2];
			$col3 = $column[3];
			$col4 = $column[4];

			$cin 		= $search[0];
			$nom 		= $search[1];
			$prenom 	= $search[2];
			$region 	= $search[3];
			$specialite = $search[4];
		}	
		else 
		{
			$col0 = 'cin';
			$col1 = 'nom';
			$col2 = 'prenom';
			$col3 = 'region';
			$col4 = 'specialite';

			$cin 		= $_GET['cin'];
			$nom 		= $_GET['nom'];
			$prenom 	= $_GET['prenom'];
			$region 	= $_GET['region'];
			$specialite = $_GET['specialite'];
		}

		$currentPage = (isset($_GET['page'])) ? $_GET['page'] : 1;
		$elementByPage = 20;

		$sql = "SELECT COUNT(id) AS NumberOf FROM medecins 
		WHERE 
		$col0 LIKE '%$cin%' AND 
		$col1 LIKE '%$nom%' AND 
		$col2 LIKE '%$prenom%' AND 
		$col3 LIKE '%$region%' AND 
		$col4 LIKE '%$specialite%'";

		$tabNbrMedecins 		= 	$this->model->countMedecinBySearch($sql);
		$nbrMedecins 			=	$tabNbrMedecins[0]['NumberOf'];
		$msgAlert			=	"";
		
		if ($currentPage <= 0) {
			$currentPage 	= 1;
			$msgAlert		=	"";
		}

		$nbrPages			=   ceil($nbrMedecins / $elementByPage);
		
		$sql = "SELECT * FROM medecins 
		WHERE 
		$col0 LIKE '%$cin%' AND 
		$col1 LIKE '%$nom%' AND 
		$col2 LIKE '%$prenom%' AND 
		$col3 LIKE '%$region%' AND 
		$col4 LIKE '%$specialite%'
		ORDER BY nom ASC LIMIT 20 OFFSET ".(($currentPage-1)*20);

		$medecins = $this->model->findMedecinBySearch($sql);

		if (empty($medecins)){
			$currentPage 	= 	$nbrPages;
			$msgAlert		=	"Aucun medecin ne correspond à la recherche !";
		}

		$query = "
		$col0 contient '$cin' & 
		$col1 contient '$nom' & 
		$col2 contient '$prenom' & 
		$col3 contient '$region' & 
		$col4 contient '$specialite'";

		\Renderer::render('views/medecin-search', compact('pageTitle', 'medecins', 'msgAlert', 'currentPage', 'nbrPages', 'nbrMedecins', 'elementByPage', 'query', 'cin', 'nom', 'prenom', 'region', 'specialite'));
	}

	public function edit ()
	{
		$medecin_id = null;
		$source = null;
		$alert = null;

		if (!empty($_GET['id']))
		{
			$medecin_id = $_GET['id'];
			$medecin = $this->model->find($medecin_id);
		}

		if (!empty($_GET['source']))
		{
			$source = $_GET['source'];
		}

		if (!empty($_GET['alert']))
		{
			$alert = $_GET['alert'];
		}

		$pageTitle = 'Modifier un médecin';

		\Renderer::render('views/medecin-edit', compact('pageTitle', 'medecin', 'alert', 'source'));	
	}

	public function update ()
	{
		$medecin_id = $_POST['id'];
		$ok = false;
		$column = null;
		$update = "";
		$source = null;
		$alert = null;
		$medecin 	=	$this->model->find($medecin_id);

		if (!empty($_POST['id']))
		{
			$medecin_id = $_POST['id'];
		}

		if (!empty($_GET['column']))
		{
			switch ($_GET['column'])
			{
				case 'telephone':
					if (!empty($_POST['update']))
					{	
						$column 	= 'telephone';
						$update 	= $_POST['update'];
						$tab_tel 	= [$update];
						$pattern 	= "/^[0-9]{9}$/";
						if (preg_grep($pattern, $tab_tel))
						{
							$ok = true;
							$source = 'tel';
							$alert = 'successfull';
						}
						else
						{
							$source = 'tel';
							$alert = 'bad_format';
						}
					}
					else
					{
						$source = 'tel';
						$alert = 'null';
					}
				break;
				case 'email':
					if (!empty($_POST['update']))
					{
						$column 	= 	'email';
						$update 	= 	$_POST['update'];
						$tab_mail 	= 	[$update];
						$pattern 	=	"/^[^\s()<>@,;:\/]+@\w[\w\.-]+\.[a-z]{2,}$/i";
						if (preg_grep($pattern, $tab_mail))
						{
							$ok = true;
							$source = 'email';
							$alert = 'successfull';
						}
						else 
						{
							$source = 'email';
							$alert = 'bad_format';
						}
					}
					else
					{
						$source = 'email';
						$alert = 'null';
					}
				break;
				case 'default':break;
			}
		}

		if ($ok) {
			$this->model->update($column, $update, $medecin_id);
		}
		\Http::redirect("index.php?c=medecin&task=edit&id=$medecin_id&alert=$alert&source=$source");
	}

	public function rechercher ()
	{
		$alert 				= 	null;
		$mMedecin 			= 	null;
		$cotisationNonPayer = 	null;
		$cotisationPayer 	=	null;

		$montantNonPayer 	= 	0;
		$montantCacher 		=	0;
		$montantRegler 		=	0;
		$lastyearPaid 		=	0;

		if (isset($_GET['note']))
		{
			$note = $_GET['note'];
			$alert = \Alert::getAlert($note);
		}

		if (!empty($_GET['cin']))
		{
			$mMedecin = \Marit::getInfoMedecin($_GET['cin']); 
			$mMedecin = $mMedecin->GetInfoMedecinAvecAuthResult;

			$getCotisationNonPayer 	=	\Marit::getCotisationNonPayer($_GET['cin']);
			$getCotisationNonPayerResponse = $getCotisationNonPayer->GetCotisationNonPayerAvecAuthResult->MedecinCotisation->listeAnnee;

			$getCotisationPayer 	=	\Marit::getCotisationPayer($_GET['cin']);
			$getCotisationPayerResponse = $getCotisationPayer->GetCotisationPayerAvecAuthResult->MedecinCotisation->listeAnnee;
		}

		if (isset($getCotisationPayerResponse->AnneeVM))
		{
			$cotisationPayer = $getCotisationPayerResponse->AnneeVM;
			if (is_array($cotisationPayer))
			{
				$lastyearPaid = $cotisationPayer[0]->Annee;
				for ($y = 0; $y < count($cotisationPayer); $y++)
				{
					$montantRegler += $cotisationPayer[$y]->AnneeMontant;
				}
			}
			else
			{
				$lastyearPaid = $cotisationPayer->Annee;
				$montantRegler += $cotisationPayer->AnneeMontant;
			}
		}
		else
		{
			$cotisationPayer = null;
		}

		if (isset($getCotisationNonPayerResponse->AnneeVM))
		{
			$cotisationNonPayer = $getCotisationNonPayerResponse->AnneeVM;
			if (is_array($cotisationNonPayer))
			{
				for ($i = 0; $i < count($cotisationNonPayer); $i++) {
					if ($cotisationNonPayer[$i]->Annee > $lastyearPaid)
					{
						$montantNonPayer += substr($cotisationNonPayer[$i]->AnneeMontant, 7);
					}	
					else
					{
						$montantCacher += substr($cotisationNonPayer[$i]->AnneeMontant, 7);
					}
				}
			}
			else 
			{
				$montantNonPayer += substr($cotisationNonPayer->AnneeMontant, 7);
			}
		}

		// var_dump($mMedecin);

		$pageTitle = "Rechercher un médecin";
		\Renderer::render('views/findMedecin', compact('pageTitle', 'alert', 'mMedecin', 'cotisationPayer', 'cotisationNonPayer', 'montantNonPayer', 'lastyearPaid', 'montantCacher', 'montantRegler'));
	}

	public function findOnMarit ()
	{
		$cin = null;
		if (!empty($_POST['cin']))
		{
			$cin 		 = 	$_POST['cin'];
		}
		else
		{
			\Http::redirect('index.php?c=medecin&task=rechercher&note=noExistCin');
		}

		$_getInfoMedecin 	=	\Marit::getInfoMedecin($cin);

		if (isset($_getInfoMedecin->GetInfoMedecinAvecAuthResult)) 
		{
			\Http::redirect("index.php?c=medecin&task=rechercher&cin=$cin&note=okFindMedecin");
		}
		else
		{
			\Http::redirect('index.php?c=medecin&task=rechercher&note=noExistCin');
		}
	}

	public function add ()
	{
		$alert 				= 	null;
		$regionModel 		= 	new \models\Region();
		$specialiteModel 	= 	new \models\Specialite();
		$mMedecin 			=	null;
		$cin 				=	null;

		$regions = $regionModel->findAll('id ASC');
		$specialites = $specialiteModel->findAll('id ASC');

		// var_dump($specialites);

		if (isset($_GET['note']))
		{
			$note = $_GET['note'];
			$alert = \Alert::getAlert($note);
		}

		if (isset($_GET['cin']))
		{
			$cin 				= 	$_GET['cin'];
			$_getInfoMedecin 	= 	\Marit::getInfoMedecin($cin);
			$mMedecin 			=	$_getInfoMedecin->GetInfoMedecinAvecAuthResult;
		}

		$pageTitle = "Ajouter un médecin";
		\Renderer::render('views/addMedecin', compact('pageTitle', 'alert', 'regions', 'specialites', 'mMedecin'));
	}

	public function check ()
	{
		$cin = null;

		if (!empty($_POST['submit']))
		{
			if (!empty($_POST['cin']))
			{
				$_getInfoMedecin = \Marit::getInfoMedecin($_POST['cin']);
				if (isset($_getInfoMedecin->GetInfoMedecinAvecAuthResult))
				{
					$cin = $_POST['cin'];
					\Http::redirect('index.php?c=medecin&task=add&note=okFindMedecin&cin='.$cin);
				}
				else
				{
					\Http::redirect('index.php?c=medecin&task=add&note=noExistCin');
				}
			}
			else
			{
				\Http::redirect('index.php?c=medecin&task=add&note=noCin');
			}
		}
		else
		{
			\Http::redirect('index.php?c=medecin&task=add&note=noForm');
		}
	}

	public function store ()
	{
		$regionModel 		= new \models\Region();
		$specialiteModel 	= new \models\Specialite();

		// Variables qui seront utilisées
		$cin 				=	null;
		$nom 				=	null;
		$prenom 			=	null;
		$nom_complet 		=	'Dr ';
		$specialite_id 		=	0;
		$specialite 		=	null;
		$region_id 			=	0;
		$region 			=	null;
		$telephone 			=	null;
		$email 				=	null;
		$pwd 				= 	'12345';
		$situation 			=	0;
		$connected_at 		=	'0000-00-00 00:00:00';
		$modify_at 			=	'0000-00-00';
		$keyuser 			= 	'vide';

		$mMedecin 			=	null;

		// 1. V&rifier que le formulaire a bien été envoyé
		if (!empty($_POST['submit']))
		{
			
			// 2. Vérifier que tous les champs sont présent

			// CIN
			if (!empty($_POST['cin']))
			{	
				$cin = $_POST['cin'];
				// Vérification de l'existence du médecin dans MARIT
				$_getInfoMedecin = \Marit::getInfoMedecin($cin);

				if (isset($_getInfoMedecin->GetInfoMedecinAvecAuthResult))
				{
					$mMedecin = $_getInfoMedecin->GetInfoMedecinAvecAuthResult;
					if (!$cin === $mMedecin->Cin) {
						\Http::redirect('index.php?c=medecin&task=add&note=noExistCin');
					}
				}
				else 
				{
					\Http::redirect('index.php?c=medecin&task=add&note=noExistCin');
				}
			}

			// Nom
			if (!empty(trim($_POST['nom'])))
			{
				$nom = trim($_POST['nom']);
			} else {
				\Http::redirect('index.php?c=medecin&task=add&note=noInputLastName');
			}

			// Prenom
			if (!empty(trim($_POST['prenom'])))
			{
				$prenom = trim($_POST['prenom']);
			} else {
				\Http::redirect('index.php?c=medecin&task=add&note=noInputFirstName');
			}

			// Nom COMPLET
			if (count($_POST) == 8)
			{
				$nom_complet .= $nom.' '.$prenom;
			}
			else 
			{
				$nom_complet .= $_POST['nom_complet'];
			}

			// IdSpecialite et Specialite
			if ($_POST['idSpecialite'])
			{
				$idSpecialite 	= 	1 * $_POST['idSpecialite'];
				$specialite 	= 	$specialiteModel->find($idSpecialite);
				if ($specialite)
				{
					$specialite = $specialite['nomSpecialite'];
				}
				else
				{
					\Http::redirect('index.php?c=medecin&task=add&note=noFindSpecialite');
				}
			}
			else{
				\Http::redirect('index.php?c=medecin&task=add&note=noInputIdSpecialite');
			}

			// IdRegion et Region
			if ($_POST['idRegion'])
			{
				$idRegion 	= 	1 * $_POST['idRegion'];
				$region 	=	$regionModel->find($idRegion);
				if ($region)
				{
					$region = $region['nomRegion'];
				}
				else
				{
					\Http::redirect('index.php?c=medecin&task=add&note=noFindRegion');
				}
			}
			else{
				\Http::redirect('index.php?c=medecin&task=add&note=noInputIdRegion');
			}

			// Telephone
			$telephone = $_POST['telephone'];

			// Email
			$email = $_POST['email'];

			// Situation
			$verifGetCotisationNonPayer = \Marit::getCotisationNonPayer($cin);
			if (!isset($verifGetCotisationNonPayer->GetCotisationNonPayerAvecAuthResult->MedecinCotisation->listeAnnee->AnneeVM))
			{
				$situation = 1;
			}

			$addMedecin = $this->model->insert($region, $cin, $nom, $prenom, $nom_complet, $specialite, $telephone, $email, $pwd, $situation, $connected_at, $modify_at, $region_id,  $specialite_id, $keyuser);
			if ($addMedecin)
			{
				\Http::redirect('index.php?c=medecin&task=add&note=okAddMedecin');
			}
			else
			{
				\Http::redirect('index.php?c=medecin&task=add&note=noForm');
			}
		}
		else 
		{
			\Http::redirect('index.php?c=medecin&task=add&note=failAddQuery');
		}
		/*
		// Champs dans la database
		id2	
		region	
		cin2	
		nom	
		prenom	
		nom_complet	
		specialite	
		telephone	
		email	
		pwd	
		situation	
		connected_at	
		modify_at	
		region_id	
		specialite_id	
		keyuser

	*/
		
	}
}
