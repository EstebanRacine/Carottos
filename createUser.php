<?php

session_start();
$erreur = [];
$nom = null;
$prenom = null;
$login = null;
$mail = null;
$dateNaiss = null;
$ville= null;
$password = null;

include_once "BDD/requetes.php";
include_once "BDD/fonctionsDiverses.php";

if ($_SERVER['REQUEST_METHOD']=="POST"){

    if (empty(trim($_POST['nom']))){
        $erreur['nom'] = "Veuillez remplir le nom";
    }else{
        $nom = $_POST['nom'];
    }

    if (empty(trim($_POST['prenom']))){
        $erreur['prenom'] = "Veuillez remplir le prénom";
    }else{
        $prenom = $_POST['prenom'];
    }

    if (empty(trim($_POST['login']))){
        $erreur['login'] = "Veuillez remplir le login";
    }else{
        if (verifLogin($_POST['login'])){
            $login = $_POST['login'];
        }else{
            $erreur['login'] = "Le login est déjà utilisé";
        }
    }

    if (empty(trim($_POST['ville']))){
        $erreur['ville'] = "Veuillez remplir la ville";
    }else{
        $ville = $_POST['ville'];
    }

    if (empty(trim($_POST['mail']))){
        $erreur['mail'] = "Veuillez remplir le mail";
    }else{
        if(filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)){
            $mail = $_POST['mail'];
        }else{
            $erreur['mail'] = "Le mail n'est pas valide";
        }
    }

    if (empty(trim($_POST['dateNaiss']))){
        $erreur['dateNaiss'] = "Veuillez remplir la date de naissance";
    }else{
        $dateNaiss = $_POST['dateNaiss'];
    }

    if (empty(trim($_POST['password']))){
        $erreur['password'] = "Veuillez remplir le mot de passe";
    }else{
        $test = testMdp($_POST['password']);
        if ($test == "1"){
            $password = $_POST['password'];
        }else{
            $erreur['password'] = $test;
        }
    }
    if ($erreur == []){
        addUser($nom, $prenom, $mail, $login, $password, $dateNaiss, $ville );
        header("Location: index.php");
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

            <label for="login">Login <span class="Rouge">*</span></label>
            <input type="text" name="login" id="login" value="<?= $login ?>">
            <?php
            if (isset($erreur['login'])){
                echo "<p class='Rouge erreurForm'>".$erreur['login']."</p>";
            }
            ?>

            <label for="password">Mot de passe <span class="Rouge">*</span></label>
            <input type="password" name="password" id="password" value="<?= $password ?>">
            <?php
            if (isset($erreur['password'])){
                echo "<p class='Rouge erreurForm'>".$erreur['password']."</p>";
            }
            ?>
            <p class="infoPassword">Le mot de passe doit contenir 8 caractères et doit être formé par des majuscules, des minuscules et des chiffres</p>


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
