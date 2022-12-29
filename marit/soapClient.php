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
            $data = $params;
            // $data = $clientSOAP->enregistrerListeCotisationMedecin($params);
            return $data;
        }
        catch (SoapFault $exception) {
            echo "<b>Une erreur a été détectée, la requête a échoué !</b> \n ".$exception->getMessage();
        }
    }


?>