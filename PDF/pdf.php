    <?php

    use Dompdf\Dompdf;
    use Dompdf\Options;

    if (isset($_POST['submit']))
    {
        $NumTransaction                 =   $_POST['NumTransaction'];
        $NumRecu                        =   $_POST['NumRecu'];
        $Nom                            =   $_POST['Nom'];
        $SecteurMedecin                 =   $_POST['SecteurMedecin'];
        $SpecialiteMedecin              =   $_POST['SpecialiteMedecin'];
        $DateDiplome                    =   $_POST['DateDiplome'];
        $DateRecrutement_Installation   =   $_POST['DateRecrutement_Installation'];
        $AdressePro                     =   $_POST['AdressePro'];
        $Province                       =   $_POST['Province'];
        $Region                         =   $_POST['Region'];
        $DateCreation                   =   $_POST['DateCreation'];
        $AnneePayee                     =   $_POST['AnneePayee'];
        $MontantCotisation              =   $_POST['MontantCotisation'];
        $Somme                          =   $_POST['Somme'];
    }

    $pdf_name = str_replace('/', '_', $NumRecu);

    ob_start();
    require 'index.php';  
    $html = ob_get_contents();
    ob_end_clean();
    // die($html);

    require 'vendor/autoload.php';

    $options  = new Options();      

    $options->set('defaultFont', 'courier');
    
    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($html);
   
    $dompdf->setPaper('A4', 'portrait');

    $dompdf->render();

    $dompdf->stream("recu_$pdf_name.pdf");

