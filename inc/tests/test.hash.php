<?php 
    if (isset($_POST['password'])) {
        // $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        // echo "Password : ".$password;
        $password = $_POST['password'];
    }else{}

    if(isset($_POST['v_pass'])) {
        $password = $_POST['value_pass'];
        $valide = password_verify($_POST['v_pass'], $password);
        if ($valide) {
            echo "Le mot de passe correspond !";
            echo "<br> Mot de passe : ".$_POST['v_pass'];
        } else {
            echo "Le mot de passe ne correspond pas !";
            var_dump(password_verify($_POST['v_pass'], $password));
        }
    }


?>

<?php  
        if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
             $url = "https://";   
        else  
             $url = "http://";   
        // Append the host(domain name, ip) to the URL.   
        $url.= $_SERVER['HTTP_HOST'];   
        
        // Append the requested resource location to the URL   
        $url.= $_SERVER['REQUEST_URI'];    
          
        echo $url;  

?>   


<pre>
    <?php var_dump($_SERVER); ?>
</pre>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hashage</title>
</head>
<body>
    <h2>Créer un mot de passe</h2>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
        <input type="text" name="password" id="password" placeholder="Mot de passe">
        <button type="submit">Envoyer</button>
    </form>

    <?php if (isset($password)) { ?>
        <p>Valider le mot de passe</p>
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
            <input type="text" name="v_pass" id="v_pass" placeholder="Vérifier mot de passe">
            <input type="password" name="value_pass" id="value_pass" value="<?= $password ?>">
            <button type="submit">Envoyer</button>
        </form>
    <?php } ?>
</body>
</html>