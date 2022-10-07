<?php 
	require '../app.soapClient.php';
?>

<?php 
	
	// 1er Formulaire
	if (isset($_POST['CINMedecin'])) {
      $CINMedecin = $_POST['CINMedecin'];
      $NCommande = $_POST['NCommande'];
      $IdParamCotisation = $_POST['IdParamCotisation'];

      // Appel de la fonction
      $addCotisation = testAjoutCotisation($CINMedecin, $NCommande, $IdParamCotisation);
      if ($addCotisation) {
        $msg = 'addCotOk';
        var_dump($addCotisation);
        //echo "CIN : $CINMedecin; NumRecu : $NCommande; IDCotisation : $IdParamCotisation";

      }
    }
	 

    // 2e Formulaire
    if (isset($_POST['CIN'])) {
    	$CIN = $_POST['CIN'];
      	$NTicket = $_POST['NTicket'];

      // Appel de la fonction
      	$getRecu = testGetRecu($NTicket, $CIN);
      	// echo "<pre>";
      	// var_dump($getRecu);
      	// echo "</pre>";
      	$recu_paiement = $getRecu->TestGetRecuCotisationPayerAvecAuthResult->MedecinCotisationPayee;
      	// var_dump($recu_paiement);

      	for ($i=0; $i<count($recu_paiement); $i++)
      	{	echo "Reçu $i <br>";
      		var_dump($recu_paiement[$i]);
      		echo "<br>";
      	}

      	/*
			["TypeCotisation"]=>
        string(19) "Cotisation Annuelle"
        ["CINMedecin"]=>
        string(7) "GM71516"
        ["ModeVersement"]=>
        string(17) "Paiement en ligne"
        ["NumRecuTransaction"]=>
        string(15) "WMAS33691631616"
        ["NumRecuGenere"]=>
        string(7) "5343/MS"
        ["NomMedecin"]=>
        string(8) "LHAMIANI"
        ["PrenomMedecin"]=>
        string(6) "Chafik"
        ["AdresseMedecin"]=>
        string(14) "Chu Mohamed Vi"
        ["AnneeCotisation"]=>
        string(4) "2015"
        ["MontantCotisation"]=>
        string(3) "300"
      	*/
    }

// CIN : GM71516; NumRecu : WMAS33691631616; IDCotisation : 37 

 ?>
 <br>
	<!--main content start-->
      <section id="main-content">
          <section class="wrapper">
            <h3><i class="fa fa-angle-right"></i> Mon Profil</h3>
            
            <!-- BASIC FORM ELELEMNTS -->
            <div class="row mt col-md-6">
                <div class="col-lg-12">
                  <div class="form-panel">

                  	<form action="#" method="POST">
                      <div class="form-group">
                        <input type="text" name="CINMedecin" value="" placeholder="CIN" required>
                      </div>

                      <div class="form-group">
                        <input type="text" name="NCommande" value="" placeholder="NumCommande" required>
                      </div>

                      <div class="form-group">
                        <input type="text" name="IdParamCotisation" value="" placeholder="ID Annee Cotisation" required>
                      </div>

                      <button>Envoyer</button>
                    </form>


                    <form action="#" method="POST">
                      <div class="form-group">
                        <input type="text" name="CIN" value="" placeholder="CIN" required>
                      </div>

                      <div class="form-group">
                        <input type="text" name="NTicket" value="" placeholder="NTicket" required>
                      </div>

                      <button>Envoyer</button>
                    </form>

                  </div>
                </div><!-- col-lg-12-->         
            </div><!-- /row --></section><! --/wrapper -->
      </section><!-- /MAIN CONTENT -->