<?php


function encoder(string $mdp):string{
    $sel = "CarottosSelTest";
    return md5($mdp.$sel);
}

