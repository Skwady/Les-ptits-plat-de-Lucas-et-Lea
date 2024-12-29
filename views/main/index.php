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
            Bienvenue sur notre blog culinaire, où la cuisine rime avec complicité et souvenirs d'enfance !
        </h3>
        <div>
            <h5 id="description">
                Nous sommes Lucas et Léa, frère et sœur, tous deux passionnés de cuisine depuis aussi loin que nous nous souvenions! 
                <span id="dots1">...</span>
                <span id="more1">
                    <br><br>
                    Notre amour pour les petits plats savoureux et réconfortants, nous le devons à notre maman. Elle nous a initiés très jeunes, nous laissant mélanger, goûter, sentir, et découvrir le bonheur de mettre les mains à la pâte!
                    <br><br>
                    Les dimanches après-midi étaient pour nous des rituels sacrés où la cuisine devenait un terrain de jeux et d'apprentissages. Que ce soit en préparant des gâteaux moelleux pour l’heure du goûter ou des plats mijotés réconfortants pour les dîners de famille, chaque recette était une occasion de créer des souvenirs ensemble.
                    <br><br>
                    Aujourd’hui, cette passion est devenue notre aventure commune. Nous avons décidé de lancer ce blog pour partager avec vous nos recettes favorites, celles qui ont marqué notre enfance et celles que nous avons perfectionnées au fil des années.
                    <br><br>
                    Mais ce n'est pas tout ! Nous souhaitons aussi vous offrir de nombreux conseils et astuces pour cuisiner facilement, même si vous débutez. Notre mission est de rendre la cuisine accessible à tous, sans jamais sacrifier le plaisir du goût et des saveurs.
                    <br><br>
                    Lucas, avec son amour pour les plats salés, aime partager des recettes originales et modernes, tout en revisitant les classiques qui ont bercé notre enfance. Quant à Léa, elle est la pâtissière de la famille, toujours prête à essayer de nouvelles recettes sucrées, des plus simples aux plus sophistiquées. Nous formons une équipe complémentaire, prête à explorer ensemble chaque coin de la cuisine, et nous espérons que vous nous accompagnerez dans cette aventure.
                    <br><br>
                    Sur notre blog, vous trouverez des recettes gourmandes pour toutes les occasions, des plats express pour les soirs de semaine aux repas festifs pour impressionner vos proches. Nous vous guiderons pas à pas, avec des conseils pratiques et des astuces que nous avons accumulés avec les années. Et ce n'est pas tout : chaque recette est interactive ! Vous pouvez laisser un commentaire pour partager votre avis après avoir testé un plat, proposer des astuces ou des variantes qui fonctionnent pour vous, ou simplement dire combien vous avez apprécié la recette. Nous voulons que cet espace devienne un lieu d'échange et d’entraide, où chaque plat peut évoluer et s’enrichir grâce à vos idées et expériences.
                    <br><br>
                    Que vous soyez un chef débutant ou un cuisinier aguerri, notre objectif est de vous donner envie d'enfiler votre tablier et de passer un bon moment dans votre cuisine !
                    <br><br>
                    Alors, préparez vos ustensiles et venez partager cette aventure culinaire avec nous. Ensemble, mettons un peu de chaleur et de saveurs dans chaque plat. Bienvenue dans notre univers, où chaque recette est un clin d’œil à notre histoire et à l’amour que nous portons à la cuisine !
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