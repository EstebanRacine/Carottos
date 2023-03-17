<?php

function PrixFonctionPoids($prixKg, $quantite){
    return $prixKg*$quantite;
}

function dateLivraison($joursAvantLiv){
    $timestampAjoute = $joursAvantLiv*86400;
    $timestampLivraison = $timestampAjoute+time();
    return date("d M Y", $timestampLivraison);
}

function testMdp(string $mdp):string{
    if (strlen($mdp)>=8) {
        $min = False;
        $maj = false;
        $number = false;
        for ($i=0; $i<strlen($mdp); $i++){
            $lettre = $mdp[$i];
            if ($lettre>= "a" && $lettre<="z"){
                $min = true;
            }elseif ($lettre>="A" && $lettre <= "Z"){
                $maj = true;
            }elseif ($lettre >= "0" && $lettre<="9"){
                $number = true;
            }
            else{
                return "Un caractère n'est pas valable, seul les minuscules, majuscules et chiffres sont acceptés";
            }
        }
        if ($maj && $min && $number){
            return True;
        }else{
            return "Il faut au minimum une majuscule, une minuscule et un chiffre";
        }
    }
    return "Le mot de passe est trop court";

}



function verifMdp(){

}