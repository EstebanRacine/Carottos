<?php

include "connexionDB.php";

function getAllProduits(){
    $connexion = createConnexion();
    $requete = $connexion -> prepare("SELECT * FROM produits");
    $requete -> execute();
    return $requete->fetchAll(PDO::FETCH_ASSOC);
}


function AjoutVente($id):void{
    $connexion = createConnexion();
    $requete = $connexion->prepare("UPDATE produits SET nbVentes = nbVentes+1 WHERE id = :id");
    $requete->bindValue('id', $id);
    $requete->execute();
}


function getAvisById($id):array{
    $connexion = createConnexion();
    $requete = $connexion->prepare("SELECT * FROM avis WHERE idProduit = :id");
    $requete -> bindValue('id', $id);
    $requete -> execute();
    return $requete->fetchAll(PDO::FETCH_ASSOC);
}

function getProduitById($id):array{
    $connexion = createConnexion();
    $requete = $connexion->prepare("SELECT * FROM produits WHERE id = :id");
    $requete -> bindValue('id', $id);
    $requete -> execute();
    return $requete->fetch(PDO::FETCH_ASSOC);
}