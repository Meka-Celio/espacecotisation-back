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
			case 'noInputLastName':
				$msgAlert = '<div class="row"><div class="col-sm-12 mb-2"><div class="alert alert-danger">Le nom du médecin est obligatoire !</div></div></div>';
				break;
			case 'noInputFirstName':
				$msgAlert = '<div class="row"><div class="col-sm-12 mb-2"><div class="alert alert-danger">Le prénom du médecin est obligatoire !</div></div></div>';
				break;
			case 'noInputIdSpecialite':
				$msgAlert = '<div class="row"><div class="col-sm-12 mb-2"><div class="alert alert-danger">Le choix de la spécialité est obligatoire !</div></div></div>';
				break;
			case 'noInputIdRegion':
				$msgAlert = '<div class="row"><div class="col-sm-12 mb-2"><div class="alert alert-danger">Le choix de la région est obligatoire !</div></div></div>';
				break;
			case 'noFindRegion':
				$msgAlert = '<div class="row"><div class="col-sm-12 mb-2"><div class="alert alert-danger">Pas de région trouvé !</div></div></div>';
				break;
			case 'noFindSpecialite':
				$msgAlert = '<div class="row"><div class="col-sm-12 mb-2"><div class="alert alert-danger">Pas de spécialité trouvé !</div></div></div>';
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
				$msgAlert = '<div class="row"><div class="col-sm-12 mb-2"><div class="alert alert-danger">L\'ajout a échoué  !</div></div></div>';
				break;
			case 'noRecuGet':
				$msgAlert = '<div class="row"><div class="col-sm-12 mb-2"><div class="alert alert-danger">Aucun recu n\'a été trouvé !</div></div></div>';
				break;
			case 'allCotPaid':
				$msgAlert = '<div class="row"><div class="col-sm-12 mb-2"><div class="alert alert-danger">Les cotisations à payer pour ce médecin ne sont pas disponibles !</div></div></div>';
				break;
			case 'omitYearNotPaid':
				$msgAlert = '<div class="row"><div class="col-sm-12 mb-2"><div class="alert alert-danger">Une année de cotisation a été sauté !</div></div></div>';
				break;


			case 'okAddCotisation':
				$msgAlert = '<div class="row"><div class="col-sm-12 mb-2"><div class="alert alert-success">Les années ont bien été enregistrées !</div></div></div>';
				break;
			case 'okRecuGet':
				$msgAlert = '<div class="row"><div class="col-sm-12 mb-2"><div class="alert alert-success">Reçu(s) de paiement trouvé(s) pour cette recherche !</div></div></div>';
				break;
			case 'okFindMedecin':
				$msgAlert = '<div class="row"><div class="col-sm-12 mb-2"><div class="alert alert-success">Le médecin a bien été trouvé !</div></div></div>';
				break;
			case 'okAddMedecin':
				$msgAlert = '<div class="row"><div class="col-sm-12 mb-2"><div class="alert alert-success">Le médecin a bien été ajouté !</div></div></div>';
				break;
			
				
			default:break;
		}
		return $msgAlert;
	}
}