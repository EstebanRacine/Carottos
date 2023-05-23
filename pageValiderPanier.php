<?php
include_once "BDD/requetes.php";
include_once "BDD/fonctionsDiverses.php";

session_start();

if(!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

if ($_SESSION['panier']==[]){
    header('Location: index.php');
}

if(!isset($_SESSION['user'])) {
    $_SESSION['user'] = [];
}
if (!isset($_SESSION['isCo'])){
    $_SESSION['isCo'] = false;
}

if (!isset($_SESSION['remise'])){
    $_SESSION['remise'] = 0;
}

$listePtLivraison = getAllPointsRelais();
$codeCarteCadeau = getAllCodeCarteCadeau();
$codeCarte = "";
$codePromo = "";
$remise = null;
$erreurs = [];
$messagePromo = "";
$titulaireCredit = null;
$numCredit = null;
$cryptoCredit = null;
$dateCredit = null;

$nbJoursLiv = 0;
foreach ($_SESSION['panier'] as $idProd => $QteProd){
    if ($nbJoursLiv < getLivByIdProd($idProd)){
        $nbJoursLiv = getLivByIdProd($idProd);
    }
}
$dateLiv = dateLivraison($nbJoursLiv);



$chaine = '';
foreach ($codeCarteCadeau as $code){
    $chaine .= '"'.$code.'",';
}
$chaine = substr($chaine, 0, strlen($chaine)-1);


$tabAssocCarte = '';


$paiementCoche = "";
if ($_SERVER['REQUEST_METHOD']=="POST"){

    if (isset($_POST['paiement'])){
        $paiementCoche = $_POST['paiement'];
        if ($paiementCoche == "carteCadeau"){
            if (isset($_POST['noCadeau'])){
                $codeCarte = $_POST['noCadeau'];
            }
        }
    }

    if (isset($_POST['annulerRemise'])){
        $_SESSION['prixTotal'] += $_SESSION['remise'];
        $_SESSION['prixTotal'] = number_format($_SESSION['prixTotal'], 2);
        unset($_SESSION['remise']);
    }

    if (isset($_POST['codePromoButton'])) {
        if (($_SESSION['remise'] <> 0)){
            $erreurs['codePromo'] = "<p class='Rouge'>Vous avez déjà utilisé un code promo</p>"."<button type='submit' name='annulerRemise' class='buttonPromo annulerRemise'>Annuler la remise</button>" ;
        }
        if (!empty(trim($_POST['codePromo']))) {
            $codePromo = strtoupper($_POST['codePromo']);
        }
        $verifCode = false;
        foreach (getAllCodePromo() as $codeP) {
            if ($codeP == $codePromo) {
                $verifCode = true;
                $remise = getRemiseByCode($codePromo);
                $messagePromo = "<p class='VertContact messagePromo'>La remise avec ce code est de " . $remise . " %</p>";
            }
        }

        if (!$verifCode) {
            $erreurs['codePromo'] = "<p class='Rouge'>Le code n'est pas valide</p>";
        }
    }


    if (isset($_POST['boutonCadeau'])){
        if (isset($_POST['newPrixTotal'])) {
            $_SESSION['remise'] = $_POST['remise'];
            $_SESSION['prixTotal'] = $_POST['newPrixTotal'];
        }
//        ENVOYER SUR PAGE CHOIX MONTANT UTILISE
        header('Location: index.php');
    }

    if (isset($_POST['validerPanier'])){

        if ($_POST['selectLiv'] == 0){
            $erreurs['lieuLiv'] = "Veuillez choisir un lieu de livraison";
        }

        if (!empty(trim($_POST['tituCredit']))){
            $titulaireCredit = $_POST['tituCredit'];
        }else{
            $erreurs['tituCredit'] = "<p class='Rouge'>Veuillez remplir le champ Titulaire</p>";
        }

        if (!empty(trim($_POST['numCredit']))){
            $numCredit = $_POST['numCredit'];
        }else{
            $erreurs['numCredit'] = "<p class='Rouge'>Veuillez remplir le champ Numéro de carte</p>";
        }

        if (!empty(trim($_POST['cryptoCredit']))){
            $cryptoCredit = $_POST['cryptoCredit'];
        }else{
            $erreurs['cryptoCredit'] = "<p class='Rouge'>Veuillez remplir le champ Cryptogramme</p>";
        }

        if (!empty(trim($_POST['dateCredit']))){
            $dateCredit = $_POST['dateCredit'];
        }else{
            $erreurs['dateCredit'] = "<p class='Rouge'>Veuillez remplir le champ Date d'expiration</p>";
        }

        if(empty($erreurs)){
//            PASSER SUR MESSAGE VALIDATION ET ENREGISTRER COMMANDE

            if (isset($_POST['newPrixTotal'])){
                $_SESSION['prixTotal'] = $_POST['newPrixTotal'];
            }

            if (isset($_POST['remise'])){
                $_SESSION['remise'] = $_POST['remise'];
            }

            addCommande( $_SESSION['user']['id'], $_POST['selectLiv'], $_SESSION['prixTotal'], $_SESSION['remise'], $_POST['dateLivraison']);
            $idCommande = getIdLastCommandeByIdUser($_SESSION['user']['id']);
            foreach ($_SESSION['panier'] as $idProd=>$quantProd){
                addContenu($idProd, $idCommande, $quantProd['quantite']);
            }
            unset($_SESSION['panier']);
            unset($_SESSION['prixTotal']);
            if (isset($_SESSION['remise'])){
                unset($_SESSION['remise']);
            }
            header("Location: ancienPanier.php?idPanier=$idCommande");
        }
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
    <link rel="icon" href="images/CAndLapin.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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

            <div class="recapTotalPanier">
                <h2><span class="VertContact">C</span>oût de votre commande</h2>
                <div class="prixTotalFinCommande">
                    <div class="prix">
                        <p id="nomPrixTotal"><span class="VertContact">P</span>rix Total </p>
                        <p> <?= $_SESSION['prixTotal'] ?> € </p>
                        <?php
                        if ($messagePromo != "" && ($_SESSION['remise']==0)){
                            $remise = $_SESSION['prixTotal']*($remise/100);
                            $remise = number_format($remise, 2);
                            echo "<p class='Rouge remise'> - ".$remise." €</p>";
                            $newPrix = number_format($_SESSION['prixTotal']-$remise, 2);
                            echo "<p class='prixPostRemise'> ". $newPrix ." € </p>";
                            echo  "<input type='text' name='remise' hidden value=$remise>";
                            echo  "<input type='text' name='newPrixTotal' hidden value=$newPrix>";
                        }
                        ?>
                    </div>
                    <div class="codePromo">
                        <label for="codePromo"><span class="VertContact">C</span>ode <span class="VertContact">P</span>romo</label>
                        <input type="text" name="codePromo" id="codePromo" value=<?= $codePromo ?>>
                        <button type="submit" name="codePromoButton" class="buttonPromo">Utiliser</button>
                        <?php
                        if (isset($erreurs['codePromo'])){
                            echo $erreurs['codePromo'];
                        }else{
                            echo $messagePromo;
                        }
                        ?>
                    </div>
                </div>


            </div>

            <div class="lieuLivraison">
                <div class="infosLieuLiv">
                    <script src="fichierCommuns/affichageDivLieuChoisi.js"></script>
                    <h2> <span class="VertContact">L</span>ieu de livraison</h2>

                    <h3>Livraison le <?= $dateLiv ?></h3>
                    <input type="text" hidden value="<?= $dateLiv ?>" name="dateLivraison">
                    <?php
                    if (isset($erreurs['lieuLiv'])){
                        echo "<p class='Rouge'>{$erreurs['lieuLiv']}</p>";
                    }
                    ?>

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
                <div class="moyenPaiementChoix">
                    <p id="paypal"><input onclick="choixPaiement()" id="paypalRadio" type="radio" name="paiement" value="paypal" <?php $valAct = "paypal"; if ($valAct == $paiementCoche){echo "checked=cheked";} ?> >
                        <label for="paypalRadio">Paypal <i class="fa-brands fa-cc-paypal"></i></label> </p>
                    <p id="creditCard"><input onclick="choixPaiement()" id="creditCardRadio" type="radio" name="paiement" value="creditCard" <?php $valAct = "creditCard"; if ($valAct == $paiementCoche){echo "checked=cheked";} ?>>
                        <label for="creditCardRadio">Carte de crédit <i class="fa-solid fa-credit-card"></i></label></p>
                    <p id="carteCadeau"><input onclick="choixPaiement()" id="carteCadeauRadio" type="radio" name="paiement" value="carteCadeau" <?php $valAct = "carteCadeau"; if ($valAct == $paiementCoche){echo "checked=cheked";} ?>>
                        <label for="carteCadeauRadio">Carte cadeau <i class="fa-solid fa-gift"></i></label> </p>
                    <p id="applePay"><input onclick="choixPaiement()" id="applePayRadio" type="radio" name="paiement" value="applePay" <?php $valAct = "applePay"; if ($valAct == $paiementCoche){echo "checked=cheked";} ?>>
                        <label for="applePayRadio">Apple Pay <i class="fa-brands fa-cc-apple-pay"></i></label></p>
                </div>
                <div class="affichageInfosPaiement" id="PaiementPaypal">
                    <button>Payer via<svg width="55" height="30" viewBox="0 0 100 32">
                            <path fill="#003087" d="M 12 4.917 L 4.2 4.917 C 3.7 4.917 3.2 5.317 3.1 5.817 L 0 25.817 C -0.1 26.217 0.2 26.517 0.6 26.517 L 4.3 26.517 C 4.8 26.517 5.3 26.117 5.4 25.617 L 6.2 20.217 C 6.3 19.717 6.7 19.317 7.3 19.317 L 9.8 19.317 C 14.9 19.317 17.9 16.817 18.7 11.917 C 19 9.817 18.7 8.117 17.7 6.917 C 16.6 5.617 14.6 4.917 12 4.917 Z M 12.9 12.217 C 12.5 15.017 10.3 15.017 8.3 15.017 L 7.1 15.017 L 7.9 9.817 C 7.9 9.517 8.2 9.317 8.5 9.317 L 9 9.317 C 10.4 9.317 11.7 9.317 12.4 10.117 C 12.9 10.517 13.1 11.217 12.9 12.217 Z"></path>
                            <path fill="#003087" d="M 35.2 12.117 L 31.5 12.117 C 31.2 12.117 30.9 12.317 30.9 12.617 L 30.7 13.617 L 30.4 13.217 C 29.6 12.017 27.8 11.617 26 11.617 C 21.9 11.617 18.4 14.717 17.7 19.117 C 17.3 21.317 17.8 23.417 19.1 24.817 C 20.2 26.117 21.9 26.717 23.8 26.717 C 27.1 26.717 29 24.617 29 24.617 L 28.8 25.617 C 28.7 26.017 29 26.417 29.4 26.417 L 32.8 26.417 C 33.3 26.417 33.8 26.017 33.9 25.517 L 35.9 12.717 C 36 12.517 35.6 12.117 35.2 12.117 Z M 30.1 19.317 C 29.7 21.417 28.1 22.917 25.9 22.917 C 24.8 22.917 24 22.617 23.4 21.917 C 22.8 21.217 22.6 20.317 22.8 19.317 C 23.1 17.217 24.9 15.717 27 15.717 C 28.1 15.717 28.9 16.117 29.5 16.717 C 30 17.417 30.2 18.317 30.1 19.317 Z"></path>
                            <path fill="#003087" d="M 55.1 12.117 L 51.4 12.117 C 51 12.117 50.7 12.317 50.5 12.617 L 45.3 20.217 L 43.1 12.917 C 43 12.417 42.5 12.117 42.1 12.117 L 38.4 12.117 C 38 12.117 37.6 12.517 37.8 13.017 L 41.9 25.117 L 38 30.517 C 37.7 30.917 38 31.517 38.5 31.517 L 42.2 31.517 C 42.6 31.517 42.9 31.317 43.1 31.017 L 55.6 13.017 C 55.9 12.717 55.6 12.117 55.1 12.117 Z"></path>
                            <path fill="#009cde" d="M 67.5 4.917 L 59.7 4.917 C 59.2 4.917 58.7 5.317 58.6 5.817 L 55.5 25.717 C 55.4 26.117 55.7 26.417 56.1 26.417 L 60.1 26.417 C 60.5 26.417 60.8 26.117 60.8 25.817 L 61.7 20.117 C 61.8 19.617 62.2 19.217 62.8 19.217 L 65.3 19.217 C 70.4 19.217 73.4 16.717 74.2 11.817 C 74.5 9.717 74.2 8.017 73.2 6.817 C 72 5.617 70.1 4.917 67.5 4.917 Z M 68.4 12.217 C 68 15.017 65.8 15.017 63.8 15.017 L 62.6 15.017 L 63.4 9.817 C 63.4 9.517 63.7 9.317 64 9.317 L 64.5 9.317 C 65.9 9.317 67.2 9.317 67.9 10.117 C 68.4 10.517 68.5 11.217 68.4 12.217 Z"></path>
                            <path fill="#009cde" d="M 90.7 12.117 L 87 12.117 C 86.7 12.117 86.4 12.317 86.4 12.617 L 86.2 13.617 L 85.9 13.217 C 85.1 12.017 83.3 11.617 81.5 11.617 C 77.4 11.617 73.9 14.717 73.2 19.117 C 72.8 21.317 73.3 23.417 74.6 24.817 C 75.7 26.117 77.4 26.717 79.3 26.717 C 82.6 26.717 84.5 24.617 84.5 24.617 L 84.3 25.617 C 84.2 26.017 84.5 26.417 84.9 26.417 L 88.3 26.417 C 88.8 26.417 89.3 26.017 89.4 25.517 L 91.4 12.717 C 91.4 12.517 91.1 12.117 90.7 12.117 Z M 85.5 19.317 C 85.1 21.417 83.5 22.917 81.3 22.917 C 80.2 22.917 79.4 22.617 78.8 21.917 C 78.2 21.217 78 20.317 78.2 19.317 C 78.5 17.217 80.3 15.717 82.4 15.717 C 83.5 15.717 84.3 16.117 84.9 16.717 C 85.5 17.417 85.7 18.317 85.5 19.317 Z"></path>
                            <path fill="#009cde" d="M 95.1 5.417 L 91.9 25.717 C 91.8 26.117 92.1 26.417 92.5 26.417 L 95.7 26.417 C 96.2 26.417 96.7 26.017 96.8 25.517 L 100 5.617 C 100.1 5.217 99.8 4.917 99.4 4.917 L 95.8 4.917 C 95.4 4.917 95.2 5.117 95.1 5.417 Z"></path>
                        </svg></button>
                </div>
                <div class="affichageInfosPaiement" id="PaiementCredit">
                    <h3><span class="VertContact">I</span>nformations <span class="VertContact">B</span>ancaires</h3>
                    <div class="infoCred">
                        <input type="text" name="numCredit" placeholder="Numéro de carte" value="<?= $numCredit ?>">
                        <?php
                        if (isset($erreurs['numCredit'])){
                            echo $erreurs['numCredit'];
                        }
                        ?>
                    </div>
                    <div class="infoCred">
                        <input type="month" name="dateCredit" placeholder="Date d'expiration" value="<?= $dateCredit ?>">
                        <?php
                        if (isset($erreurs['dateCredit'])){
                            echo $erreurs['dateCredit'];
                        }
                        ?>
                    </div>
                    <div class="infoCred">
                        <input type="text" name="tituCredit" placeholder="Nom de la carte" value="<?= $titulaireCredit ?>">
                        <?php
                        if (isset($erreurs['tituCredit'])){
                            echo $erreurs['tituCredit'];
                        }
                        ?>
                    </div>
                    <div class="infoCred">
                        <input type="text" name="cryptoCredit" placeholder="Cryptogramme" value="<?= $cryptoCredit ?>">
                        <?php
                        if (isset($erreurs['cryptoCredit'])){
                            echo $erreurs['cryptoCredit'];
                        }
                        ?>
                    </div>



                </div>
                <div class="affichageInfosPaiement" id="PaiementCadeau">


                    <script>
                        choixPaiement();
                        function carteValide() {
                            var codeCarte = document.getElementById("noCadeau").value,
                                listeCode = new Array(<?= $chaine ?>),
                                para = document.getElementById('cadeauValide'),
                                buttonCadeau = document.getElementById('boutonCadeau');
                            if (codeCarte === "") {
                                para.className = "invisible";
                                buttonCadeau.className = 'boutonCadeauInvisible';
                            } else {
                                if (listeCode.includes(codeCarte)) {
                                    para.className = 'valide';
                                    para.innerHTML = '<i class="fa-solid fa-check"></i>';
                                    buttonCadeau.className = 'boutonCadeauVisible';
                                } else {
                                    para.className = 'invalide';
                                    para.innerHTML = '<i class="fa-solid fa-xmark"></i>';
                                    buttonCadeau.className = 'boutonCadeauInvisible';
                                }
                            }
                        }
                    </script>

                        <label for="noCadeau"> <i class="fa-solid fa-gift"></i> </label>
                        <input onchange="carteValide()" value="<?= $codeCarte ?>" type="text" placeholder="N° de la carte" name="noCadeau" id="noCadeau">
                        <p id="cadeauValide" class="invisible"></p>
                        <button type="submit" name="boutonCadeau" class="boutonCadeauInvisible" id="boutonCadeau" value="1">Voir le solde</button>

                </div>
                <div class="affichageInfosPaiement" id="PaiementApplePay">
                    <button>Payer via <i class="fab fa-apple-pay"></i></button>
                </div>
            </div>

            <div class="centerButton">
                <button type="submit" id="validationPanier" name="validerPanier" value="1">Valider votre panier</button>
            </div>
        </form>
    </div>
    <script>carteValide()</script>
    <?php
    include "fichierCommuns/footer.php";
    ?>
</div>



</body>
</html>


