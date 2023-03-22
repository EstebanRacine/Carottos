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


function changeQteStock($id, $qte, $signe){
    $connexion = createConnexion();
    if ($signe == '-') {
        $requete = $connexion->prepare("UPDATE produits SET QteStock =QteStock-:qte WHERE id = :id");
    }else{
        $requete = $connexion->prepare("UPDATE produits SET QteStock =QteStock+:qte WHERE id = :id");
    }
    $requete->bindParam('qte', $qte);
    $requete->bindParam('id', $id);
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
    $requeteSQL = "INSERT INTO users(login, password, nomUser, prenomUser, dateNaissance, villeUser, mailUser) VALUES (:login, :password, :nom, :prenom, :dateNaissance, :ville, :mail)";
    $requete = $connexion-> prepare($requeteSQL);
    $password = password_hash($password, PASSWORD_DEFAULT);
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

function verifConnection($login, $password){
    $login = trim($login);
    if(verifLogin($login)=="0"){
        $connexion = createConnexion();
        $requete = $connexion->prepare("SELECT password FROM users WHERE login = :login");
        $requete->bindParam('login', $login);
        $requete->execute();
        $passwordBDD = $requete->fetch(PDO::FETCH_COLUMN);
        return password_verify($password, $passwordBDD);
    }
    return false;
}

function getUserByLogin($login){
    $connexion = createConnexion();
    $requete = $connexion -> prepare("SELECT * FROM users where login = :login");
    $requete -> bindParam('login', $login);
    $requete->execute();
    return $requete->fetch(PDO::FETCH_ASSOC);
}

