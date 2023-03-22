<?php

function PrixFonctionPoids($prixKg, $quantite){
    return $prixKg*$quantite;
}

function dateLivraison($joursAvantLiv){
    $timestampAjoute = $joursAvantLiv*86400;
    $timestampLivraison = $timestampAjoute+time();
    $date =  date("d m Y", $timestampLivraison);
    $mois = substr($date, 3, 2);
    $mois = ecritureMois($mois);
    $date = substr($date, 0, 3).$mois.substr($date, 5);
    return $date;
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

function ecritureMois($mois){
    if ($mois == '01'){
        return "Janvier";
    }elseif ($mois == '02'){
        return "Février";
    }elseif ($mois == '03'){
        return "Mars";
    }elseif ($mois == '04'){
        return "Avril";
    }elseif ($mois == '05'){
        return "Mai";
    }elseif ($mois == '06'){
        return "Juin";
    }elseif ($mois == '07'){
        return "Juillet";
    }elseif ($mois == '08'){
        return "Août";
    }elseif ($mois == '09'){
        return "Septembre";
    }elseif ($mois == '10'){
        return "Octobre";
    }elseif ($mois == '11'){
        return "Novembre";
    }elseif ($mois == '12'){
        return "Décembre";
    }
}