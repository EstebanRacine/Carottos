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


    <div class="validationPanier">
        <a href="panier.php" id="back" class="retourPanierFromValidation"><i class="fa-solid fa-arrow-left"></i></a>
        <form action="" method="post" id="formulaireValidation">
            <h1><span class="VertContact">R</span>écapitulatif de votre commande</h1>
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
                    <script src="fichierCommuns/affichageDivLieuChoisi.js"></script>
                    <h2> <span class="VertContact">L</span>ieu de livraison</h2>
                        <select name="selectLiv" class="selectLiv">
                            <option value="0">Veuillez choisir un lieu</option>
                            <?php
                            foreach ($listePtLivraison as $emplacement){
                                ?>

                                <option value="<?= $emplacement['idPtLiv'] ?>"><?= $emplacement['nomPtLiv'] ?></option>

                                <?php
                            }
                            ?>
                        </select>

                        <?php
                        foreach ($listePtLivraison as $emplacement){
                            ?>

                            <div class="affichageInfosLiv" id=<?= "Emplacement".$emplacement['idPtLiv'] ?>>
                                <p class="nomPtLiv"><?= $emplacement['nomPtLiv'] ?></p>
                                <p><?= $emplacement['adressePtLiv'] ?>, </p>
                                <p><?= $emplacement['villePtLiv'] ?></p>
                                <p class="telPtLiv"> <i class="fa-solid fa-phone"></i> <?= $emplacement['telPtLiv'] ?></p>
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
                <script src="fichierCommuns/affichageTypePaiement.js"></script>
                <h2><span class="VertContact">M</span>oyen de paiement</h2>
                <p></p>
                <div class="moyenPaiementChoix">
                    <p id="paypal"><input id="paypalRadio" type="radio" name="paiement" value="paypal"> Paypal <i class="fa-brands fa-cc-paypal"></i> </p>
                    <p id="creditCard"><input id="creditCardRadio" type="radio" name="paiement" value="credit"> Carte de crédit <i class="fa-solid fa-credit-card"></i></p>
                    <p id="carteCadeau"><input id="carteCadeauRadio" type="radio" name="paiement" value="gift"> Carte cadeau <i class="fa-solid fa-gift"></i> </p>
                    <p id="applePay"><input id="applePayRadio" type="radio" name="paiement" value="apple"> Apple Pay <i class="fa-brands fa-cc-apple-pay"></i></p>
                </div>
                <div class="affichageInfosPaiement paypalDiv" id="Paiementpaypal">
                    <button>Payer via PayPal <svg width="50" height="20" viewBox="0 0 100 32">
                            <path fill="#003087" d="M 12 4.917 L 4.2 4.917 C 3.7 4.917 3.2 5.317 3.1 5.817 L 0 25.817 C -0.1 26.217 0.2 26.517 0.6 26.517 L 4.3 26.517 C 4.8 26.517 5.3 26.117 5.4 25.617 L 6.2 20.217 C 6.3 19.717 6.7 19.317 7.3 19.317 L 9.8 19.317 C 14.9 19.317 17.9 16.817 18.7 11.917 C 19 9.817 18.7 8.117 17.7 6.917 C 16.6 5.617 14.6 4.917 12 4.917 Z M 12.9 12.217 C 12.5 15.017 10.3 15.017 8.3 15.017 L 7.1 15.017 L 7.9 9.817 C 7.9 9.517 8.2 9.317 8.5 9.317 L 9 9.317 C 10.4 9.317 11.7 9.317 12.4 10.117 C 12.9 10.517 13.1 11.217 12.9 12.217 Z"></path>
                            <path fill="#003087" d="M 35.2 12.117 L 31.5 12.117 C 31.2 12.117 30.9 12.317 30.9 12.617 L 30.7 13.617 L 30.4 13.217 C 29.6 12.017 27.8 11.617 26 11.617 C 21.9 11.617 18.4 14.717 17.7 19.117 C 17.3 21.317 17.8 23.417 19.1 24.817 C 20.2 26.117 21.9 26.717 23.8 26.717 C 27.1 26.717 29 24.617 29 24.617 L 28.8 25.617 C 28.7 26.017 29 26.417 29.4 26.417 L 32.8 26.417 C 33.3 26.417 33.8 26.017 33.9 25.517 L 35.9 12.717 C 36 12.517 35.6 12.117 35.2 12.117 Z M 30.1 19.317 C 29.7 21.417 28.1 22.917 25.9 22.917 C 24.8 22.917 24 22.617 23.4 21.917 C 22.8 21.217 22.6 20.317 22.8 19.317 C 23.1 17.217 24.9 15.717 27 15.717 C 28.1 15.717 28.9 16.117 29.5 16.717 C 30 17.417 30.2 18.317 30.1 19.317 Z"></path>
                            <path fill="#003087" d="M 55.1 12.117 L 51.4 12.117 C 51 12.117 50.7 12.317 50.5 12.617 L 45.3 20.217 L 43.1 12.917 C 43 12.417 42.5 12.117 42.1 12.117 L 38.4 12.117 C 38 12.117 37.6 12.517 37.8 13.017 L 41.9 25.117 L 38 30.517 C 37.7 30.917 38 31.517 38.5 31.517 L 42.2 31.517 C 42.6 31.517 42.9 31.317 43.1 31.017 L 55.6 13.017 C 55.9 12.717 55.6 12.117 55.1 12.117 Z"></path>
                            <path fill="#009cde" d="M 67.5 4.917 L 59.7 4.917 C 59.2 4.917 58.7 5.317 58.6 5.817 L 55.5 25.717 C 55.4 26.117 55.7 26.417 56.1 26.417 L 60.1 26.417 C 60.5 26.417 60.8 26.117 60.8 25.817 L 61.7 20.117 C 61.8 19.617 62.2 19.217 62.8 19.217 L 65.3 19.217 C 70.4 19.217 73.4 16.717 74.2 11.817 C 74.5 9.717 74.2 8.017 73.2 6.817 C 72 5.617 70.1 4.917 67.5 4.917 Z M 68.4 12.217 C 68 15.017 65.8 15.017 63.8 15.017 L 62.6 15.017 L 63.4 9.817 C 63.4 9.517 63.7 9.317 64 9.317 L 64.5 9.317 C 65.9 9.317 67.2 9.317 67.9 10.117 C 68.4 10.517 68.5 11.217 68.4 12.217 Z"></path>
                            <path fill="#009cde" d="M 90.7 12.117 L 87 12.117 C 86.7 12.117 86.4 12.317 86.4 12.617 L 86.2 13.617 L 85.9 13.217 C 85.1 12.017 83.3 11.617 81.5 11.617 C 77.4 11.617 73.9 14.717 73.2 19.117 C 72.8 21.317 73.3 23.417 74.6 24.817 C 75.7 26.117 77.4 26.717 79.3 26.717 C 82.6 26.717 84.5 24.617 84.5 24.617 L 84.3 25.617 C 84.2 26.017 84.5 26.417 84.9 26.417 L 88.3 26.417 C 88.8 26.417 89.3 26.017 89.4 25.517 L 91.4 12.717 C 91.4 12.517 91.1 12.117 90.7 12.117 Z M 85.5 19.317 C 85.1 21.417 83.5 22.917 81.3 22.917 C 80.2 22.917 79.4 22.617 78.8 21.917 C 78.2 21.217 78 20.317 78.2 19.317 C 78.5 17.217 80.3 15.717 82.4 15.717 C 83.5 15.717 84.3 16.117 84.9 16.717 C 85.5 17.417 85.7 18.317 85.5 19.317 Z"></path>
                            <path fill="#009cde" d="M 95.1 5.417 L 91.9 25.717 C 91.8 26.117 92.1 26.417 92.5 26.417 L 95.7 26.417 C 96.2 26.417 96.7 26.017 96.8 25.517 L 100 5.617 C 100.1 5.217 99.8 4.917 99.4 4.917 L 95.8 4.917 C 95.4 4.917 95.2 5.117 95.1 5.417 Z"></path>
                        </svg></button>
                </div>
            </div>


            <button type="submit" id="validationPanier" value="1">Valider votre panier</button>
        </form>
    </div>

    <?php
    include "fichierCommuns/footer.php";
    ?>
</div>



</body>
</html>


