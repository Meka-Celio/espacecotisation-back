<?php
// chargement de la page SOAP Client
    require '../app.soapClient.php';

    

    if (isset($_POST['CINMedecin'])) {
      $CINMedecin = $_POST['CINMedecin'];
      $NumRecuCotisation = $_POST['NumRecuCotisation'];
      $IdParamCotisation = $_POST['IdParamCotisation'];

      // Appel de la fonction
      $addCotisation = addCotisationMedecin($CINMedecin, $NumRecuCotisation, $IdParamCotisation);
      var_dump($addCotisation);
    }

    /**
     * Variables obtenues pour la fonction getCotisationPayer
     * - Id. Annee. AnneeMontant
     * **************************
     * Variables obtenues pour la fonction getCotisationNonPayer
     * - Id. Annee. AnneeMontant 
     */

    ?>

<form action="#" method="POST">
  <div class="form-group">
    <input type="text" name="CINMedecin" value="" placeholder="CIN">
  </div>

  <div class="form-group">
    <input type="text" name="NumRecuCotisation" value="" placeholder="NumCommande">
  </div>

  <div class="form-group">
    <input type="text" name="IdParamCotisation" value="" placeholder="ID Annee Cotisation">
  </div>

  <button>Envoyer</button>
</form> -->

