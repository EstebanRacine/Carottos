<?php

session_start();
if ($_SERVER['REQUEST_METHOD']=="POST"){

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Creer un compte</title>
</head>
<body>
<div class="container">
    <?php
    include "fichierCommuns/header.php";
    ?>

    <div class="createUser">
        <h1><span class="VertContact">C</span>reez un compte chez nous ;)</h1>
        <form action="" method="post" autocomplete="off">
            <label for="nom">Nom <span class="Rouge">*</span></label>
            <input type="text" id="nom" name="nom">

            <label for="prenom">Prénom <span class="Rouge">*</span></label>
            <input type="text" name="prenom" id="prenom">

            <label for="login">Login <span class="Rouge">*</span></label>
            <input type="text" name="login" id="login">

            <label for="password">Mot de passe <span class="Rouge">*</span></label>
            <input type="password" name="password" id="password">

            <label for="ville">Ville <span class="Rouge">*</span></label>
            <input type="text" name="ville" id="ville">

            <label for="mail">Adresse email <span class="Rouge">*</span></label>
            <input type="text" name="mail" id="mail">

            <label for="dateNaiss">Date de naissance <span class="Rouge">*</span></label>
            <input type="date" name="dateNaiss" id="dateNaiss">

            <button class="buttonCreerUser" type="submit">
                Créer
            </button>
        </form>



    </div>

    <?php
    include "fichierCommuns/footer.php";
    ?>
</div>
</body>
</html>
