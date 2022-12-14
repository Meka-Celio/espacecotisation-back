<?php 

/**
 * 
 */
class Alert 
{
	public static function getAlert ($codeAlert)
	{
		switch ($codeAlert)
		{
			case 'noForm':
				$msgAlert = '<div class="row"><div class="col-sm-12 mb-2"><div class="alert alert-danger">Aucune donnée n\'a été envoyé, merci de remplir le formulaire !</div></div></div>';
				break;
			case 'noCin':
				$msgAlert = '<div class="row"><div class="col-sm-12 mb-2"><div class="alert alert-danger">La CIN du médecin est obligatoire !</div></div></div>';
				break;
			case 'nCommandeNum':
				$msgAlert = '<div class="row"><div class="col-sm-12 mb-2"><div class="alert alert-danger">Le numéro de commande est obligatoire !</div></div></div>';
				break;
			case 'noYearsAdd':
				$msgAlert = '<div class="row"><div class="col-sm-12 mb-2"><div class="alert alert-danger">Vous devez ajouter au moins une année !</div></div></div>';
				break;
			case 'noTransactionFind':
				$msgAlert = '<div class="row"><div class="col-sm-12 mb-2"><div class="alert alert-danger">Le numéro de commande renseigné ne correspond à aucune transaction !</div></div></div>';
				break;
			case 'noExistCin':
				$msgAlert = '<div class="row"><div class="col-sm-12 mb-2"><div class="alert alert-danger">Ce médecin n\'existe pas  !</div></div></div>';
				break;
			case 'noEqualsYears':
				$msgAlert = '<div class="row"><div class="col-sm-12 mb-2"><div class="alert alert-danger">Les années reçues ne correspondent pas à celles figurant dans la transaction  !</div></div></div>';
				break;
			case 'failAddQuery':
				$msgAlert = '<div class="row"><div class="col-sm-12 mb-2"><div class="alert alert-danger">L\'ajout de cotisation a échoué  !</div></div></div>';
				break;

			case 'okAddCotisation':
				$msgAlert = '<div class="row"><div class="col-sm-12 mb-2"><div class="alert alert-success">Les années ont bien été enregistrées !</div></div></div>';
				break;
			default:break;
		}
		return $msgAlert;
	}
}