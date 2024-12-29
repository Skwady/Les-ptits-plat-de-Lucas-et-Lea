<?php
$link = "main";
$title = "Accueil";
?>
<div class="background-custom">

</div>
    <div class="text-center py-5">
        <img class="img-fluid img" src="/assets/img/logo.png" alt="Logo">
    </div>

    <div class="container bg-gradiant text-center p-5 tw foreground">
        <h3 class="pt-3 pb-3">
            Bienvenue chez nous, où préparer de bons plats devient un jeu d’enfant et une aventure familiale !
        </h3>
        <div>
            <h5 id="description">
                Nous sommes Lucas et Léa, frère et sœur, âgés respectivement de 7 et 3 ans, et déjà passionnés par la cuisine, une aventure que nous partageons en famille. 
                <span id="dots1">...</span>
                <span id="more1">
                    <br><br>
                    Notre amour pour les petits plats savoureux et réconfortants vient de notre maman, qui nous initie chaque jour à son univers culinaire. Elle nous laisse mélanger, goûter, sentir, et découvrir la joie de mettre les mains à la pâte. Grâce à elle, cuisiner est devenu pour nous un jeu et une découverte.
                    <br><br>
                    Les dimanches après-midi sont des moments privilégiés où la cuisine se transforme en terrain d'exploration. Que ce soit en préparant des gâteaux moelleux pour l’heure du goûter ou des plats mijotés pour les repas en famille, chaque recette est une nouvelle occasion de créer des souvenirs inoubliables.
                    <br><br>
                    Aujourd’hui, nous avons décidé de partager cette passion à travers ce blog. Avec l’aide précieuse de notre maman, qui veille dans l’ombre au bon fonctionnement du site, nous vous proposons nos recettes préférées, celles qui remplissent notre maison de délicieuses odeurs et de bonne humeur.
                    <br><br>
                    Mais ce n'est pas tout ! Nous souhaitons aussi vous offrir de nombreux conseils et astuces pour cuisiner facilement, même si vous débutez. Notre mission est de rendre la cuisine amusante et accessible à tous, sans jamais sacrifier le plaisir des saveurs et du partage.
                    <br><br>
                    Lucas, curieux et créatif, adore expérimenter avec des plats salés et revisiter les classiques de notre enfance. Léa, quant à elle, est notre apprentie pâtissière, toujours prête à aider et à goûter les nouvelles créations sucrées. Ensemble, nous formons une petite équipe dynamique et complémentaire, prête à vous embarquer dans notre aventure culinaire.
                    <br><br>
                    Sur notre blog, vous trouverez des recettes simples et gourmandes pour toutes les occasions : des plats rapides pour les soirs de semaine, des douceurs pour le goûter, et même des recettes festives pour les grandes occasions. Nous vous accompagnerons pas à pas avec des conseils pratiques et des astuces pour réussir vos plats.
                    <br><br>
                    Et ce n’est pas tout : chaque recette est interactive ! Vous pouvez laisser un commentaire pour partager votre avis, vos idées ou vos variantes, ou simplement nous dire combien vous avez apprécié une recette. Nous espérons que cet espace deviendra un lieu d’échange chaleureux où chacun pourra enrichir et s’inspirer.
                    <br><br>
                    Que vous soyez un cuisinier débutant ou aguerri, notre objectif est de vous donner envie d’enfiler votre tablier et de passer un bon moment en cuisine, en famille ou entre amis.
                    <br><br>
                    Alors, sortez vos ustensiles et venez partager cette belle aventure culinaire avec nous. Ensemble, mettons un peu de magie et de saveurs dans chaque plat. Bienvenue dans notre univers, où chaque recette est une petite histoire d’amour pour la cuisine et pour les souvenirs qu’elle crée !
                </span>
            </h5>
            <div class="d-flex justify-content-center mt-4">
                <button onclick="toggleText(this)" id="myBtn1" data-target="1" class="tw bg-gradiant mt-2">Lire la suite</button>
            </div>
        </div>
    </div>

    <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center mt-5 mb-5 perso">
        <!-- Colonne de gauche avec bulle1 en position légèrement basse -->
        <div class="d-flex flex-column align-items-center gap-3">
            <div class="bulle1"> <!-- Ajustement avec `mb-3` pour la descendre légèrement -->
                <h5 class="mt-2">"Lucas,<br>le Gourmet des Plats Salés"</h5>
            </div>
        </div>

        <!-- Colonne centrale avec l'image -->
        <div class="text-center my-3">
            <img src="assets/img/famille_1.webp" alt="" class="img-fluid">
        </div>

        <!-- Colonne de droite avec bulle2 en position légèrement haute -->
        <div class="d-flex flex-column align-items-center">
            <div class="bulle2"> <!-- Ajustement avec `mt-n3` pour la monter légèrement -->
                <h5 class="mt-4">"Léa,<br>la Fée des Desserts"</h5>
            </div>
        </div>
    </div>


<?php
$script = "buttonDeroulant";