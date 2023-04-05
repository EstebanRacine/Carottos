<?php
session_start();

include_once "BDD/requetes.php";

if (!isset($_SESSION['isCo'])){
    $_SESSION['isCo'] = False;
}

if (!$_SESSION['isCo']){
    header('Location: connexion.php');
}

$nom = $_SESSION['user']['nom'];
$prenom = $_SESSION['user']['prenom'];
$mail = $_SESSION['user']['mail'];
$ville = $_SESSION['user']['ville'];
$dateNaiss = $_SESSION['user']['dateNaiss'];
$erreur = [];

if ($_SERVER['REQUEST_METHOD']=="POST") {

    if (empty(trim($_POST['nom']))) {
        $erreur['nom'] = "Veuillez remplir le nom";
    } else {
        $nom = $_POST['nom'];
    }

    if (empty(trim($_POST['prenom']))) {
        $erreur['prenom'] = "Veuillez remplir le prénom";
    } else {
        $prenom = $_POST['prenom'];
    }

    if (empty(trim($_POST['ville']))) {
        $erreur['ville'] = "Veuillez remplir la ville";
    } else {
        $ville = $_POST['ville'];
    }

    if (empty(trim($_POST['mail']))) {
        $erreur['mail'] = "Veuillez remplir le mail";
    } else {
        if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
            $mail = $_POST['mail'];
        } else {
            $erreur['mail'] = "Le mail n'est pas valide";
        }
    }

    if (empty(trim($_POST['dateNaiss']))) {
        $erreur['dateNaiss'] = "Veuillez remplir la date de naissance";
    } else {
        $dateNaiss = $_POST['dateNaiss'];
    }

    if ($erreur == []) {
        changeUser($_SESSION['user']['id'], $nom, $prenom, $dateNaiss, $ville, $mail);
        $_SESSION['user']['nom'] = $nom;
        $_SESSION['user']['prenom'] = $prenom;
        $_SESSION['user']['dateNaiss'] = $dateNaiss;
        $_SESSION['user']['ville'] = $ville;
        $_SESSION['user']['mail'] = $mail;
        header('Location: pageUser.php');
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="images/CAndLapin.png">
    <title>Modifier votre profil</title>
</head>
<body>
<div class="container">
    <?php
    include "fichierCommuns/header.php";
    ?>

    <div class="createUser">
        <h1>Modifier votre profil</h1>
        <form action="" method="post" autocomplete="off">
            <label for="nom">Nom <span class="Rouge">*</span></label>
            <input type="text" id="nom" name="nom" value="<?= $nom ?>">
            <?php
            if (isset($erreur['nom'])){
                echo "<p class='Rouge erreurForm'>".$erreur['nom']."</p>";
            }
            ?>

            <label for="prenom">Prénom <span class="Rouge">*</span></label>
            <input type="text" name="prenom" id="prenom" value="<?= $prenom ?>">
            <?php
            if (isset($erreur['prenom'])){
                echo "<p class='Rouge erreurForm'>".$erreur['prenom']."</p>";
            }
            ?>

            <label for="ville">Ville <span class="Rouge">*</span></label>
            <input type="text" name="ville" id="ville" value="<?= $ville ?>">
            <?php
            if (isset($erreur['ville'])){
                echo "<p class='Rouge erreurForm'>".$erreur['ville']."</p>";
            }
            ?>

            <label for="mail">Adresse email <span class="Rouge">*</span></label>
            <input type="text" name="mail" id="mail" value="<?= $mail ?>">
            <?php
            if (isset($erreur['mail'])){
                echo "<p class='Rouge erreurForm'>".$erreur['mail']."</p>";
            }
            ?>

            <label for="dateNaiss">Date de naissance <span class="Rouge">*</span></label>
            <input type="date" name="dateNaiss" id="dateNaiss" value="<?= $dateNaiss ?>">
            <?php
            if (isset($erreur['dateNaiss'])){
                echo "<p class='Rouge erreurForm'>".$erreur['dateNaiss']."</p>";
            }
            ?>

            <button class="buttonCreerUser" type="submit">
                Modifier
            </button>
        </form>
    </div>

    <?php
    include "fichierCommuns/footer.php";
    ?>
</div>
</body>
</html>
