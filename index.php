<?php

session_start();
$_SESSION['panier'] = [];
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<div class="container">
    <?php
    include "fichierCommuns/header.php";
    ?>
    <div class="champs1">
        <img src="images/carotts2.jpg" alt="Image de nos carottes">
    </div>
    <div class="Presentation">
        <h2><span class="welcome">B</span>ienvenue chez <span class="welcome">C</span>arottos</h2>
        <img src="images/Lapin_Carrotos.png" alt="Image du Lapin">
    </div>
    <div class="decouverte">

        <div class="imgDecouverte">
            <img src="images/decouverte.jpg" alt="Photo d'une agricultrice.">
        </div>
        <p id="txtDecouverte">Notre entreprise familiale de vente de carottes, présente dans le département de la Vienne
            depuis 1906, offre des produits frais et de qualité. Nous cultivons nos propres carottes sur nos
            terres familiales, garantissant ainsi leur fraîcheur et leur saveur unique. Nous avons 6
            employés dévoués pour assurer la satisfaction de nos clients. Nous nous engageons à offrir
            des carottes saines, cultivées de manière durable, et à promouvoir l'agriculture locale. Outre
            les carottes fraîches, nous proposons également des produits transformés tels que des jus de
            carottes et des conserves. Nous commençons également la culture de divers légumes comme
            les navets ou les topinambours depuis 2016. Faites confiance à notre expertise de plus d'un
            siècle dans le domaine et découvrez la qualité de nos produits. Nous sommes fiers de
            contribuer à l'agriculture locale et de pouvoir offrir des produits de qualité à nos clients.</p>
        <div class="pub">
        </div>
    </div>

<div class="prefooter">

</div>
    <?php
    include "fichierCommuns/footer.php";
    ?>
</div>

</body>
</html>