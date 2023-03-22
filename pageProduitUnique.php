<?php
include_once "BDD/requetes.php";
include_once "BDD/fonctionsDiverses.php";

session_start();

if(!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

if (!isset($_SESSION['isCo'])){
    $_SESSION['isCo'] = false;
}

if ($_SERVER['REQUEST_METHOD'] == "POST"){
    if (empty(trim($_POST['quantite']))){
        $erreur = "La quantité est vide";
    }elseif (!is_numeric($_POST['quantite'])){
        $erreur = "La quantité n'est pas valide";
    }else{
        if (isset($_SESSION['panier'][$_POST['id']])){
            $_SESSION['panier'][$_POST['id']]['quantite'] += $_POST['quantite'];
        }else{
            $_SESSION['panier'][$_POST['id']]['quantite'] = $_POST['quantite'];
        }
        changeQteStock($_POST['id'], $_POST['quantite'], '-');
        $message = "Le produit a bien été ajouté au panier.";
        $script = '<script type="text/javascript">window.alert("'.$message.'");</script>';
    }

}


$id = $_GET['id'];
$avis = getAvisById($id);
$produit = getProduitById($id);
$img = $produit['img'];
$nom = $produit['libelle'];
$descr = $produit['description'];
$stock = $produit['QteStock'];
$color = "VertContact";

if ($stock < 6){
    $color = "Rouge";
}

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
        <a href="siteVitrine.php" id="back"><i class="fa-solid fa-arrow-left"></i></a>
        <div class="infosProduit">
            <img src="<?= $img ?>" alt="Image du produit">
            <h2><?= $nom ?></h2>
            <p id="prixProduit"><?= $prix." €/kg" ?></p>
            <?php
            if ($stock > 0){
                echo "<p id='stock' class='$color'> Reste en stock : $stock kg</p>";
            }
            else{
                echo "<p class='Rouge'> En rupture de stock</p>";
            }
            ?>


            <p id="joursLiv">Livraison dès le <?= $joursLivraison ?></p>

            <form method="post" autocomplete="off">
                <input hidden type="text" value="<?= $id ?>" name="id">
                <div class="erreurQté">
                    <input type="text" name="quantite" <?php if ($stock==0){echo " value='//' ";}else{echo "value='1'";}?> class="quantite <?php if (isset($erreur)){echo "erreur";}?> <?php if ($stock==0){echo " valeurInterdite ";}?>" <?php if ($stock==0){echo " disabled ";}?>>
                    <?php
                    if (isset($script)) {
                        echo $script;
                    }
                    if (isset($erreur)){
                        echo "<p>Erreur : $erreur</p>";
                    }
                    ?>
                </div>
                <input class="ajoutPanier <?php if ($stock==0){echo " ajoutPanierInterdit ";}?>" type="submit" value="Ajouter au panier" <?php if ($stock==0){echo " disabled ";}?>>
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
