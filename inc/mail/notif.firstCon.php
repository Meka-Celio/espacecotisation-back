<?php
//Import PHPMailer classes into the global namespace
require_once 'PHPMailer/src/PHPMailer.php';
require_once 'PHPMailer/src/SMTP.php';
require_once 'PHPMailer/src/Exception.php';
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$Email  = $_GET['Email'];
$CIN    = $_GET['CIN'];

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
    $mail->addAddress($Email);
    $mail->addBCC('contact@cnom.ma');
    $mail->addBCC('support@cnom.ma', 'Support Espace Cotisation CNOM');

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Premiere connexion';
    $mail->Body    = "
    ------------------------------------ <br>
    ESPACE COTISATION <br>
    ------------------------------------ <br>
    Vous avez proccede a la premiere modification de votre mot de passe. <br><br>
    **************************************************<br>
    SERVICE ESPACE COTISATION <br>
    **************************************************<br><br>
    Pour toute information, merci de prendre contact avec notre support <br>
    contact@cnom.ma 
    ";
    $mail->AltBody = 'Vous avez fait le premier changement de mot de passe';
    $mail->send();
    header('Location:../form.login.php?msg=updatePwd');
} catch (Exception $e) {
    echo "Le message a pas été envoyé. Erreur: {$mail->ErrorInfo}";
}