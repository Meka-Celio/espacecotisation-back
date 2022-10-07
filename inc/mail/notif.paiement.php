<?php
//Import PHPMailer classes into the global namespace
require_once 'PHPMailer/src/PHPMailer.php';
require_once 'PHPMailer/src/SMTP.php';
require_once 'PHPMailer/src/Exception.php';

//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


// Récupération des éléments du recu de paiement
if (isset($_GET['CIN'])) {

    // Section entete
    $NumCommande            =   $_GET['NumCommande'];
    $NumTransaction         =   $_GET['NumTransaction'];
    $NumAutorisation        =   $_GET['NumAutorisation'];
    $Montant                =   $_GET['Montant'];

    // Section User
    $CIN                    =   $_GET['CIN'];
    $Nom                    =   $_GET['Nom'];
    $Email                  =   $_GET['Email'];
    $NumCarte               =   $_GET['NumCarte'];
    $Region                 =   $_GET['Region'];
    $Province               =   $_GET['Province'];

    // Section Content
    $Date                   =   $_GET['Date'];
    $stringAnneesCotisation =   $_GET['AnneeCotisation']; // String
    $AnneeCotisation        =   explode(',', $stringAnneesCotisation); // Peut etre un array ou non

    // Section Footer
    $Commercant             =   $_GET['Commercant'];

    // $url = "NumCommande=$NumCommande&NumTransaction=$NumTransaction&NumAutorisation=$NumAutorisation&Montant=$Montant&CIN=$CIN&Nom=$Nom&Email=$Email&NumCarte=$NumCarte&Region=$Region&Province=$Province&Date=$Date&AnneeCotisation=$AnneeCotisation&Commercant=$Commercant";

}
// Sinon
else {
    header('Location:../view.dashboard.php?msg=noPaid');
}


//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
        //Server settings
        $mail->SMTPDebug  = 0;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'www.rachabusinessgroup.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'rachabusinessgro';                     // SMTP username
        $mail->Password   = 'R@ch@2017';                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail->Port       = 587; 

        //Recipients
        $mail->setFrom('contact@cnom.ma', 'Service Espace Cotisation');
        $mail->addAddress($Email, "CIN : $CIN");     //Add a recipient
        $mail->addBCC('contact@cnom.ma');
        $mail->addBCC('support@cnom.ma', 'Support Espace Cotisation CNOM');

        if (is_array($AnneeCotisation)) { // Si plusieurs cotisations

            for ($i=0; $i<count($AnneeCotisation); $i++) { // Boucle de parcours
                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Ticket de paiement';
                $mail->Body    = "
                
                ================================                    <br>
                TICKET DE COTISATION                                <br>
                ================================                    <br>
                N Commande     :   $NumCommande                     <br>
                N Transaction  :   $NumTransaction                  <br>
                N Autorisation :   $NumAutorisation                 <br>
                ....................................                <br>
                Montant         :   $Montant    DH                  <br>
                ....................................                <br>
                                                                    <br>
                ------------------------------------                <br>
                Nom             :   $Nom                            <br>
                Email           :   $Email                          <br>
                N              :   $NumCarte                        <br>
                -----------------------------------                 <br>
                Province        :   $Province                       <br>
                -----------------------------------                 <br>
                Region          :   $Region                         <br>
                -----------------------------------                 <br>
                                                                    <br>
                -----------------------------------                 <br>
                Annee de cotisation     :      $AnneeCotisation[$i] <br>
                -----------------------------------                 <br>
                Date et Heure   :   $Date                           <br>
                -----------------------------------                 <br>
                <br><br>
                <b>Votre reçu de paiement est en préparation.</b> <br><br>
                ***********************************                 <br>
                SERVICE ESPACE COTISATION                           <br>
                ***********************************                 <br>
                Commercant      :   $Commercant                     <br>
                ***********************************             <br><br>
                Pour toute information concernant le paiement en ligne, merci de prendre contact avec notre support <br>
                contact@cnom.ma 
                ";
                $mail->AltBody = 'Votre ticket de paiement';

                $mail->send();
            } // endfor
            header('Location:../view.dashboard.php?msg=payOk');
        }
        else {
            //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Ticket de paiement';
                $mail->Body    = "
                
                ================================                    <br>
                TICKET DE COTISATION                                <br>
                ================================                    <br>
                N Commande     :   $NumCommande                     <br>
                N Transaction  :   $NumTransaction                  <br>
                N Autorisation :   $NumAutorisation                 <br>
                ....................................                <br>
                Montant         :   $Montant    DH                  <br>
                ....................................                <br>
                                                                    <br>
                ------------------------------------                <br>
                Nom             :   $Nom                            <br>
                Email           :   $Email                          <br>
                N              :   $NumCarte                        <br>
                -----------------------------------                 <br>
                Province        :   $Province                       <br>
                -----------------------------------                 <br>
                Region          :   $Region                         <br>
                -----------------------------------                 <br>
                                                                    <br>
                -----------------------------------                 <br>
                Annee de cotisation     :      $AnneeCotisation     <br>
                -----------------------------------                 <br>
                Date et Heure   :   $Date                           <br>
                -----------------------------------                 <br>
                <br><br>
                <b>Votre reçu de paiement est en préparation.</b> <br><br>
                ***********************************                 <br>
                SERVICE ESPACE COTISATION                           <br>
                ***********************************                 <br>
                Commercant      :   $Commercant                     <br>
                ***********************************             <br><br>
                Pour toute information concernant le paiement en ligne, merci de prendre contact avec notre support <br>
                contact@cnom.ma 
                ";
                $mail->AltBody = 'Votre ticket de paiement';

                $mail->send();
                echo 'Pas tableau, Le mail est bien parti';
        }
    } 
    catch (Exception $e) {
        header('Location:view.dashboard.php?msg=paidFail');
}
