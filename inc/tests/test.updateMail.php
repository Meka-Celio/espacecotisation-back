<?php 

    require     '../app.soapClient.php';
    require     '../model.collection.php';

    $getInfoMedecin = getInfoMedecin('*11');
    echo "Avant <br>";
    var_dump($getInfoMedecin);

    if (isset($_POST['submit'])) 
    {
        $cin = $_POST['CINMedecin'];
        $email = $_POST['Email'];

        $response = updateMailOnMarit($cin, $email);

        var_dump($response);

        $changement = true;
    }


?>


<form action="#" method="post">
    <input type="text" name="CINMedecin" id="" placeholder="CIN">
    <input type="text" name="Email" id="" placeholder="Email">
    <input type="submit" value="Mise a jour" name="submit">
</form>



<?php if (isset($changement)) { 
    $getInfoMedecin = getInfoMedecin('*11');
    echo "Après <br>";
    var_dump($getInfoMedecin);
} ?>
