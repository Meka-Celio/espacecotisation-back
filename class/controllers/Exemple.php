<?php

// namespace Controllers;

// class Exemple extends Controller
// {
// 	protected $modelName = \Models\Exemple::class;

// 	public function index ()
// 	{
// 		/**
// 		 * 2. Récupération des exemples
// 		 */
// 		$exemples = $this->model->findAll("created_at DESC");

// 		/**
// 		 * 3. Affichage
// 		 */
// 		$pageTitle = "Accueil";

// 		\Renderer::render('exemples/index', compact('pageTitle', 'exemples'));
// 	}


// 	public function show ()
// 	{
// 		$otherModel = new \Models\Other();

// 		/**
// 		 * 1. Récupération du param "id" et vérification de celui-ci
// 		 */
// 		// On part du principe qu'on ne possède pas de param "id"
// 		$other_id = null;

// 		// Mais si il y'en a un et que c'est un nombre entier, alors c'est cool
// 		if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
// 		    $other_id = $_GET['id'];
// 		}

// 		// On peut désormais décider : erreur ou pas ?!
// 		if (!$other_id) {
// 		    die("Vous devez préciser un paramètre `id` dans l'URL !");
// 		}
// 		/**
// 		 * 3. Récupération de l'exemple en question
// 		 * On va ici utiliser une requête préparée car elle inclue une variable qui provient de l'utilisateur : Ne faites
// 		 * jamais confiance à ce connard d'utilisateur ! :D
// 		 */
// 		$exemple = $this->model->find($other_id);

// 		/**
// 		 * 4. Récupération des commentaires de l'exemple en question
// 		 * Pareil, toujours une requête préparée pour sécuriser la donnée filée par l'utilisateur (cet enfoiré en puissance !)
// 		 */
// 		$commentaires = $commentModel->findAllByexemple($other_id);

// 		/**
// 		 * 5. On affiche 
// 		 */
// 		$pageTitle = $exemple['title'];
// 		\Renderer::render ('exemples/show', compact('pageTitle', 'exemple', 'commentaires', 'other_id'));
// 	}


// 	public function delete ()
// 	{

// 		/**
// 		 * 1. On vérifie que le GET possède bien un paramètre "id" (delete.php?id=202) et que c'est bien un nombre
// 		 */
// 		if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
// 		    die("Ho ?! Tu n'as pas précisé l'id de l'exemple !");
// 		}

// 		$id = $_GET['id'];

// 		/**
// 		 * 3. Vérification que l'exemple existe bel et bien
// 		 */
// 		$exemple = $this->model->find($id);
// 		if (!$exemple) {
// 		    die("L'exemple $id n'existe pas, vous ne pouvez donc pas le supprimer !");
// 		}

// 		/**
// 		 * 4. Réelle suppression de l'exemple
// 		 */
// 		$this->model->delete($id);

// 		/**
// 		 * 5. Redirection vers la page d'accueil
// 		 */
// 		\Http::redirect ('index.php');
// 	}

// 	public function insert ()
// 	{
// 		$exempleModel = new \Models\exemple();

// 		/**
// 		 * 1. On vérifie que les données ont bien été envoyées en POST
// 		 * D'abord, on récupère les informations à partir du POST
// 		 * Ensuite, on vérifie qu'elles ne sont pas nulles
// 		 */
// 		// On commence par l'author
// 		$author = null;
// 		if (!empty($_POST['author'])) {
// 		    $author = $_POST['author'];
// 		}

// 		// Ensuite le contenu
// 		$content = null;
// 		if (!empty($_POST['content'])) {
// 		    // On fait quand même gaffe à ce que le gars n'essaye pas des balises cheloues dans son commentaire
// 		    $content = htmlspecialchars($_POST['content']);
// 		}

// 		// Enfin l'id de l'exemple
// 		$other_id = null;
// 		if (!empty($_POST['other_id']) && ctype_digit($_POST['other_id'])) {
// 		    $other_id = $_POST['other_id'];
// 		}

// 		// Vérification finale des infos envoyées dans le formulaire (donc dans le POST)
// 		// Si il n'y a pas d'auteur OU qu'il n'y a pas de contenu OU qu'il n'y a pas d'identifiant d'exemple
// 		if (!$author || !$other_id || !$content) {
// 		    die("Votre formulaire a été mal rempli !");
// 		}

// 		$exemple = $exempleModel->find($other_id);

// 		// Si rien n'est revenu, on fait une erreur
// 		if (!$exemple) {
// 		    die("Ho ! L'exemple $other_id n'existe pas boloss !");
// 		}

// 		// 3. Insertion du commentaire
// 		$this->model->insert($author, $content, $other_id);

// 		// 4. Redirection vers l'exemple en question :
// 		\Http::redirect ('index.php?controller=exemple&task=show&id=' . $other_id);
// 	}
// }
