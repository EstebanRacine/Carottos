<?php

include_once "BDD/requetes.php";

session_start();

if(!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

if ($_SERVER['REQUEST_METHOD']=="POST"){
    $id = $_POST['id'];
    unset($_SESSION['panier'][$id]);
}

$panier = $_SESSION['panier'];
$pFinal = 0;
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mon panier</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
<div class="container">
    <?php
    include "fichierCommuns/header.php";
    ?>
    <div class="panier">
        <h2>Votre panier</h2>

        <?php
        if (empty($panier)){
            echo "<h3>Votre panier est vide</h3>";
        }else{
        ?>
<div class="tabPanier">
        <div class="prodPanier startTabPanier">
            <p></p>
            <p></p>
            <p>Libellé</p>
            <p>Prix au kilo</p>
            <p>Quantité</p>
            <p>Prix Total</p>
        </div>



        <?php
        foreach ($panier as $id=>$quantite){
            $quantite = $quantite['quantite'];
            $produit = getProduitById($id);
            $nom = $produit['libelle'];
            $prix = $produit['prix'];
            $img = $produit['img'];
            $pTotal = str_replace(",", "", number_format( $quantite*$prix, 2 ));
            $pFinal += floatval($pTotal);
        ?>
            <div class="prodPanier">
                <form method="post">
                    <input hidden type="text" value="<?= $id ?>" name="id">
                    <input type="submit" value="X" class="supp">
                </form>
                <img src="<?= $img ?>" alt="Image du produit">
                <p><?= $nom ?></p>
                <p><?= $prix." €/kg" ?></p>
                <p><?= $quantite." kg" ?></p>
                <p><?= $pTotal." €" ?></p>
            </div>

        <?php
        }
        $pFinal = number_format( $pFinal, 2 )

        ?>

            <div class="prodPanier endTabPanier">
                <p></p>
                <p></p>
                <p></p>
                <p></p>
                <p></p>
                <p><?= $pFinal." €"?></p>
            </div>
</div>

        <?php
        }
        ?>

    </div>



    <?php
    include "fichierCommuns/footer.php";
    ?>
</div>
</body>
</html>
