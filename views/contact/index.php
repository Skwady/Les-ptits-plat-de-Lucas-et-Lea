<?php
$link = "contact";
$title = "Contact";
?>

<!-- Section de contact pour Lucas -->
<section class="contact-section py-5">
    <div class="container">
        <h2>Contactez-nous !</h2>
        <p class="text-center">Vous avez des questions sur nos recettes ou besoin de conseils en cuisine ? Lucas est là pour vous aider ! Que ce soit pour des astuces sur les plats déjà présents sur le blog ou pour vous inspirer avec une nouvelle recette, n'hésitez pas à remplir le formulaire de contact.</p>
        
        <div class="row mt-5 contact-form align-items-center">
            <div class="col-lg-4 col-md-6 col-sm-12 text-center mb-4 mb-md-0">
                <img src="/assets/img/lucas.png" alt="Photo de Lucas" class="img-fluid rounded" style="max-width: 100%; height: auto;">
            </div>
            <div class="col-lg-8 col-md-6 col-sm-12 lui">
                <form class="w-100">
                    <div class="mb-3">
                        <label class="form-label">Nom</label>
                        <input type="text" class="form-control" name="nom">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Objet</label>
                        <input type="text" class="form-control" name="objet">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Message</label>
                        <textarea class="form-control" name="message" rows="4"></textarea>
                    </div>
                    <button type="submit" class="btn w-100">Envoyer</button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Section de contact pour Léa -->
<section class="contact-section2 py-5">
    <div class="container">
        <h2>Contactez Léa</h2>
        <p class="text-center">Si la pâtisserie est plutôt votre domaine de prédilection, Léa se fera un plaisir de vous conseiller. Que vous souhaitiez améliorer une de vos recettes sucrées ou en découvrir de nouvelles, elle est à votre écoute !</p>

        <div class="row mt-5 contact-form align-items-center">
            <div class="col-lg-4 col-md-6 col-sm-12 text-center mb-4 mb-md-0">
                <img src="/assets/img/lea.png" alt="Photo de Léa" class="img-fluid rounded" style="max-width: 100%; height: auto;">
            </div>
            <div class="col-lg-8 col-md-6 col-sm-12 elle">
                <form class="w-100">
                    <div class="mb-3">
                        <label class="form-label">Nom</label>
                        <input type="text" class="form-control" name="nom">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Objet</label>
                        <input type="text" class="form-control" name="objet">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Message</label>
                        <textarea class="form-control" name="message" rows="4"></textarea>
                    </div>
                    <button type="submit" class="btn w-100">Envoyer</button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Section Join -->
<section class="join-section py-5">
    <div class="container text-center">
        <h2>Rejoignez l'aventure culinaire en live avec Lucas et Léa !</h2>
        <p class="text px-3">Envie de passer un dimanche après-midi convivial, gourmand et plein de bonne humeur ? Rendez-vous sur notre chaîne Twitch "Les P'tits plats de Lucas et Léa" ! Chaque semaine, nous vous proposons un live pour partager avec vous le plaisir de cuisiner.</p>
        <p class="text px-3">Et pour ceux qui veulent aller plus loin, une surprise vous attend ! Vous pouvez faire une demande pour participer en direct et venir cuisiner à nos côtés, directement dans notre cuisine.</p>
    </div>
</section>

<!-- Section des témoignages -->
<section class="testimonials-section py-5">
    <div class="container text-center">
        <h3>Ils l'ont fait, alors n'hésitez plus : Rejoignez-nous !</h3>
        <div class="row justify-content-center">
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <img src="/assets/img/user1.png" alt="Invité 1" class="img-fluid testimonials img-thumbnail mx-auto">
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <img src="/assets/img/user2.png" alt="Invité 2" class="img-fluid testimonials img-thumbnail mx-auto">
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <img src="/assets/img/user3.png" alt="Invité 3" class="img-fluid testimonials img-thumbnail mx-auto">
            </div>
        </div>
    </div>
</section>

<!-- Section d'inscription -->
<section class="subscription-section py-5">
    <div class="container text-center">
        <h2>Inscription à l'Atelier Cuisine du Dimanche</h2>
        <form class="subscription-form mx-auto mt-4 px-3" style="max-width: 700px;">
            <div class="mb-3">
                <label class="form-label">Nom</label>
                <input type="text" class="form-control" name="nom">
            </div>
            <div class="mb-3">
                <label class="form-label">Prénom</label>
                <input type="text" class="form-control" name="prenom">
            </div>
            <div class="mb-3">
                <label class="form-label">Âge</label>
                <input type="number" class="form-control" name="age">
            </div>
            <div class="mb-3">
                <label class="form-label">Sexe</label>
                <input type="text" class="form-control" name="sexe">
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email">
            </div>
            <button type="submit" class="btn w-100">S'inscrire</button>
        </form>
    </div>
</section>