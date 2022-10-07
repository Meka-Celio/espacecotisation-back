<?php 
    // Fichier classe Cotisation Payee
    require 'CotisationPayees.class.php';

    define('TYPECOTISATION', 1);
    define('LOGIN', 'user1');
    define('PWD', 'pass1');
    define('MODEVERSEMENT', 6);
    define('IDBANQUE', -1);

    function createClientSoap () {
        // CREATION DU CLIENT SOAP
	    $clientSOAP = new SoapClient("https://cnom.marit.ma/webservices/cnomservices.asmx?wsdl", array("trace" => 1));
        return $clientSOAP;
    }
    
    function getCotisationNonPayer ($CINMedecin) {
        $clientSOAP = createClientSoap();

        // PARAMETTRES POUR LA FONCTION
        $params = array(
            'sCINMedecin' 	=>	$CINMedecin,
            'sLogin'		=>	LOGIN,
            'sPwd'			=>	PWD	
        );
        try {
            $data 	= 	$clientSOAP->GetCotisationNonPayerAvecAuth($params);
            return $data;
        } catch (SoapFault $exception) {
            echo "<b>Une erreur a été détectée, la requête a échoué !</b> \n ".$exception->getMessage();
        }
    }

    function getCotisationPayer ($CINMedecin) {
        $clientSOAP = createClientSoap();
        
        $params = array(
            "iTypeCotisation"	=>	TYPECOTISATION,
            'sCINMedecin' 		=>	$CINMedecin,
            'sLogin'			=>	LOGIN,
            'sPwd'				=>	PWD
        );

        try {
            $data =	$clientSOAP->GetCotisationPayerAvecAuth($params);
            return $data;
        } catch (SoapFault $exception) {
            echo "<b>Une erreur a été détectée, la requête a échoué !</b> \n ".$exception->getMessage();
        }
    }

    function verifyUserExist ($CINMedecin) {
        // Appel de la fonction & recuperation du resultat
        $getCotisationPayerResponse         =   getCotisationPayer($CINMedecin);

        // Créationde la variable pour la verification
        $existeMedecin = $getCotisationPayerResponse->GetCotisationPayerAvecAuthResult->MedecinCotisation->ExisteMedecin;

        if ($existeMedecin) {
            return 1;
        } else {
            return 0;
        }
    }

    /*
        @param string CINMedecin, string NumRecuCotisation, string IdIdParamCotisation : c'est l'Id de la cotisation à payer
    */

    function addCotisationMedecin ($CINMedecin, $NumRecuCotisation, $IdParamCotisation) {
        $clientSOAP = createClientSoap();

        // PARAMETRES POUR LA FONCTION
        $params = array(
            'sLogin'                =>  LOGIN,
            'sPwd'                  =>  PWD,
            'iTypeCotisation'       =>  TYPECOTISATION,
            'sCINMedecin'           =>  $CINMedecin,
            'iModeVersement'        =>  MODEVERSEMENT,
            'sNumRecuCotisation'    =>  '',
            'sNumCheque'            =>  $NumRecuCotisation,
            'sDateCheque'           =>  '',
            'iIdParamCotisation'    =>  intval($IdParamCotisation),
            'iIdBanque'             =>  IDBANQUE  
        ); 
        try {
            $response = $clientSOAP->enregisterCotisationMedecin($params);
            return $response;
        }catch (SoapFault $exception) {
            echo "<b>Une erreur a été détectée, la requête a échoué !</b> \n ".$exception->getMessage();
        }
    }

    function getInfoMedecin ($CINMedecin) {
        $clientSOAP = createClientSoap();

        // PARAMETTRES POUR LA FONCTION
        $params = array(
            'sCINMedecin'   =>  $CINMedecin,
            'sLogin'        =>  LOGIN,
            'sPwd'          =>  PWD 
        );
        try {
            $data   =   $clientSOAP->GetInfoMedecinAvecAuth($params);
            return $data;
        } catch (SoapFault $exception) {
            echo "<b>Une erreur a été détectée, la requête a échoué !</b> \n ".$exception->getMessage();
        }
    }

    function AjoutCotisation ($CINMedecin, $NCommande, $idAnneePayee) {
        $clientSOAP = createClientSoap();

        // PARAMATRES POUR LA FONCTION
        $params = array(
            'sLogin'        =>  LOGIN,
            'sPwd'          =>  PWD,
            'liste'         =>  array()
        );

        $years = explode(',', $idAnneePayee);
        // Boucle pour les cas années
        for ($i=0; $i<count($years); $i++)
        {
            // Création des objets
            $cotisation = new CotisationPayee($CINMedecin, $NCommande, $years[$i]);
            array_push($params['liste'], $cotisation);
        }
        try {
            $data = $clientSOAP->enregistrerListeCotisationMedecin($params);
            return $data;
        }
        catch (SoapFault $exception) {
            echo "<b>Une erreur a été détectée, la requête a échoué !</b> \n ".$exception->getMessage();
        }
    }

    function GetRecuCotisation ($NCommande, $CINMedecin) {
        $clientSOAP = createClientSoap();

        // PARAMETRES
        $params = array(
            "sNumero"               =>  $NCommande,
            "sCINMedecin"           =>  $CINMedecin,
            'sLogin'                =>  LOGIN,
            'sPwd'                  =>  PWD,
            "iTypeCotisation"       =>  TYPECOTISATION
        );
        try {
            $data = $clientSOAP->GetRecuCotisationPayerAvecAuth($params);
            return $data;
        }
        catch(SoapFault $exception) {
            echo "<b>Une erreur a été détectée, la requête a échoué !</b> \n ".$exception->getMessage();
        }
    }

?>
