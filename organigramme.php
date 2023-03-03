<?php
$id = 0;

$salaries = [
        1 => ['prenom'=> "Oscar", "nom" =>"Rotte", "poste"=> "Dirigeant", "Description" =>"Oscar est l’employé ayant le plus d’expérience et c’est ce qui l’a poussé à en devenir le dirigeant à la suite de son père. Toute l’entreprise est familiale et bien qu’il soit censé rester dans un bureau à prendre les décisions marketing et à entendre les comptes rendus des employés, il n’est pas rare de le voir travailler dans les champs lors des récoltes.", "salaire" => 2900,
            "activités" => [["nom" => "Recevoir les clients", "pourcent"=>30], ["nom" => "Assurer la rentabilité", "pourcent"=>20], ["nom" => "Gestion des employés", "pourcent"=>20], ["nom" => "Vente de produits", "pourcent"=>10], ["nom" => "Verification de la qualité", "pourcent"=>10], ["nom" => "Aider dans les cultures", "pourcent"=>10]]],
        2 => ['prenom'=> "Rebecca", "nom" =>"Rotte", "poste"=> "Agriculteur", "Description" =>"Les agriculteurs de la compagnie Carottos sont les acteurs les plus importants de la société. Sans eux il n’y a pas de produits à distribuer. Ils s’occupent de tout ce qui est en rapport direct à la terre et à la pousse de nos légumes. Ils sèment, arrosent et récoltent.", "salaire" => 2300,
            "activités" => [["nom" => "Production des produits (arroser, dépôt d’engrais, etc.)", "pourcent"=>50], ["nom" => "Récolter les produits après production", "pourcent"=>20], ["nom" => "Aller vendre les produits", "pourcent"=>20], ["nom" => "Gérer les intérimaires en période estivale", "pourcent"=>10]]],
        3 => ['prenom'=> "Lucas", "nom" =>"Rotte", "poste"=> "Agriculteur", "Description" =>"Les agriculteurs de la compagnie Carottos sont les acteurs les plus importants de la société. Sans eux il n’y a pas de produits à distribuer. Ils s’occupent de tout ce qui est en rapport direct à la terre et à la pousse de nos légumes. Ils sèment, arrosent et récoltent.", "salaire" => 2300,
        "activités" => [["nom" => "Production des produits (arroser, dépôt d’engrais, etc.)", "pourcent"=>50], ["nom" => "Récolter les produits après production", "pourcent"=>20], ["nom" => "Aller vendre les produits", "pourcent"=>20], ["nom" => "Gérer les intérimaires en période estivale", "pourcent"=>10]]],
        4 => ['prenom'=> "Veronica", "nom" =>"Rotte", "poste"=> "Secrétaire", "Description" =>"Ce poste représente tout le coté administratif de la société. La secrétaire va servir de point de contact entre les clients et l’entreprise. Elle s’occupe de tout ce qui est réception de demande (mail, appel téléphonique, etc…). Elle gère également les agendas des employés, prépare les réunions, organise les dossiers et rédige les comptes rendus.", "salaire" => 2500,
        "activités" => [["nom" => "Gérer les contacts avec l'extérieur (fournisseurs, clients, etc)", "pourcent"=>30], ["nom" => "Organisation logistique", "pourcent"=>30], ["nom" => "Organisation et classement des dossiers", "pourcent"=>25], ["nom" => "Organiser les emplois du temps", "pourcent"=>5], ["nom" => "Rédaction des comptes rendus", "pourcent"=>5], ["nom" => "Préparer les réunions", "pourcent"=>5]]],
        5 => ['prenom'=> "Clément", "nom" =>"Darine", "poste"=> "Stagiaire en secrétariat", "Description" =>"Ce stagiaire vient d’une formation en secrétariat et doit faire un stage de 3 mois en entreprise pour valider son année. Il nous a donc tout naturellement rejoints afin de se professionnaliser.", "salaire" => 600,
        "activités" => [["nom" => "Organiser les dossiers", "pourcent"=>55], ["nom" => "Contact avec l’extérieur (fournisseurs, clients, etc…) aidée par sa supérieure", "pourcent"=>25], ["nom" => "Gestion des emplois du temps", "pourcent"=>15], ["nom" => "Faire le café", "pourcent"=>5]]],
        6 => ['prenom'=> "Jessica", "nom" =>"Rotte", "poste"=> "Chargée de communication", "Description" =>"Ce poste sert à tout ce qui se rapproche de l’image de la marque. La chargée de communication doit servir de porte parole vers l’extérieur, c’est donc elle qui va s’occuper de tout ce qui touche à la publicité, aux événements et aux réseaux sociaux.", "salaire" => 2500,
        "activités" => [["nom" => "Gestion des réseaux sociaux", "pourcent"=>45], ["nom" => "Gestion de la publicité", "pourcent"=>25], ["nom" => "Négociation avec les prestataires imprimeurs, prestataires informatiques, etc…)", "pourcent"=>10], ["nom" => "Maitrise de logiciels graphiques", "pourcent"=>10], ["nom" => "Rédaction de communiqués publics", "pourcent"=>5], ["nom" => "Création d'événements", "pourcent"=>5]]]

];

$clients = ["Ménages divers", "Le Restoitiers", "La PaMakDau", "Aux Vrais Produits", "Tous les établissement scolaires de Poitiers (maternelles, primaires, collèges, lycées, Crous)", "Tous mes établissement médicaux de Poitiers (hôpitals, maternités, etc...)"];
$collaborateurs = ["SCEP (Société Castelroussine d'Elevage de Pintade)", "Bayer", "Picard"];


if(isset($_GET['id'])){
    $id = $_GET['id'];
}
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Organigramme</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
<div class="container">
    <?php
    include "fichierCommuns/header.php";
    ?>
    <div class="orga">
        <div class="listeSala">
            <h3>Liste des Salariés</h3>
            <?php
            foreach ($salaries as $cle=>$salarie){
                echo "<a href='organigramme.php?id =".$cle."'>".$salarie['prenom']." ".$salarie['nom']."</a>";
            }
            ?>
        </div>
        <div class="contentSala">

        </div>
    </div>




    <?php
    include "fichierCommuns/footer.php";
    ?>
</div>
</body>
</html>