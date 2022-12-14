<?php 


class Marit
{
    // define('TYPECOTISATION', 1);
    // define('LOGIN', 'user1');
    // define('PWD', 'pass1');
    // define('MODEVERSEMENT', 6);
    // define('IDBANQUE', -1);

    const TYPECOTISATION  = 1;
    const LOGIN           = 'user1';
    const PWD             = 'pass1';
    const MODEVERSEMENT   = 6;
    const IDBANQUE        = -1;

    public static function createClientSoap () {
        // CREATION DU CLIENT SOAP
        $clientSOAP = new SoapClient("https://cnom.marit.ma/webservices/cnomservices.asmx?wsdl", array("trace" => 1));
        return $clientSOAP;
    }
    
    public static function getCotisationNonPayer ($CINMedecin) {
        $clientSOAP = Marit::createClientSoap();

        // PARAMETTRES POUR LA FONCTION
        $params = array(
            'sCINMedecin'   =>  $CINMedecin,
            'sLogin'        =>  self::LOGIN,
            'sPwd'          =>  self::PWD
        );
        try {
            $data   =   $clientSOAP->GetCotisationNonPayerAvecAuth($params);
            return $data;
        } catch (SoapFault $exception) {
            echo "<b>Une erreur a été détectée, la requête a échoué !</b> \n ".$exception->getMessage();
        }
    }

    public static function getCotisationPayer ($CINMedecin) {
        $clientSOAP = Marit::createClientSoap();
        
        $params = array(
            "iTypeCotisation"   =>  self::TYPECOTISATION,
            'sCINMedecin'       =>  $CINMedecin,
            'sLogin'            =>  self::LOGIN,
            'sPwd'              =>  self::PWD
        );

        try {
            $data = $clientSOAP->GetCotisationPayerAvecAuth($params);
            return $data;
        } catch (SoapFault $exception) {
            echo "<b>Une erreur a été détectée, la requête a échoué !</b> \n ".$exception->getMessage();
        }
    }

    public static function verifyUserExist ($CINMedecin) {
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

    public static function getInfoMedecin ($CINMedecin) {
        $clientSOAP = Marit::createClientSoap();

        // PARAMETTRES POUR LA FONCTION
        $params = array(
            'sCINMedecin'   =>  $CINMedecin,
            'sLogin'        =>  self::LOGIN,
            'sPwd'          =>  self::PWD 
        );
        try {
            $data   =   $clientSOAP->GetInfoMedecinAvecAuth($params);
            return $data;
        } catch (SoapFault $exception) {
            echo "<b>Une erreur a été détectée, la requête a échoué !</b> \n ".$exception->getMessage();
        }
    }

    public static function AjoutCotisation (string $CINMedecin, string $NCommande, string $idAnneePayee) 
    {
        $clientSOAP = Marit::createClientSoap();

        // PARAMATRES POUR LA FONCTION
        $params = array(
            'sLogin'        =>  self::LOGIN,
            'sPwd'          =>  self::PWD,
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
            $data = $params;
            // $data = $clientSOAP->enregistrerListeCotisationMedecin($params);
            return $data;
        }
        catch (SoapFault $exception) {
            echo "<b>Une erreur a été détectée, la requête a échoué !</b> \n ".$exception->getMessage();
        }
    }

    public static function GetRecuCotisation ($NCommande, $CINMedecin) {
        $clientSOAP = Marit::createClientSoap();

        // PARAMETRES
        $params = array(
            "sNumero"               =>  $NCommande,
            "sCINMedecin"           =>  $CINMedecin,
            'sLogin'                =>  self::LOGIN,
            'sPwd'                  =>  self::PWD,
            "iTypeCotisation"       =>  self::TYPECOTISATION
        );
        try {
            $data = $clientSOAP->GetRecuCotisationPayerAvecAuth($params);
            return $data;
        }
        catch(SoapFault $exception) {
            echo "<b>Une erreur a été détectée, la requête a échoué !</b> \n ".$exception->getMessage();
        }
    }
}
