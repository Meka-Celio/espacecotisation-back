<?php 
    require 		'../app.soapClient.php';
    require_once 	'../model.collection.php';

    // ---------------------------------------------
    // FONCTION D'ACTIONS
    // ---------------------------------------------
    
    /**
	 * Permet de vérifier si la dernière année à payer fait parti 
	 * des années à payer dans le paiement en cours
	 * 
	 * @param string	$CINMedecin			La CIN du médecin qui paie
	 * @param string	$chaine				Les années à payer sous forme de chaine de caractères
	 * 
	 * @var array		$AnneeVM			Tableau contenant les cotisation du médecin
	 * @var array 		$yearsNotPaid		Tableau qui récupère les annéees
	 * 
	 * @var string		$oldOneYear			La plus vielle année à régler
	 * @var string 		$firstYear			La plus récente année à régler
	 * @var string 		$stringYears		La chaine de caractères des années
	 * @var string 		$longueur_chaine	La longueur de la chaine de la plus récente à la plus ancienne année	
	 * 	
	 * @return int							Indication renvoyée pour savoir si la vérification est bonne ou pas
	 */

	function verifCotisation ($CINMedecin, $chaine, $cache) {

		// Récupération des impayees de $CINMedecin
		$getImpayees = getCotisationNonPayer($CINMedecin);

		// Récupération du tableau des cotisations impayees 
		$AnneeVM = $getImpayees->GetCotisationNonPayerAvecAuthResult->MedecinCotisation->listeAnnee->AnneeVM;

		// Variables
		$yearsNotPaid 		= 	[];
		$oldOneYear 		= 	"";
		$firstYear			=	"";
		$stringYears		=	"";
		$longueur_chaine	=	0;

		if (is_array($AnneeVM)) {
			// Ajout des années dans le tableau et du dernier element dans la variable $oldOneYear
			for ($i=0; $i < count($AnneeVM); $i++) {
				array_push($yearsNotPaid, $AnneeVM[$i]->Annee);
				$oldOneYear = strval($AnneeVM[$i]->Annee);
			}
		}
		else {
			array_push($yearsNotPaid, $AnneeVM->Annee);
		}

		// Attribution de la première année
		$firstYear	=	strval($yearsNotPaid[0]);
		
		// Vérifier que $oldOneYear est dans $chaine
		if (stristr($chaine, $oldOneYear)) {
			// vérifier que la premiere annee est dans la chaine
			if (stristr($chaine, $firstYear))
			{
				$stringYears 	= implode(',', $yearsNotPaid);
				$longueur_chaine = strlen($stringYears);

				if (strlen($chaine) === $longueur_chaine) {
					return 1;
				}
				else {
					if ($cache) {
                        return 2;
                    }
                    else {
                        return -1;
                    }
				}
			}
			else 
			{
				return 2;
			}
		} 
		else {
			if ($cache) {
                return 2;
            }
            else {
                return 0;
            }
		}
	}



	// ------------------------------------------------------------------------
	// -------------------------- MAIN ------------------------------
	// ------------------------------------------------------------------------

    if (isset($_GET['action'])) {
        $action = $_GET['action'];
        switch($action) {
			// Fonction exécutée après coche des années
            case 'paiement':
				// Informations requises
				/**
				 * La CIN
				 * Le Nom du medecin
				 * L'email
				 * Le Tel
				 * Le N° de transaction*
				 * Le N° autorisation
				 * Le N° commande
				 * Le N° Carte
				 * Le montant 
				 * la date 
				 * L'heure
				 * L'annee payée
				 * Date enregistrement
				 * La validation
				 */
				(function () {
                    
                    if (isset($_POST['submit'])) {
						var_dump($_POST);
						$cin = $_POST['CIN'];
						$cache = $_POST['cache'];

						$years = $_POST['NotPaid'];
						$montant = 0;

						var_dump($years);
                            for ($i=0; $i<count($years); $i++) {
                                $montant += substr($years[$i], 7);
								echo "<p>$montant</p>";
                                $years[$i] = substr($years[$i], 0, 4);
                            } // Fin de boucle

						var_dump($years);
					}

                })();
                break;
			
			// Fonction exécutée lors de l'arrivée sur la page de récap
			case 'ticket':
				// Informations requises
				/**
				 * La CIN
				 * Le Nom du medecin
				 * L'email
				 * Le N° de transaction*
				 * Le N° autorisation
				 * Le N° commande
				 * Le N° Carte
				 * Le montant 
				 * la date 
				 * L'heure
				 * L'annee payée
				 */
				(function () {

				})();
				break;
			
			// Fonction executée lorsque les tickets sont partis
			case 'recu':
				(function () {
					
				})();
				break;
        }
    }