<?php
include_once "BDD/requetes.php";

$liste = getAllPointsRelais();
print_r($liste[0]);

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
    <title>Test</title>
</head>
<body>
<div class="container">
    <?php
    include "fichierCommuns/header.php";
    ?>

    <div class="test">
        <script src="fichierCommuns/affichageDivLieuChoisi.js"></script>
        <form action="" id="testForm">
            <select name="selectliv">
                <?php
                foreach ($liste as $emplacement){
                ?>

                    <option value="<?= $emplacement['idPtLiv'] ?>"><?= $emplacement['nomPtLiv'] ?></option>

                <?php
                }
                ?>
            </select>

            <?php
            foreach ($liste as $emplacement){
                ?>

                <div class="affichageInfosLiv" id=<?= "Emplacement".$emplacement['idPtLiv'] ?>>
                    <p><?= $emplacement['nomPtLiv'] ?></p>
                </div>

                <?php
            }
            ?>
        </form>
    </div>

    <?php
    include "fichierCommuns/footer.php";
    ?>
</div>
</body>
</html>
