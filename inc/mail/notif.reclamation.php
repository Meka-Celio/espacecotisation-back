<?php
//Import PHPMailer classes into the global namespace
require_once 'PHPMailer/src/PHPMailer.php';
require_once 'PHPMailer/src/SMTP.php';
require_once 'PHPMailer/src/Exception.php';

//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (isset($_GET['CIN'])) {

    $CINMedecin     =   $_GET['CIN'];
    $Nom_Medecin    =   $_GET['Nom'];
    $Email          =   $_GET['Email'];
    $Telephone      =   $_GET['Telephone'];
    $Region         =   $_GET['Region'];
    $Province       =   $_GET['Province'];
}
else {
    header('Location../form.reclamation.php?msg=403');
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
        $mail->setFrom($Email, "CIN : $CINMedecin");
        $mail->addAddress('support@cnom.ma', 'Support Espace Cotisation CNOM');
        $mail->addBCC('contact@cnom.ma', 'Service Espace Cotisation');     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Reclamation';
        $mail->Body    = "
            ---------------------------------------------- <br>
            Reclamation pour ajout dans le systeme      <br>
            ---------------------------------------------- <br>
            <br>
            ---------------------------------------------- <br>
            CINMedecin      :   $CINMedecin             <br>
            ---------------------------------------------- <br>
            <br>
            ---------------------------------------------- <br>
            Nom du medecin  :   $Nom_Medecin            <br>
            ---------------------------------------------- <br>
            <br>
            ---------------------------------------------- <br>
            Email           :   $Email                  <br>
            ---------------------------------------------- <br>
            <br>
            ---------------------------------------------- <br>
            Telephone       :   $Telephone              <br>
            ---------------------------------------------- <br>
            <br>
            ---------------------------------------------- <br>
            Region          :   $Region                 <br>
            ---------------------------------------------- <br>
            <br>
            ---------------------------------------------- <br>
            Province        :   $Province               <br>
            ---------------------------------------------- <br>
            <br><br>
            ********************************************** <br>
            Service CNOM APP <br>
            ********************************************** <br>
        ";
        $mail->AltBody = 'Demande de reclamation d\'existence';

        $mail->send();
        header('Location:../form.login.php?msg=reclam');
    } 
    catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
