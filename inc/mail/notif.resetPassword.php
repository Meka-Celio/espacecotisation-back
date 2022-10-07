<?php
//Import PHPMailer classes into the global namespace
require_once 'PHPMailer/src/PHPMailer.php';
require_once 'PHPMailer/src/SMTP.php';
require_once 'PHPMailer/src/Exception.php';

//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$email = $_GET['email'];

if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
    $url = "https://";   
else  
    $url = "http://";  

// Append the host(domain name, ip) to the URL.   
$url.= $_SERVER['HTTP_HOST'];

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
    $mail->addAddress($email);
    $mail->addBCC('contact@cnom.ma');
    $mail->addBCC('support@cnom.ma', 'Support Espace Cotisation CNOM');

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Reinitialisation de mot de passe';
    $mail->Body    = "
    ------------------------ <br>
    ESPACE COTISATION <br>
    ------------------------ <br>
    Vous avez demande une reinitialisation de votre mot de passe. <br><br>
    Merci de suivre ce lien : <br>
    $url/cnom_app/form.resetPassword.php?source=mail <br><br>

    ";
    $mail->AltBody = 'Demande de reinitialisation de mot de passe';

    $mail->send();
    header('Location:../form.login.php?msg=resetPwd');
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}