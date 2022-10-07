<?php

   

    require_once 'pdf.php';

   

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>recu_<?= $NumRecu ?></title>

    <style>

     .container{

        position: fixed;

        left: 0px;

        top: -45px;

        right: 0px;

        height: 150px;

        text-align: center;

        box-sizing: border-box;

        color : #17365d;  

}

 

table {

  font-family: Sakkal Majalla, sans-serif;

  width: 100%;

  font-size: 14px;

}

 

td, th {

  text-align: left;

  padding: 3px;

}

 

.titre{

  font-size: 18px;

}

 

.logo{

  width: 90px;

  left: 60px;

}

.right{

  font-size: 20px;

 

}

.Royaume{

  text-align:center;

}

 

.gras{

  font-weight: 100;

}

.title{

  font-family:Arial,sans-serif;

   text-align:center;

   margin: 5px;

   font-size: 28px;

   font-weight: 1;

    }

</style>

 

</head>

<body>

   

    <div class="container">

        <!-- premier tableau -->

      <table>

        <tr>

          <td class="Royaume"><p> <span class="titre">Royaume du Maroc</span><br>

          <strong><span class="right">Ordre National des<br><span class="med"> Médecins </span></strong></span>

        <br><span class="titre">Conseil Régional</span></p></td>

          <td  class="Royaume">  <img src="img/logo.jpg" alt=""  class="logo"></td>

          <td class="Royaume"> <p class="titre">REÇU N° : <?= $NumRecu ?> </p>

            <p class="titre">Montant : <?= $MontantCotisation ?> DHS</p></td>

        <tr>

         

      </table>

          <p class="title">REÇU DE COTISATION</p>

       

     <!-- deuxième tableau -->

    <table>

  <tr>

    <td>Reçu du Dr : <span class="gras"><?= $Nom ?></span> </td>

  </tr>

  <tr>

  <td>La somme de : <span class="gras"><?= $Somme ?> Dirhams</span></td>

  </tr>

  <tr>

  <td>Pour paiement de la cotisation au titre de l'année : <span class="gras"><?= $AnneePayee ?></span>  </td>

  </tr>

  <tr>

  <td>Mode de paiement : <span class="gras">Paiement en ligne  N°: <?= $NumTransaction ?></span> </td>

  </tr>

  </table>

   <!-- troisième tableau -->

    <table>

  <tr>

  <td>Secteur : <span class="gras"><?= $SecteurMedecin ?></span></td>

  <td>Spécialité : <span class="gras"><?= $SpecialiteMedecin ?></span> </td>

  </tr>

  </table>

 

   <!-- quatrième tableau -->

  <table>

  <tr>

  <td>Date d'obtention du Diplôme : <span class="gras"><?= $DateDiplome ?></span></td>

  </tr>

  <tr>

 

  <td>Date d'installation ou de recrutement : <span class="gras"><?= $DateRecrutement_Installation ?></span></td>

  <td>Date reçu : <span class="gras"><?= $DateCreation ?></span></td>

  </tr>

  <tr>

  <td>Adresse professionnelle : <span class="gras"><?= $AdressePro ?></span></td>

 

  </tr>

</table>

<!-- cinquième tableau -->

<table>

<tr>

    <td>Province : <span class="gras"><?=  $Province ?></span></td>

    <td>Région : <span class="gras"><?=  $Region ?></span></td>

  </tr>

 

</table>

</table>

    </div>

   

</body>

</html>knk