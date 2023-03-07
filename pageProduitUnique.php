<?php
include_once "BDD/requetes.php";
include_once "BDD/fonctionsDiverses.php";

session_start();
$_SESSION['panier'] = [];




$id = $_GET['id'];
$avis = getAvisById($id);
$produit = getProduitById($id);
$img = $produit['img'];
$nom = $produit['libelle'];
$descr = $produit['description'];
$prix = number_format( $produit['prix'], 2 );
$joursLivraison = dateLivraison($produit['joursAvantLivraison']);
$nbEtoilesMoyen = 0;

if (empty($avis)){
    $nbEtoilesVide = 5;
}else {
    foreach ($avis as $avisUnic) {
        $nbEtoilesMoyen += $avisUnic['nbEtoiles'];
    }
    $nbEtoilesMoyen = round($nbEtoilesMoyen / count($avis));
    $nbEtoilesVide = 5 - $nbEtoilesMoyen;
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
    <title>Votre Produit</title>
</head>
<body>
<div class="container">
    <?php
    include "fichierCommuns/header.php";
    ?>
    <div class="produit">
        <div class="infosProduit">
            <img src="<?= $img ?>" alt="Image du produit">
            <h2><?= $nom ?></h2>
            <p id="prixProduit"><?= $prix." €/kg" ?></p>
            <p id="joursLiv">Livraison dès le <?= $joursLivraison ?></p>

            <form action="">
                <input hidden type="text" name="quantité" value="1">
                <input class="ajoutPanier" type="submit" value="Ajouter au panier">
            </form>
        </div>
        <div class="descrProduits">
            <h2>Description du produit</h2>
            <p><?= $descr ?></p>
        </div>
        <div class="avisProduits">
            <h2>
                Avis
                <?php

                for($i = 0; $i<$nbEtoilesMoyen; $i++){
                    echo "<i class='fa-solid fa-star jaune'></i>";
                }
                for($i = 0; $i<$nbEtoilesVide; $i++){
                    echo "<i class='fa-regular fa-star jaune'></i>";
                }

                ?>

                <div class="listeAvis">
                    <?php
                    foreach ($avis as $avisUnique){
                        $user = $avisUnique['userAvis'];
                        $texte = $avisUnique['txtAvis'];
                        $nbEtoilesAvis = $avisUnique['nbEtoiles'];
                        $nbEtoilesVideAvis = 5-$nbEtoilesAvis;
                        ?>
                    <div class="avisUnique">
                        <h2><?= $user."  "?>
                            <?php
                            for($i = 0; $i<$nbEtoilesAvis; $i++){
                                echo "<i class='fa-solid fa-star jaune'></i>";
                            }
                            for($i = 0; $i<$nbEtoilesVideAvis; $i++){
                                echo "<i class='fa-regular fa-star jaune'></i>";
                            }
                            ?>
                        </h2>

                        <p><?= $texte ?></p>

                    </div>

                    <?php
                    }
                    ?>


                </div>

            </h2>
        </div>
    </div>

    <?php
    include "fichierCommuns/footer.php";
    ?>
</div>
</body>
</html>
