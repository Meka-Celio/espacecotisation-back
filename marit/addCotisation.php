<?php 
// Fichier classe Cotisation Payee
require 'soapClient.php';

if (isset($_GET['cin']))
{
	$cin 			= $_GET['cin'];
	$n_commande 	= $_GET['n_commande'];
	$idCotisation	= $_GET['idCotisation'];
	$transaction_id = $_GET['transaction_id'];

	$addCotisation = AjoutCotisation($cin, $n_commande, $idCotisation);
	if ($addCotisation)
	{	
		$note = "okAddCotisation";
	}
	else
	{
		$note = "failAddQuery";
	}
	header("Location:../index.php?c=transaction&task=show&id=$transaction_id&note=$note");
}
else 
{
	$note = 'noCin';
	header("Location:../index.php?c=transaction&task=show&id=$transaction_id&note=$note");
}






?>