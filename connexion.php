<?php

include "BDD/requetes.php";

session_start();

if (!isset($_SESSION['isCo'])){
    $_SESSION['isCo'] = false;
}else{
    if ($_SESSION['isCo']){
        header('Location: pageUser.php');
    }
}

if ($_SERVER['REQUEST_METHOD']=="POST"){
    if (verifConnection($_POST['login'], $_POST['password'])){
        $_SESSION['isCo'] = true;
        $user = getUserByLogin($_POST['login']);
        $_SESSION['user']['login'] = $user['login'];
        $_SESSION['user']['nom'] = $user['nomUser'];
        $_SESSION['user']['prenom'] = $user['prenomUser'];
        $_SESSION['user']['dateNaiss'] = $user['dateNaissance'];
        $_SESSION['user']['ville'] = $user['villeUser'];
        $_SESSION['user']['mail'] = $user['mailUser'];
        $_SESSION['user']['id'] = $user['idUser'];
        $location = "Location: pageUser.php";
        if (isset($_GET['validerPanier'])){
            $location .= "?validerPanier=1";
        }
        header($location);
    }
}


?>


<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="images/CAndLapin.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Connexion</title>
</head>
<body>
<div class="container">
    <?php
    include_once "fichierCommuns/header.php";
    ?>
    <div class="connexion">
        <h1><span class="VertContact">C</span>onnexion</h1>
        <form action="" method="post" autocomplete="off">
            <input type="text" placeholder="Login" name="login">
            <input type="password" placeholder="Mot de passe" name="password">
            <input type="submit" value="Connexion" id="buttonConnexion">
        </form>
        <p>Pas encore de compte ?</p>
        <a href="createUser.php">Créez en un !</a>
    </div>





    <?php
    include_once "fichierCommuns/footer.php";
    ?>
</div>




</body>
</html>
