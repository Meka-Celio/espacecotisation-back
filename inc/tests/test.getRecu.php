<?php 

    require     '../app.soapClient.php';
    require     '../model.collection.php';

    function RecupererRecu ($NumCommande, $CINMedecin) 
    {
        $NumTransaction =	$NumCommande;
  		$CIN 			= 	$CINMedecin;
  		
  		// Récupération du reçu
  		$getRecu = GetRecuCotisation($NumTransaction, $CIN);
  		$recu_paiement = $getRecu->GetRecuCotisationPayerAvecAuthResult->MedecinCotisationPayee;	

  		if ($recu_paiement) {

  			// Appel à la fonction pour recupération info médecin
		  	$response = getInfoMedecin($CIN);

			// Appel a la fonction getMedecin pour recuperer le mail du medecin
			$DBMedecin = getUserByCIN($CIN);
			$mail = $DBMedecin->Email;
		  
			// Recuperation medecin
			$medecin = $response->GetInfoMedecinAvecAuthResult;

		  	$recu_Nom                           = $medecin->NomComplet;
		  	$recu_SecteurMedecin                = $medecin->SecteurMedecin;
		  	$recu_SpecialiteMedecin             = $medecin->SpecialiteMedecin;
		  	$recu_DateDiplome                   = $medecin->DateDiplome;
		  	$recu_DateRecrutement_Installation  = $medecin->DateRecrutement_Installation;
		  	$recu_AdressePro                    = $medecin->AdressePro;
		  	$recu_Province                      = $medecin->LibelleProvince;
		  	$recu_Region                        = $medecin->LibelleRegion; 
		  	$recu_DateCreation                  = date("d/m/Y");

		  	// Si il y a plusieurs lignes
	  		if (is_array($recu_paiement))
	  		{
	  			// Données variables en fonction du nbr années payées
			  	$recu_CINMedecin        = $recu_paiement[0]->CINMedecin;
			  	$recu_NumTransaction    = $recu_paiement[0]->NumRecuTransaction;
			  	$recu_NumRecu           = array();
			  	$recu_AnneeCotisation   = array();
			  	$recu_MontantCotisation = array();
			  	$recu_Somme             = array();

			  	for ($i = 0; $i < count($recu_paiement); $i++)
				{
				    $a = $recu_paiement[$i]->AnneeCotisation;
				    $m = $recu_paiement[$i]->MontantCotisation;
				    $s = '';
				    $r = $recu_paiement[$i]->NumRecuGenere;

				    if ($a == '2009' || $a == '2010' || $a == '2011' || $a == '2012' || $a == '2013' || $a == '2014' || $a == '2015')
				    {
				      $s = "Trois Cent";
				    }
				    elseif ($a == '2016' || $a == '2017' || $a == '2018') {
				      $s = "Sept Cent";
				    }
				    else {
				      $s = "Cinq Cent";
				    }
				    
				    array_push($recu_NumRecu, $r);
				    array_push($recu_AnneeCotisation, $a);
				    array_push($recu_Somme, $s);
				    array_push($recu_MontantCotisation, $m);
				  }

	  		} // endif
	  		// Si il y a une seule ligne
	  		else 
	  		{
	  			// Données variables en fonction du nbr années payées
			  	$recu_CINMedecin        = $recu_paiement->CINMedecin;
			  	$recu_NumTransaction    = $recu_paiement->NumRecuTransaction;
			  	$recu_NumRecu           = $recu_paiement->NumRecuGenere;
			  	$recu_AnneeCotisation   = $recu_paiement->AnneeCotisation;
			  	$recu_MontantCotisation = "";
			  	$recu_Somme             = "";

			  	$a = $recu_paiement->AnneeCotisation;
			    $m = $recu_paiement->MontantCotisation;
			    $s = '';

			    if ($a == '2009' || $a == '2010' || $a == '2011' || $a == '2012' || $a == '2013' || $a == '2014' || $a == '2015')
			    {
			      $s = "Trois Cent";
			    }
			    elseif ($a == '2016' || $a == '2017' || $a == '2018') {
			      $s = "Sept Cent";
			    }
			    else {
			      $s = "Cinq Cent";
			    }

			  	$recu_MontantCotisation = $m;
			  	$recu_Somme             = $s;

	  		} //endelse

	  		$recuPaiement = (object) array (
	  			'CINMedecin'					=>	$recu_CINMedecin,
	  			'NumTransaction'				=>	$recu_NumTransaction,
	  			'NumRecu'						=>	$recu_NumRecu,
	  			'Nom'							=>	$recu_Nom,
	  			'SecteurMedecin'				=>	$recu_SecteurMedecin,
	  			'SpecialiteMedecin'				=>	$recu_SpecialiteMedecin,
	  			'DateDiplome'					=>	$recu_DateDiplome,
	  			'DateRecrutement_Installation'	=>	$recu_DateRecrutement_Installation,
	  			'AdressePro'					=>	$recu_AdressePro,
	  			'Province'						=>	$recu_Province,
	  			'Region'						=>	$recu_Region,
	  			'DateCreation'					=>	$recu_DateCreation,
	  			'AnneePayee'					=>	$recu_AnneeCotisation,
	  			'MontantCotisation'				=>	$recu_MontantCotisation,
	  			'Somme'							=>	$recu_Somme,
				'Email'							=>	$mail
	  		);


	  		return $recuPaiement;

  		} // endif
  		else 
  		{
  			return 0;
  		} // endesle
    }

    // Output
    /**
     * CINMedecin - string
     * NumTransaction - string
     * [NumRecu] - array / string
     * Nom
     * SecteurMedecin
     * SpecialiteMedecin
     * DateDiplome
     * DateRecrutement_Installation
     * AdressePro
     * Province
     * Region
     * DateCreation
        ["AnneePayee"]
        ["MontantCotisation"]
        ["Somme"]
     * Email
     */

    $getRecu = RecupererRecu('WQ2973581834008814', 'Q297358');
    // echo "<pre>";
    // var_dump($getRecu);
    // echo "</pre>";

    if ($getRecu) {

		$CINMedecin 					=	$getRecu->CINMedecin;
		$numcommande					=	$getRecu->NumTransaction;
		$nom_medecin 					=	$getRecu->Nom;
		$secteur 						=	$getRecu->SecteurMedecin;
		$specialite 					=	$getRecu->SpecialiteMedecin;
		$date_diplome 					=	$getRecu->DateDiplome;
		$date_installation_recrutement 	=	$getRecu->DateRecrutement_Installation;
		$adresse_pro 					=	$getRecu->AdressePro;
		$province 						=	$getRecu->Province;
		$region 						=	$getRecu->Region;
		$daterecu 						=	$getRecu->DateCreation;
		$email 							=	$getRecu->Email;

		/**
		 */

       if (is_array($getRecu->AnneePayee)) {
           $annee 				= 	implode(',', $getRecu->AnneePayee);
           $numrecu 			= 	implode(',', $getRecu->NumRecu);
		   $montant 			= 	implode(',', $getRecu->MontantCotisation);
		   $somme 				=	implode(',', $getRecu->Somme);
       }
       else {
		$annee 		= 	$getRecu->AnneePayee;
		$numrecu 	= 	$getRecu->NumRecu;
		$montant 	= 	$getRecu->MontantCotisation;
		$somme 		=	$getRecu->Somme;
       }
	   $url = "../mail/test.recu.mail.php?CINMedecin=$CINMedecin&numcommande=$numcommande&nom_medecin=$nom_medecin&secteur=$secteur&specialite=$specialite&date_diplome=$date_diplome&date_installation_recrutement=$date_installation_recrutement&adresse_pro=$adresse_pro&province=$province&region=$region&daterecu=$daterecu&email=$email&annee=$annee&numrecu=$numrecu&montant=$montant&somme=$somme";
	   header("Location:$url");
    }
    else {
        echo "il ny a pas de recu";
    }

?>



<form action="#" method="post">
    <input type="text" name="cin" id="" placeholder="CIN">
    <input type="text" name="ncommande" id="" placeholder="Ncommande">
    <input type="submit" name="submit" value="Avoir recu">
</form>