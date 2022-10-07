<?php

namespace controllers;

class User extends Controller
{
	protected $modelName = \models\User::class;

	public function auth ()
	{
		$pageTitle = "Authentification";

		\Renderer::formrender('views/login', compact('pageTitle'));
	}

	public function login ()
	{
		\Http::redirect('index.php?c=user&task=dashboard');
	}

	public function logout ()
	{
		session_start();
		session_unset();
		session_destroy();

		\Http::redirect('index.php?c=user&task=auth');
	}

	public function index ()
	{	
		$currentPage 		= 	(isset($_GET['page'])) ? $_GET['page'] : 1;
		$tabNbrUsers		=	$this->model->getNumberOf();
		$nbrUsers 			= 	(int)$tabNbrUsers[0]['NumberOf'];
		$msgAlert = "";
		$elementByPage = 10;

		$nbrPages = ceil($nbrUsers / $elementByPage);

		$users = $this->model->findAllByLimit($currentPage, $elementByPage, 'id ASC');

		if (empty($users))
		{
			$currentPage = $nbrUsers;
			$msgAlert = "Aucun utilisateur n'a été trouvé !";
		}

		$pageTitle = "Les Utilisateurs";

		\Renderer::render('views/users', compact('pageTitle', 'users', 'nbrUsers', 'elementByPage', 'currentPage', 'nbrPages', 'msgAlert'));
	}

	public function dashboard ()
	{
		$medecinModel 		= 	new \models\Medecin();
		$regionModel		=	new \models\Region();
		$specialiteModel	=	new \models\Specialite();

		$limit 				=	12;

		$medecins 			= 	$medecinModel->findAllByLimit(0, $limit);
		$regions 			= 	$regionModel->findAll();
		$specialites		=	$specialiteModel->findAll();

		$tabNbrMedecins		=	$medecinModel->getNumberOf();
		$nbrMedecins 		= 	(int)$tabNbrMedecins[0]['NumberOf'];

		$tabNbrRegions		=	$regionModel->getNumberOf();
		$nbrRegions 		=	(int)$tabNbrRegions[0]['NumberOf'];

		$tabNbrSpecialites		=	$specialiteModel->getNumberOf();
		$nbrSpecialites 		=	(int)$tabNbrSpecialites[0]['NumberOf'];

		$tabNbrUsers			=	$this->model->getNumberOf();
		$nbrUsers 				=	(int)$tabNbrUsers[0]['NumberOf'];

		$pageTitle = "Dashboard";

		\Renderer::render('views/dashboard', compact('pageTitle', 'medecins', 'regions', 'specialites', 'nbrMedecins', 'nbrRegions', 'nbrSpecialites', 'nbrUsers'));

	}

	public function show ()
	{
		/**
		 * 1. Récupération du param "id" et vérification de celui-ci
		 */
		// On part du principe qu'on ne possède pas de param "id"
		$user_id = null;

		// Mais si il y'en a un et que c'est un nombre entier, alors c'est cool
		if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
		    $user_id = $_GET['id'];
		}

		// On peut désormais décider : erreur ou pas ?!
		if (!$user_id) {
		    die("Vous devez préciser un paramètre `id` dans l'URL !");
		}
		/**
		 * 3. Récupération de l'exemple en question
		 * On va ici utiliser une requête préparée car elle inclue une variable qui provient de l'utilisateur : Ne faites
		 * jamais confiance à ce connard d'utilisateur ! :D
		 */
		$user = $this->model->find($user_id);

		/**
		 * 5. On affiche 
		 */
		$pageTitle = "Voir Utilisateur";
		\Renderer::render ('view/show', compact('pageTitle', 'user', 'user_id'));
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

	public function add ()
	{
		$pageTitle = "Ajouter un user";
		\Renderer::render('views/user-add', compact('pageTitle'));
	}

	public function insert ()
	{
		$msgAlert = "";
		$ok = 0;

		// var_dump($_POST);
		// die();
		// login email motdepasse verifMotdepasse autorisation
		
		// On commence par le login
		$login = null;
		if (!empty($_POST['login'])) {
			$user = $this->model->findBySearch('login', $_POST['login']);
			if (!$user) {
				$login = $_POST['login'];
		    	$ok += 1;
			}
			else
			{
				$msgAlert = 'login_already_exist,';
			}   
		} 
		else {
			$msgAlert .= "login_null,";
		}

		// Email
		$email = null;
		if (!empty($_POST['email'])) {
			$pattern 	= "/^[^\s()<>@,;:\/]+@\w[\w\.-]+\.[a-z]{2,}$/i";
			if (preg_match($pattern, $_POST['email']))
			{
				$email 		= $_POST['email'];
				$ok 		+= 1;
			} 
			else {
				$msgAlert .= "email_false,";
			}
		}
		else {
			$msgAlert .= "email_false,";
		}

		// mot de passe
		$motdepasse = null;
		if (!empty($_POST['motdepasse'])) {
		    $motdepasse = password_hash($_POST['motdepasse']);
		    // vérifier le mot de passe
			$verifmotdepasse = null;
			if (!empty($_POST['verifmotdepasse'])) {
			    if ($_POST['verifmotdepasse'] == password_verify($_POST['verifmotdepasse'], $motdepasse))
			    {
			    	$ok += 1;
			    }
			    else {
					$msgAlert .= "password_not_equal";
				}
			}
			else {
				$msgAlert .= "verif_null";
			}
		    $ok += 1;
		}
		else {
			$msgAlert .= "password_false,";
		}

		

		// l'autorisation
		$autorisation = $_POST['autorisation'] * 1;


		// 3. Si création réussi
		if ($ok == 4) {
			$query = $this->model->insert($login, $motdepasse, $email, $autorisation);
			if ($query) {
				$msgAlert = 'success';
				// 4. Redirection vers la page user en question :
				\Http::redirect ("index.php?c=user&task=index&msgAlert=$msgAlert");
			}
			else 
			{
				$msgAlert = 'failure';
				// 4. Redirection vers la page user en question :
				\Http::redirect ("index.php?c=user&task=index&msgAlert=$msgAlert");
			}
		}
		else {
			// 4. Redirection vers la page user en question :
			\Http::redirect ("index.php?c=user&task=add&msgAlert=$msgAlert");
		}
	}
}
