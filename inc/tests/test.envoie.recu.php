<?php
//Import PHPMailer classes into the global namespace
require_once '../mail/PHPMailer/src/PHPMailer.php';
require_once '../mail/PHPMailer/src/SMTP.php';
require_once '../mail/PHPMailer/src/Exception.php';

//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$test = "on";

if (isset($test)) {
    $CINMedecin                     =   "*11";
    $nom_medecin                    =   "Celio O";
    $email                          =   "nnhaud.celestin@gmail.com";
    $region                         =   "Estuaire";
    $province                       =   "Akanda";
    $numrecu                        =   ["21GAB", "22GAB", "23GAB"]; //array or not
    $montant                        =   ['500', '500', '1000']; //array or not
    $somme                          =   ["Cinq Cent", "Cinq Cent", "Mille"]; //array or not
    $annee                          =   ['2011', '2012', '2013']; //array or not
    $numcommande                    =   "Exempla";
    $secteur                        =   "Informatique";
    $specialite                     =   "Développeur Web";
    $date_diplome                   =   "2016";
    $date_installation_recrutement  =   "Exempla";
    $daterecu                       =   date("Y-m-d");
    $adresse_pro                    =   "Exempla";
    $msg = "addCotOk";

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);
    $mail->CharSet = "UTF-8";

    try {
            //Server settings
        $mail->SMTPDebug  = 1;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'www.rachabusinessgroup.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'rachabusinessgro';                     // SMTP username
        $mail->Password   = 'R@ch@2017';                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail->Port       = 587;

        //Recipients
        $mail->setFrom('contact@cnom.ma', 'Service Espace Cotisation');
        $mail->addAddress($email, "Dr $nom_medecin");
        $mail->addBCC('espacecotisation@cnom.ma', 'Contact Espace Cotisation');     //Add a recipient
        $mail->addBCC('c.meka@rachabusinessgroup.com', 'Service Espace Cotisation');

        for ($i=0; $i<count($annee); $i++) {

            //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Reçu de paiement de cotisation - CNOM';
        $mail->Body    = "
            <!DOCTYPE html>
                    <html lang='en' xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:v='urn:schemas-microsoft-com:vml'>
                    <head>
                    <title></title>
                    <meta charset='utf-8'/>
                    <meta content='width=device-width, initial-scale=1.0' name='viewport'/>
                    <!--[if mso]><xml><o:OfficeDocumentSettings><o:PixelsPerInch>96</o:PixelsPerInch><o:AllowPNG/></o:OfficeDocumentSettings></xml><![endif]-->
                    <style>
                            * {
                                box-sizing: border-box;
                            }

                            body {
                                margin: 0;
                                padding: 0;
                            }

                            a[x-apple-data-detectors] {
                                color: inherit !important;
                                text-decoration: inherit !important;
                            }

                            #MessageViewBody a {
                                color: inherit;
                                text-decoration: none;
                            }

                            p {
                                line-height: inherit
                            }

                            @media (max-width:880px) {
                                .icons-inner {
                                    text-align: center;
                                }

                                .icons-inner td {
                                    margin: 0 auto;
                                }

                                .row-content {
                                    width: 100% !important;
                                }

                                .stack .column {
                                    width: 100%;
                                    display: block;
                                }
                            }
                        </style>
                    </head>
                    <body style='background-color: #FFFFFF; margin: 0; padding: 0; -webkit-text-size-adjust: none; text-size-adjust: none;'>
                    <table border='0' cellpadding='0' cellspacing='0' class='nl-container' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFFFFF;' width='100%'>
                    <tbody>
                    <tr>
                    <td>
                    <table align='center' border='0' cellpadding='0' cellspacing='0' class='row row-1' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                    <tbody>
                    <tr>
                    <td>
                    <table align='center' border='0' cellpadding='0' cellspacing='0' class='row-content stack' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 860px;' width='860'>
                    <tbody>
                    <tr>
                    <td class='column' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;' width='33.333333333333336%'>
                    <table border='0' cellpadding='0' cellspacing='0' class='text_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;' width='100%'>
                    <tr>
                    <td style='padding-top:15px;padding-right:10px;padding-bottom:15px;padding-left:10px;'>
                    <div style='font-family: sans-serif'>
                    <div style='font-size: 14px; mso-line-height-alt: 16.8px; color: #17365d; line-height: 1.2; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;'>
                    <p style='margin: 0; font-size: 14px; text-align: center;'><span style='font-size:18px;'>Royaume du Maroc</span><br/><span style='font-size:24px;'><strong>Ordre National des</strong></span><br/><span style='font-size:24px;'><strong>Medecins</strong></span><br/><span style='font-size:18px;'>Conseil Regional</span></p>
                    </div>
                    </div>
                    </td>
                    </tr>
                    </table>
                    </td>
                    <td class='column' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;' width='33.333333333333336%'>
                    <table border='0' cellpadding='0' cellspacing='0' class='image_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                    <tr>
                    <td style='width:100%;padding-right:0px;padding-left:0px;padding-top:5px;padding-bottom:5px;'>
                    <div align='center' style='line-height:10px'><img src='https://zupimages.net/up/22/06/tqou.jpeg' style='display: block; height: auto; border: 0; width: 115px; max-width: 100%;' width='115'/></div>
                    </td>
                    </tr>
                    </table>
                    </td>
                    <td class='column' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;' width='33.333333333333336%'>
                    <table border='0' cellpadding='0' cellspacing='0' class='text_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;' width='100%'>
                    <tr>
                    <td style='padding-top:15px;padding-right:10px;padding-bottom:15px;padding-left:10px;'>
                    <div style='font-family: sans-serif'>
                    <div style='font-size: 14px; mso-line-height-alt: 28px; color: #17365d; line-height: 2; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;'>
                    <p style='margin: 0; font-size: 18px; mso-line-height-alt: 36px;'><span style='font-size:18px;'>RECU N : $numrecu[$i]</span></p>
                    <p style='margin: 0; font-size: 18px; mso-line-height-alt: 36px;'><span style='font-size:18px;'>Montant : $montant[$i] DHS</span></p>
                    </div>
                    </div>
                    </td>
                    </tr>
                    </table>
                    </td>
                    </tr>
                    </tbody>
                    </table>
                    </td>
                    </tr>
                    </tbody>
                    </table>
                    <table align='center' border='0' cellpadding='0' cellspacing='0' class='row row-2' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                    <tbody>
                    <tr>
                    <td>
                    <table align='center' border='0' cellpadding='0' cellspacing='0' class='row-content stack' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 860px;' width='860'>
                    <tbody>
                    <tr>
                    <td class='column' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;' width='100%'>
                    <table border='0' cellpadding='10' cellspacing='0' class='text_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;' width='100%'>
                    <tr>
                    <td>
                    <div style='font-family: sans-serif'>
                    <div style='font-size: 14px; mso-line-height-alt: 16.8px; color: #17365d; line-height: 1.2; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;'>
                    <p style='margin: 0; font-size: 14px; text-align: center;'><span style='font-size:38px;'>RECU DE COTISATION</span></p>
                    </div>
                    </div>
                    </td>
                    </tr>
                    </table>
                    </td>
                    </tr>
                    </tbody>
                    </table>
                    </td>
                    </tr>
                    </tbody>
                    </table>
                    <table align='center' border='0' cellpadding='0' cellspacing='0' class='row row-3' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                    <tbody>
                    <tr>
                    <td>
                    <table align='center' border='0' cellpadding='0' cellspacing='0' class='row-content stack' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 860px;' width='860'>
                    <tbody>
                    <tr>
                    <td class='column' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;' width='100%'>
                    <table border='0' cellpadding='10' cellspacing='0' class='text_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;' width='100%'>
                    <tr>
                    <td>
                    <div style='font-family: sans-serif'>
                    <div style='font-size: 14px; mso-line-height-alt: 28px; color: #17365d; line-height: 2; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;'>
                    <p style='margin: 0; font-size: 14px; mso-line-height-alt: 32px;'><span style='font-size:16px;'>Recu du Dr : <strong>$nom_medecin</strong></span><br/><span style='font-size:16px;'>La somme de : <strong>$somme[$i]</strong></span><br/><span style='font-size:16px;'>Pour paiement de la cotisation au titre de l'annee : <strong>$annee[$i]</strong></span><br/><span style='font-size:16px;'>Mode de paiement : Paiement en ligne N: <strong>$numcommande </strong></span></p>
                    <p style='margin: 0; font-size: 14px; mso-line-height-alt: 32px;'><span style='font-size:16px;'>Secteur <strong>: $secteur  </strong> <br>Specialite <strong>: $specialite <br/></strong></span></p>
                    <p style='margin: 0; font-size: 14px; mso-line-height-alt: 32px;'><span style='font-size:16px;'>Date d'obtention du Diplome<strong> : $date_diplome <br/></strong></span></p>
                    </div>
                    </div>
                    </td>
                    </tr>
                    </table>
                    </td>
                    </tr>
                    </tbody>
                    </table>
                    </td>
                    </tr>
                    </tbody>
                    </table>
                    <table align='center' border='0' cellpadding='0' cellspacing='0' class='row row-4' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                    <tbody>
                    <tr>
                    <td>
                    <table align='center' border='0' cellpadding='0' cellspacing='0' class='row-content stack' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 860px;' width='860'>
                    <tbody>
                    <tr>
                    <td class='column' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;' width='66.66666666666667%'>
                    <table border='0' cellpadding='0' cellspacing='0' class='text_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;' width='100%'>
                    <tr>
                    <td style='padding-top:15px;padding-right:10px;padding-bottom:15px;padding-left:10px;'>
                    <div style='font-family: sans-serif'>
                    <div style='font-size: 14px; mso-line-height-alt: 16.8px; color: #17365d; line-height: 1.2; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;'>
                    <p style='margin: 0; font-size: 14px;'><span style='font-size:16px;'>Date d'installation ou de recrutement : </span><strong><span style='font-size:16px;'>$date_installation_recrutement </span><br/></strong></p>
                    </div>
                    </div>
                    </td>
                    </tr>
                    </table>
                    </td>
                    <td class='column' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;' width='33.333333333333336%'>
                    <table border='0' cellpadding='0' cellspacing='0' class='text_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;' width='100%'>
                    <tr>
                    <td style='padding-top:15px;padding-right:10px;padding-bottom:15px;padding-left:10px;'>
                    <div style='font-family: sans-serif'>
                    <div style='font-size: 14px; mso-line-height-alt: 16.8px; color: #17365d; line-height: 1.2; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;'>
                    <p style='margin: 0; font-size: 14px;'><span style='font-size:16px;'>Date recu : <strong>$daterecu</strong></span> </p>
                    </div>
                    </div>
                    </td>
                    </tr>
                    </table>
                    </td>
                    </tr>
                    </tbody>
                    </table>
                    </td>
                    </tr>
                    </tbody>
                    </table>
                    <table align='center' border='0' cellpadding='0' cellspacing='0' class='row row-5' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                    <tbody>
                    <tr>
                    <td>
                    <table align='center' border='0' cellpadding='0' cellspacing='0' class='row-content stack' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 860px;' width='860'>
                    <tbody>
                    <tr>
                    <td class='column' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;' width='100%'>
                    <table border='0' cellpadding='10' cellspacing='0' class='text_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;' width='100%'>
                    <tr>
                    <td>
                    <div style='font-family: sans-serif'>
                    <div style='font-size: 14px; mso-line-height-alt: 16.8px; color: #17365d; line-height: 1.2; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;'>
                    <p style='margin: 0; font-size: 14px;'><span style='font-size:16px;'>Adresse professionnelle : <strong>$adresse_pro</strong></span></p>
                    </div>
                    </div>
                    </td>
                    </tr>
                    </table>
                    </td>
                    </tr>
                    </tbody>
                    </table>
                    </td>
                    </tr>
                    </tbody>
                    </table>
                    <table align='center' border='0' cellpadding='0' cellspacing='0' class='row row-6' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                    <tbody>
                    <tr>
                    <td>
                    <table align='center' border='0' cellpadding='0' cellspacing='0' class='row-content stack' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 860px;' width='860'>
                    <tbody>
                    <tr>
                    <td class='column' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;' width='50%'>
                    <table border='0' cellpadding='0' cellspacing='0' class='text_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;' width='100%'>
                    <tr>
                    <td style='padding-top:15px;padding-right:10px;padding-bottom:15px;padding-left:10px;'>
                    <div style='font-family: sans-serif'>
                    <div style='font-size: 14px; mso-line-height-alt: 16.8px; color: #17365d; line-height: 1.2; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;'>
                    <p style='margin: 0; font-size: 14px;'><span style='font-size:16px;'>Province : <strong>$province</strong></span></p>
                    </div>
                    </div>
                    </td>
                    </tr>
                    </table>
                    </td>
                    <td class='column' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;' width='50%'>
                    <table border='0' cellpadding='0' cellspacing='0' class='text_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;' width='100%'>
                    <tr>
                    <td style='padding-top:15px;padding-right:10px;padding-bottom:15px;padding-left:10px;'>
                    <div style='font-family: sans-serif'>
                    <div style='font-size: 14px; mso-line-height-alt: 16.8px; color: #17365d; line-height: 1.2; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;'>
                    <p style='margin: 0; font-size: 14px;'><span style='font-size:16px;'>Region : <strong>$region</strong></span></p>
                    </div>
                    </div>
                    </td>
                    </tr>
                    </table>
                    </td>
                    </tr>
                    </tbody>
                    </table>
                    </td>
                    </tr>
                    </tbody>
                    </table>
                    <table align='center' border='0' cellpadding='0' cellspacing='0' class='row row-7' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                    <tbody>
                    <tr>
                    <td>
                    <table align='center' border='0' cellpadding='0' cellspacing='0' class='row-content stack' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 860px;' width='860'>
                    <tbody>
                    <tr>
                    <td class='column' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;' width='100%'>
                    <table border='0' cellpadding='0' cellspacing='0' class='icons_block' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                    <tr>
                    <td style='color:#9d9d9d;font-family:inherit;font-size:15px;padding-bottom:5px;padding-top:5px;text-align:center;'>
                    <table cellpadding='0' cellspacing='0' role='presentation' style='mso-table-lspace: 0pt; mso-table-rspace: 0pt;' width='100%'>
                    <tr>
                    <td style='text-align:center;'>
                    <!--[if vml]><table align='left' cellpadding='0' cellspacing='0' role='presentation' style='display:inline-block;padding-left:0px;padding-right:0px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;'><![endif]-->
                    <!--[if !vml]><!-->
                    </td>
                    </tr>
                    </table>
                    </td>
                    </tr>
                    </table>
                    </td>
                    </tr>
                    </tbody>
                    </table>
                    </td>
                    </tr>
                    </tbody>
                    </table>
                    </td>
                    </tr>
                    </tbody>
                    </table><!-- End -->
                    </body>
            </html>
        ";
        $mail->AltBody = 'Votre reçu de paiement';

        $mail->send();
        }
        echo "Les reçus ont bien été envoyé";
    } 
    catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
else {
    header('Location../view.error.php?msg=403');
}

    // https://cnom.ma/procedure-paiement-en-ligne/
