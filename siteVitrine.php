<?php

include "BDD/requetes.php";
include "BDD/fonctionsDiverses.php";

session_start();
$produits = getAllProduits();

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nos Produits</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="images/CAndLapin.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
<div class="container">
    <?php
    include "fichierCommuns/header.php";
    ?>
    <div class="ListeProduits">

        <?php
            foreach ($produits as $produit){
                $id = $produit['id'];
                $nom = $produit['libelle'];
                $prix = number_format( $produit['prix'], 2 );
                $img = $produit['img'];
                $jourLivraison = dateLivraison($produit['joursAvantLivraison']);
                echo "
                    <div class='card'>
                        <div class='imageCard'>
                            <img src='$img' alt='Image du Produit'>
                        </div>
                        <div class='nomCard'>
                            <p>$nom</p>
                        </div>
                        <div class='prixCard'>
                            <p>$prix €/kg</p>
                        </div>
                        <div class='livraisonCard'>
                            <p>Livraison à partir du :<br> $jourLivraison</p>
                        </div>
                        <a href='pageProduitUnique.php?id=$id'>
                        <div class='detailsCard'>
                            <p>Plus de détails</p>                           
</div></a>
                    </div>";
            }
        ?>



    </div>
    <?php
    include "fichierCommuns/footer.php";
    ?>
</div>

</body>
</html>