<?php
include_once "BDD/requetes.php";

session_start();

if(!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

if(!isset($_SESSION['user'])) {
    $_SESSION['user'] = [];
}
if (!isset($_SESSION['isCo'])){
    $_SESSION['isCo'] = false;
}

$listePtLivraison = getAllPointsRelais();

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
    <title>Validation du panier</title>
</head>
<body>

<div class="container">
    <?php
    include "fichierCommuns/header.php";
    ?>
    <script src="fichierCommuns/affichageDivLieuChoisi.js"></script>

    <div class="validationPanier">
        <a href="panier.php" id="back" class="retourPanierFromValidation"><i class="fa-solid fa-arrow-left"></i></a>
        <form action="" method="post" id="formulaireValidation">
            <div class="informationsAcheteur">
                <h2><span class="VertContact">V</span>os informations</h2>
                <div class="infosFinales">
                    <div class="nomPrenomMail">
                        <p><span class="VertContact">Nom</span> : <?= $_SESSION['user']['nom']?></p>
                        <p><span class="VertContact">Prénom</span> : <?= $_SESSION['user']['prenom']?></p>
                        <p id="mailFinal"><span class="VertContact">Mail</span> : <?= $_SESSION['user']['mail']?></p>
                    </div>
                    <div class="adresseFinaleUser">
                        <i class="fa-solid fa-house"></i>
                        <p><?= $_SESSION['user']['ville'] ?></p>
                    </div>
                </div>

            </div>

            <div class="lieuLivraison">
                <div class="infosLieuLiv">
                    <h2> <span class="VertContact">L</span>ieu de livraison</h2>
                        <select name="selectLiv" id="selectLiv">
                            <optgroup label="Lieu de livraison">
                                <?php
                                foreach ($listePtLivraison as $pt){
                                ?>
                                    <option value="<?= $pt['idPtLiv']?>"><?= $pt['nomPtLiv'] ?></option>
                                <?php
                                }
                                ?>
                            </optgroup>
                        </select>
                        <?php
                        foreach ($listePtLivraison as $pt){
                            $idDiv = "Emplacement".$pt['idPtLiv'];
                        ?>
                        <div class="affichageInfosPtLiv" id="<?= $idDiv ?>>">
                            <p id="nomPtLiv"><?= $pt['nomPtLiv']?></p>
                            <p><?= $pt['adressePtLiv'] ?></p>
                            <p><?= $pt['villePtLiv'] ?></p>
                            <p id="telPtLiv"><?= $pt['telPtLiv'] ?></p>
                        </div>
                        <?php
                        }
                        ?>
                </div>
                <div class="mapsLivValidation">
                    <iframe src="https://www.google.com/maps/d/u/0/embed?mid=13a-tH3peAIRYu6gOZKbqNBAmSgcC4m4&ehbc=2E312F" width="100%" height="400px"></iframe>
                </div>
            </div>

            <div class="methodePaiement">
                <h2><span class="VertContact">M</span>oyen de paiement</h2>
            </div>

            <button type="submit">Valider votre panier</button>
        </form>
    </div>

    <?php
    include "fichierCommuns/footer.php";
    ?>
</div>



</body>
</html>


