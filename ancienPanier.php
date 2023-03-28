<?php

include_once "BDD/requetes.php";
include_once "BDD/fonctionsDiverses.php";

session_start();


if (!isset($_SESSION['isCo'])){
    $_SESSION['isCo'] = false;
}


if (!$_SESSION['isCo']){
    header('Location: connexion.php');
}

$idComm = $_GET['idPanier'];
$commande = getCommandeByIdCommande($idComm);
if ($commande['idUser'] <> $_SESSION['user']['id']){
    header('Location: pageIntrouvable.php');
}

$datePanier = ecritureDateLettreViaBDD($commande['dateCommande']);


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
    <title>Votre commande du <?= $datePanier ?></title>
</head>
<body>
<div class="container">
    <?php
    include "fichierCommuns/header.php";
    ?>

    <div class="ancienPanier">
        <a href="pageUser.php" id="back" class="retourPageUserFromAncienPanier"><i class="fa-solid fa-arrow-left"></i></a>
        <h1>Votre panier du <?= $datePanier ?></h1>
        <table>
            <thead>
            <th></th>
            <th>Libellé</th>
            <th>Prix au kilo</th>
            <th>Quantité en <span class="VertContact">kg</span></th>
            <th>Prix Total <span class="VertContact">HT</span></th>
            <th>Prix Total <span class="VertContact">TTC</span></th>
            </thead>
            <tbody>
            <?php
            $produits = getProduitsByCommande($idComm);
            foreach ($produits as $produit){
                $lib = $produit['libelle'];
                $img = $produit['img'];
                $prix = number_format($produit['prix'], 2);
                $qteProd = $produit['qteProd'];
                $total = number_format($qteProd*$prix, 2);
                $totalHT = number_format($total/1.055, 2);
            ?>
                <tr>
                    <td><img src="<?= $img ?>" alt="Image du produit"></td>
                    <td><?= $lib ?></td>
                    <td><?= $prix." €" ?></td>
                    <td><?= $qteProd ?></td>
                    <td><?= $totalHT." €" ?></td>
                    <td><?= $total." €" ?></td>
                </tr>
            <?php
            }
            ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><?= getPrixTotalCommande($idComm)." €
                " ?></td>
            </tr>
            </tbody>
        </table>
    </div>

    <?php
    include "fichierCommuns/footer.php";
    ?>

</div>

</body>
</html>
