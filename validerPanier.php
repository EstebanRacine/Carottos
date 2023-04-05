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

if (!$_SESSION['isCo']){
    header('Location: connexion.php?validerPanier=1');
}else{
    $_SESSION['prixTotal'] = $_POST['prixTotal'];
    if (isset($_SESSION['remise'])){
        unset($_SESSION['remise']);
    }
    header('Location: pageValiderPanier.php');
}


?>
