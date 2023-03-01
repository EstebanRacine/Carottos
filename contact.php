<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Contact</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
<div class="container">
    <?php
    include "fichierCommuns/header.php";
    ?>

    <div class="contact">

        <div class="directContact">
            <h1><span class="VertContact">B</span>esoin de conseils ?</h1>
            <h2><span class="VertContact">C</span>ontactez nous aux :</h2>
            <div class="liensContact">
                <a href="tel:+33368701596"><i class="fa-solid fa-phone"></i> 03 68 70 15 96 </a>
                <a href="mailto:contact@carottos.fr"><i class="fa-solid fa-envelope"></i> contact@carottos.fr </a>
                <a href="mailto:job@carottos.fr"><i class="fa-solid fa-briefcase"></i> job@carottos.fr </a>
            </div>
        </div>


        <div class="mapsContact">
            <h2><span class="VertContact">U</span>n café ? <span class="VertContact">D</span>écouvrez nos locaux !</h2>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d16907.172124557423!2d0.32874647332525164!3d46.61221278078846!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47fdbdb9781eeb55%3A0xa4356aa37458ff00!2s15%20Rue%20des%20Entrepreneurs%2C%2086000%20Poitiers!5e0!3m2!1sfr!2sfr!4v1677657527444!5m2!1sfr!2sfr" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            <p><span class="VertContact">1</span>5 rue des Entrepreneurs 86000 Poitiers</p>
        </div>

        <div class="reseauxContact">
            <h2><span class="VertContact">C</span>arottos vous retrouve sur vos sites favoris</h2>
            <div class="ordonnerReseauxContact">
                <a href="https://fr-fr.facebook.com/" target="_blank"><i class="fa-brands fa-facebook-f"></i>Facebook</a>
                <a href="https://www.instagram.com/" target="_blank"><i class="fa-brands fa-instagram"></i>Instagram</a>
                <a href="https://www.linkedin.com/feed/" target="_blank"><i class="fa-brands fa-linkedin-in"></i>LinkedIn</a>
            </div>
        </div>


    </div>
    <?php
    include "fichierCommuns/footer.php";
    ?>

</div>
</body>
</html>