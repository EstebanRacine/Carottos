<?php

include "connexionDB.php";

function getAllProduits(){
    $connexion = createConnexion();
    $requete = $connexion -> prepare("SELECT * FROM produits");
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


function AjoutVente($id, $quantite):void{
    $connexion = createConnexion();
    $requete = $connexion->prepare("UPDATE produits SET nbVentes = nbVentes+ :quantite WHERE id = :id");
    $requete->bindValue('id', $id);
    $requete->bindValue('quantite', $quantite);
    $requete->execute();
}


function getAvisById($id):array{
    $connexion = createConnexion();
    $requete = $connexion->prepare("SELECT * FROM avis WHERE idProduit = :id");
    $requete -> bindValue('id', $id);
    $requete -> execute();
    return $requete->fetchAll(PDO::FETCH_ASSOC);
}

function addUser($nom, $prenom, $mail, $login, $password, $dateNaissance, $ville):bool{
    $connexion = createConnexion();
    $sel = "CarottosSel";
    $requeteSQL = "INSERT INTO users(login, password, nomUser, prenomUser, dateNaissance, villeUser, mailUser) VALUES (:login, :password, :nom, :prenom, :dateNaissance, :ville, :mail)";
    $requete = $connexion-> prepare($requeteSQL);
    $password = md5($password.$sel);
    $requete->bindValue("login", $login);
    $requete->bindValue("password", $password);
    $requete->bindValue("nom", $nom);
    $requete->bindValue("prenom", $prenom);
    $requete->bindValue("dateNaissance", $dateNaissance);
    $requete->bindValue("ville", $ville);
    $requete->bindValue("mail", $mail);
    return $requete->execute();
}

function verifLogin($login){
    $login = trim($login);
    $connexion =createConnexion();
    $requete = $connexion->prepare("SELECT login FROM users");
    $requete->execute();
    $logins = $requete->fetchAll(PDO::FETCH_ASSOC);
    foreach ($logins as $log){
        if ($log['login']==$login){
            return False;
        }
    }
    return True;
}
