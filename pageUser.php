<?php

session_start();

include_once "BDD/requetes.php";

if (!isset($_SESSION['isCo'])){
    $_SESSION['isCo'] = False;
}

if (!$_SESSION['isCo']){
    header('Location: connexion.php');
}

if ($_SERVER['REQUEST_METHOD']=="POST"){
    if (isset($_POST['deco'])) {
        $_SESSION['user'] = [];
        $_SESSION['isCo'] = False;
        header('Location: index.php');
    }else{
        header('Location: modifierProfil.php');
    }
}

$commandes = getCommandeByUserId($_SESSION['user']['id']);


$dateNaiss = date('d / m / Y', strtotime($_SESSION['user']['dateNaiss']));
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

    <div class="pageUser">
        <div class="infosUsers">
            <img src="images/client.jpg" alt="Image client">
            <p>Nom : <br> <span class="infoPageUser"><?= $_SESSION['user']['nom']?></span></p>
            <p>Prénom : <br> <span class="infoPageUser"> <?= $_SESSION['user']['prenom']?> </span></p>
            <p>Date de naissance : <br> <span class="infoPageUser"><?= $dateNaiss?></span></p>
            <p>Ville : <br> <span class="infoPageUser"><?= $_SESSION['user']['ville']?></span></p>
            <p id="mailUser"> Mail :<br> <span class="infoPageUser"><?= $_SESSION['user']['mail']?></span></p>
            <form method="post" id="modifier">
                <button type="submit" name="modif" value="1"><i class="fa-sharp fa-solid fa-pen"></i>Modifier</button>
            </form>
            <form method="post" id="deconnexion">
                <button type="submit" name="deco" value="1"><i class="fa-sharp fa-solid fa-xmark"></i>Se déconnecter</button>
            </form>
        </div>
        <h1>Récapitulatif de vos commandes</h1>
        <table id="listeCommandesPassees">
            <tbody>

            <?php
            if (empty($commandes)){
                echo "<tr id='ancienneCommandeEmpty'><td class='VertContact'>Vous n'avez encore jamais passé de commande.</td></tr>";
            }
            foreach ($commandes as $commande){
            ?>

                <tr class="grilleAncienPanier" onclick="document.location='ancienPanier.php?idPanier=<?= $commande['idCommande'] ?>'" >
                    <td><i class="fa-solid fa-basket-shopping"></i></td>
                    <td><?=  getNbProdByCommandeId($commande['idCommande'])[0]." produit(s)"?></td>
                    <td><?= "Le ".date('d/m/Y', strtotime($commande['dateCommande']))?></td>
                    <td><?= getPrixTotalCommande($commande['idCommande'])." €"?></td>
                </tr>

            <?php
            }
            ?>

            </tbody>
        </table>
    </div>

    <?php
    include "fichierCommuns/footer.php";
    ?>
</div>
</body>
</html>