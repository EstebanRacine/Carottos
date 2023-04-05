<?php

include "connexionDB.php";

//PRODUITS


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

//AVIS

function getAvisById($id):array{
    $connexion = createConnexion();
    $requete = $connexion->prepare("SELECT * FROM avis WHERE idProduit = :id");
    $requete -> bindValue('id', $id);
    $requete -> execute();
    return $requete->fetchAll(PDO::FETCH_ASSOC);
}


//USERS

function addUser($nom, $prenom, $mail, $login, $password, $dateNaissance, $ville):bool{
    $connexion = createConnexion();
    $requeteSQL = "INSERT INTO users(login, password, nomUser, prenomUser, dateNaissance, villeUser, mailUser) VALUES (:login, :password, :nom, :prenom, :dateNaissance, :ville, :mail)";
    $requete = $connexion-> prepare($requeteSQL);
    $password = password_hash($password, PASSWORD_DEFAULT);
    $requete->bindValue("login", $login);
    $requete->bindValue("password", $password);
    $requete->bindValue("nom", ucfirst($nom));
    $requete->bindValue("prenom", ucfirst($prenom));
    $requete->bindValue("dateNaissance", $dateNaissance);
    $requete->bindValue("ville", $ville);
    $requete->bindValue("mail", $mail);
    return $requete->execute();
}

function getUserByLogin($login){
    $connexion = createConnexion();
    $requete = $connexion -> prepare("SELECT * FROM users where login = :login");
    $requete -> bindParam('login', $login);
    $requete->execute();
    return $requete->fetch(PDO::FETCH_ASSOC);
}

function changeUser($id, $nom, $prenom, $birth, $ville, $mail){
    $connexion = createConnexion();
    $requete = $connexion->prepare("UPDATE users SET nomUser = :nom, prenomUser = :prenom, dateNaissance = :birth, villeUser = :ville, mailUser = :mail WHERE idUser = :id");
    $requete->bindValue("nom", ucfirst($nom));
    $requete->bindValue("prenom", ucfirst($prenom));
    $requete->bindValue("birth", $birth);
    $requete->bindValue("ville", $ville);
    $requete->bindValue("mail", $mail);
    $requete->bindParam('id', $id);
    $requete ->execute();
}

//CONNEXION

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

//PT LIVRAISON

function getAllPointsRelais(){
    $connexion = createConnexion();
    $requete = $connexion -> prepare("SELECT * FROM ptlivraisons");
    $requete->execute();
    return $requete->fetchAll(PDO::FETCH_ASSOC);
}

//COMMANDE

function addCommande($idUser, $idLiv){
    $connexion = createConnexion();
    $requete = $connexion->prepare("INSERT INTO commande(idUser, idPtLiv) VALUES (:idUser, :idLiv)");
    $requete->bindParam('idUser', $idUser);
    $requete->bindParam('idLiv', $idLiv);
    $requete->execute();
}

function getCommandeByUserId($id){
    $connexion = createConnexion();
    $requete = $connexion->prepare("SELECT * FROM commande WHERE idUser = :idUser");
    $requete->bindParam('idUser', $id);
    $requete->execute();
    return $requete->fetchAll(PDO::FETCH_ASSOC);
}


//CONTENU COMMANDE

function getCommandeByIdCommande($idCommande){
    $connexion = createConnexion();
    $requete = $connexion->prepare("SELECT * FROM commande WHERE idCommande = :idCom");
    $requete->bindParam('idCom', $idCommande);
    $requete->execute();
    return $requete->fetch(PDO::FETCH_ASSOC);
}

function getContenuByIdCommande($id){
    $connexion = createConnexion();
    $requete = $connexion->prepare("SElECT idProduit, qteProd FROM contenu WHERE idCommande = :idCom");
    $requete->bindParam('idCom', $id);
    $requete->execute();
    return $requete->fetchAll(PDO::FETCH_ASSOC);
}

function getProduitsByCommande($idCommande){
    $connexion = createConnexion();
    $requete = $connexion->prepare("SELECT libelle, img, prix, qteProd FROM contenu INNER JOIN produits ON produits.id = contenu.idProduit WHERE idCommande = :idCommande");
    $requete->bindParam('idCommande', $idCommande);
    $requete->execute();
    return $requete->fetchAll(PDO::FETCH_ASSOC);
}

function getNbProdByCommandeId($id){
    $connexion = createConnexion();
    $requete = $connexion->prepare("SELECT COUNT(*) FROM contenu WHERE idCommande = :id");
    $requete->bindParam('id', $id);
    $requete->execute();
    return $requete->fetch();
}

function getPrixTotalCommande($id){
    $connexion = createConnexion();
    $requete = $connexion->prepare("SELECT SUM(prix*qteProd) as Total FROM contenu INNER JOIN produits ON produits.id = contenu.idProduit WHERE idCommande = :id");
    $requete->bindParam('id', $id);
    $requete->execute();
    $array =  $requete->fetch(PDO::FETCH_ASSOC);
    return number_format($array['Total'], 2);
}


//CARTE CADEAU

function getAllCodeCarteCadeau(){
    $connexion = createConnexion();
    $requete = $connexion->prepare('SELECT codeCarteCad FROM cartecadeau');
    $requete->execute();
    return $requete->fetchAll(PDO::FETCH_COLUMN);
}

function getPrixByCodeCarteCadeau($code){
    $connexion = createConnexion();
    $requete = $connexion->prepare('SELECT valeurcarteCad FROM cartecadeau WHERE codeCarteCad = :code');
    $requete->bindParam('code', $code);
    $requete->execute();
    return $requete->fetch(PDO::FETCH_COLUMN);
}

//CODE PROMO

function getAllCodePromo(){
    $connexion = createConnexion();
    $requete = $connexion->prepare('SELECT codePromo FROM codepromo');
    $requete->execute();
    return $requete->fetchAll(PDO::FETCH_COLUMN);
}

function getRemiseByCode($code){
    $connexion = createConnexion();
    $requete = $connexion->prepare('SELECT remisePromo FROM codepromo WHERE codePromo = :code');
    $requete->bindParam('code', $code);
    $requete->execute();
    return $requete->fetch(PDO::FETCH_COLUMN);
}