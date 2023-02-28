<?php

function PrixFonctionPoids($prixKg, $quantite){
    return $prixKg*$quantite;
}

function dateLivraison($joursAvantLiv){
    $timestampAjoute = $joursAvantLiv*86400;
    $timestampLivraison = $timestampAjoute+time();
    return date("d M Y", $timestampLivraison);
}
