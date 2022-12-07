<?php

namespace controllers;

class Transaction extends Controller
{
	protected $modelName = \models\Transaction::class;

	public function index ()
	{	
		$tabNbrTransactions	=	$this->model->getNumberOf();
		$nbrTransactions 	=	(int)$tabNbrTransactions[0]['NumberOf'];
		$msgAlert = "";
		$elementByPage 		= 20;
		$nbrPages			=   ceil($nbrTransactions / $elementByPage);

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

		
		$transactions 		= 	$this->model->findAllByLimit($currentPage, $elementByPage, 'DatePaiement DESC');
		
		if (empty($transactions)){
			$currentPage 	= 	$nbrPages;
			$transactions 	= 	null;
			$msgAlert		=	"Cette page n'existe pas !";
		}
		/**
		 * 3. Affichage
		 */
		$pageTitle = "Transactions";

		\Renderer::render('views/transaction', compact('pageTitle', 'transactions', 'currentPage', 'nbrTransactions', 'msgAlert', 'nbrPages'));
	}

	public function show ()
	{
		$transaction_id = 0;

		if (!empty($_GET['id']) && ctype_digit($_GET['id']))
		{
			$transaction_id = $_GET['id'];
		}

		$transaction = $this->model->find($transaction_id);

		$pageTitle = "Transaction N° ".$transaction['n_commande'];

		\Renderer::render('views/transaction-show', compact('pageTitle', 'transaction', 'transaction_id'));
	}

	public function activate ()
	{

		$transaction_id = 0;
		$column = '';
		$value = 0;

		if (!empty($_POST['submit']) && !empty($_POST['n_commande'] && !empty($_POST['transaction_id']) && ctype_digit($_POST['transaction_id'])))
		{
			$transaction_id = $_POST['transaction_id'];
			$column = 'Validation';
			$value = 1;
		}

		$this->model->update($column, $value, $transaction_id);
		\Http::redirect ("index.php?c=transaction&task=show&id=$transaction_id");
	}

	public function search ()
	{
		$column = "";
		$search = "";
		$currentPage = (isset($_GET['page'])) ? $_GET['page'] : 1;
		if ($currentPage <= 0) {
			$currentPage 	= 1;
			$msgAlert		=	"";
		}
		$elementByPage = 20;
		$order = "DatePaiement ASC";
		$msgAlert = "";

		if (isset($_POST['submit']))
		{
			if (!empty($_POST['cin']))
			{
				$column = "CIN";
				$search = $_POST['cin'];
			}

			if (!empty($_POST['nom']))
			{
				$column = "Nom";
				$search = $_POST['nom'];
			}

			if (!empty($_POST['n_commande']))
			{
				$column = "N_Commande";
				$search = $_POST['n_commande'];
			}

			if (!empty($_POST['date_paiement']))
			{
				$column = "DatePaiement";
				$search = $_POST['date_paiement'];
			}
		}
		else
		{
			echo "Aucun formulaire n'a été envoyé !";
			die();
		}
		
		$tabNbrTransactions 	= 	$this->model->countAllBySearch($column, $search);
		$nbrTransactions 		=	$tabNbrTransactions[0]['NumberOf'];
		$msgAlert				=	"";

		$transactions 		=	$this->model->findAllBySearch($column, $search, $currentPage, "DatePaiement DESC");
		$nbrPages			=   ceil($nbrTransactions / $elementByPage);

		if (empty($transactions)){
			$currentPage 	= 	$nbrPages;
			$msgAlert		=	"Aucune transaction ne correspond à la recherche !";
		}

		$pageTitle = "Recherche Transaction";

		\Renderer::render('views/transaction-search', compact('pageTitle', 'transactions', 'currentPage', 'nbrPages', 'nbrTransactions'));
	}
}