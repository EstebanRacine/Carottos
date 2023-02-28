<?php

include "connexionDB.php";

function getAllProduits(){
    $connexion = createConnection();
    $requete = $connexion -> prepare("SELECT * FROM produits");
    $requete = $requete -> execute();
    return $requete -> fetchAll(PDO::FETCH_ASSOC);

}


function AjoutVente($id):void{
    $connexion = createConnection();
    $requete = $connexion->prepare("UPDATE produits SET nbVentes = nbVentes+1 WHERE id = :id");
    $requete->bindValue('id', $id);
    $requete->execute();
}