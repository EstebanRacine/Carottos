<?php

session_start();

if (!isset($_SESSION['isCo'])){
    $_SESSION['isCo'] = False;
}

if (!$_SESSION['isCo']){
    header('Location: connexion.php');
}

?>


<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <title>Votre profil</title>
</head>
<body>
<div class="container">
    <?php
    include "fichierCommuns/header.php";
    ?>

    <div class="attente">BLBLBLBLBLBL</div>

    <?php
    include "fichierCommuns/footer.php";
    ?>
</div>
</body>
</html>