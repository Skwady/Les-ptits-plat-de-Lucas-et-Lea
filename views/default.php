<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Les petits plats présenter par Lucas et Léa">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/default.css">
    <link href="https://fonts.googleapis.com/css2?family=Macondo&display=swap" rel="stylesheet">
    <?php if (isset($link)): ?>
        <link rel="stylesheet" href="/assets/css/<?= $link ?>.css"><?php endif; ?>
    <?php if (isset($links)): ?>
        <link rel="stylesheet" href="/assets/css/<?= $links ?>.css"><?php endif; ?>
    <title><?php if (isset($title)) {
                echo $title;
            } ?></title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-gradiant">
        <div class="container-fluid">
            <a class="navbar-brand logo d-block" href="/"><img src="/assets/img/logoNav.png" alt="LOGO"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto nav-space-around d-flex justify-content-around">
                    <!-- Entrées -->
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" id="entreesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <h4>Entrées</h4>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="entreesDropdown">
                            <li><a class="dropdown-item" href="/recipes/listRecipes/1">Entrées froides</a></li>
                            <li><a class="dropdown-item" href="/recipes/listRecipes/2">Entrées chaudes</a></li>
                            <li><a class="dropdown-item" href="/recipes/listRecipes/3">Tapas et<br> amuses bouches</a></li>
                            <li><a class="dropdown-item" href="/recipes/listRecipes/4">Les verrines</a></li>
                            <li><a class="dropdown-item" href="/recipes/listRecipes/5">Les soupes</a></li>
                            <li><a class="dropdown-item" href="/recipes/listRecipes/6">Les entrées festives</a></li>
                        </ul>
                    </li>
                    <!-- Plats -->
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" id="platsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <h4>Plats</h4>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="platsDropdown">
                            <li><a class="dropdown-item" href="/recipes/listRecipes/7">Les p’tits plats<br> de nos<br> grands-mères</a></li>
                            <li><a class="dropdown-item" href="/recipes/listRecipes/8">Cuisine du monde</a></li>
                            <li><a class="dropdown-item" href="/recipes/listRecipes/9">Poissons et<br> fruits de mer</a></li>
                            <li><a class="dropdown-item" href="/recipes/listRecipes/10">Spécialitées<br> végétariennes</a></li>
                            <li><a class="dropdown-item" href="/recipes/listRecipes/11">Les abats</a></li>
                            <li><a class="dropdown-item" href="/recipes/listRecipes/12">Riz et pâtes</a></li>
                            <li><a class="dropdown-item" href="/recipes/listRecipes/13">Les plats festifs</a></li>
                        </ul>
                    </li>
                    <!-- Desserts -->
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" id="dessertsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <h4>Desserts</h4>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dessertsDropdown">
                            <li><a class="dropdown-item" href="/recipes/listRecipes/14">Les desserts<br> d’antan</a></li>
                            <li><a class="dropdown-item" href="/recipes/listRecipes/15">Les classiques</a></li>
                            <li><a class="dropdown-item" href="/recipes/listRecipes/16">Gâteaux et cakes</a></li>
                            <li><a class="dropdown-item" href="/recipes/listRecipes/17">Tartes et tartelettes</a></li>
                            <li><a class="dropdown-item" href="/recipes/listRecipes/18">P’tits biscuits</a></li>
                            <li><a class="dropdown-item" href="/recipes/listRecipes/19">Les desserts festifs</a></li>
                        </ul>
                    </li>
                    <!-- Accompagnements -->
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" id="accompagnementsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <h4>Accompagnements</h4>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="accompagnementsDropdown">
                            <li><a class="dropdown-item" href="/recipes/listRecipes/20">Les gratins</a></li>
                            <li><a class="dropdown-item" href="/recipes/listRecipes/21">Les légumes</a></li>
                            <li><a class="dropdown-item" href="/recipes/listRecipes/22">Les sauces</a></li>
                            <li><a class="dropdown-item" href="/recipes/listRecipes/23">Les pommes de terre</a></li>
                            <li><a class="dropdown-item" href="/recipes/listRecipes/24">Polenta et semoule</a></li>
                            <li><a class="dropdown-item" href="/recipes/listRecipes/25">Les purées</a></li>
                            <li><a class="dropdown-item" href="/recipes/listRecipes/26">Accompagnements festifs</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/conseil">
                            <h4>Conseils et astuces</h4>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/contact">
                            <h4>Contact</h4>
                        </a>
                    </li>
                    </li>
                    <?php if (isset($_SESSION['id'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/profile/viewProfile/<?= $_SESSION['id'] ?>">
                                <h4>Profil</h4>
                            </a>
                        </li>

                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/login">
                                <h4>Connexion</h4>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'Admin'): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#" id="recettesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <h4>Admin</h4>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="recettesDropdown">
                                <li><a class="dropdown-item" href="/recipes/addRecipe">Ajouter une recette</a></li>
                                <li><a class="dropdown-item" href="/listUsers">Liste des utilisateurs</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        <?= $contenu ?>
    </main>

    <footer class="mt-auto">
        <div>
            <h3 class="text-center tw">&copy Copyright</h3>
        </div>
        <!-- Lien pour ouvrir la modal -->
        <a class="tw" href="#" data-bs-toggle="modal" data-bs-target="#legalModal">Voir les CGU, Mentions légales et RGPD</a>

        <!-- Modal -->
        <div class="modal fade" id="legalModal" tabindex="-1" aria-labelledby="legalModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title tb" id="legalModalLabel">Informations légales</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Navigation avec onglets -->
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="cgu-tab" data-bs-toggle="tab" data-bs-target="#cgu" type="button" role="tab" aria-controls="cgu" aria-selected="true">
                                    CGU
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="mentions-tab" data-bs-toggle="tab" data-bs-target="#mentions" type="button" role="tab" aria-controls="mentions" aria-selected="false">
                                    Mentions Légales
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="rgpd-tab" data-bs-toggle="tab" data-bs-target="#rgpd" type="button" role="tab" aria-controls="rgpd" aria-selected="false">
                                    RGPD
                                </button>
                            </li>
                        </ul>

                        <!-- Contenu des onglets -->
                        <div class="tab-content mt-3" id="myTabContent">
                            <!-- CGU -->
                            <div class="tab-pane fade show active tb" id="cgu" role="tabpanel" aria-labelledby="cgu-tab">
                                <h6 class="tb">Conditions Générales d'Utilisation</h6>
                                <p class="tb">
                                    Bienvenue sur notre site de petits plats ! En utilisant ce site, vous acceptez les conditions suivantes :
                                </p>
                                <ul>
                                    <li class="tb">Vous vous engagez à utiliser le site de manière respectueuse, sans tenter de le perturber, de l'endommager ou d'y porter préjudice (tentatives de piratage, diffusion de contenu nuisible, etc.).
                                        Les interactions entre utilisateurs doivent rester courtoises et respectueuses. Tout propos injurieux, discriminatoire ou diffamatoire est strictement interdit.</li>
                                    <li class="tb">Vous vous engagez à publier uniquement des photos, recettes et commentaires liés à la cuisine et en adéquation avec le thème du blog.
                                        Les contenus doivent être vos créations ou des contenus que vous avez le droit de partager. La publication de contenus protégés par des droits d'auteur sans autorisation est interdite.
                                        Les photos ou textes contenant des propos inappropriés, violents ou à caractère pornographique sont strictement prohibés.</li>
                                    <li class="tb">Chaque utilisateur est responsable du contenu qu’il publie. En cas de non-respect des règles, votre contenu pourra être supprimé sans préavis.
                                        En cas de violation grave ou répétée, votre compte pourra être supprimé définitivement.</li>
                                    <li class="tb">Vous êtes invité à commenter de manière constructive et bienveillante.
                                        Les attaques personnelles, spam ou toute tentative de harcèlement envers d’autres utilisateurs ne seront pas tolérées.</li>
                                    <li class="tb">Vous vous engagez à ne pas diffuser de données personnelles d’autres utilisateurs sans leur consentement.
                                        Votre compte est personnel. Le partage de vos identifiants avec des tiers est fortement déconseillé.</li>
                                    <li class="tb">Toute infraction aux règles énoncées ci-dessus pourra entraîner :
                                        La suppression du contenu en infraction.
                                        Une suspension permanente du compte.
                                        Des actions légales en cas de préjudice grave causé au site ou à d’autres utilisateurs.</li>
                                    <li class="tb">Les présentes règles sont susceptibles d’évoluer. Vous serez informé des modifications et invité à les accepter pour continuer à utiliser le site.
                                        Merci de respecter ces règles et de contribuer à faire de ce blog une communauté agréable et passionnée autour de la cuisine. Bon partage et bonne découverte !</li>
                                    <li class="tb">Les recettes publiées sur ce site sont rédigées avec soin et testées pour garantir leur qualité et leur faisabilité. Cependant, les photos accompagnant ces recettes sont fournies à titre purement illustratif et sont non contractuelles.</li>
                                </ul>
                                <p class="tb">Merci de respecter ces règles pour garantir une expérience agréable à tous.</p>
                            </div>

                            <!-- Mentions légales -->
                            <div class="tab-pane fade" id="mentions" role="tabpanel" aria-labelledby="mentions-tab">
                                <h6 class="tb">Mentions Légales</h6>
                                <p class="tb">
                                    <strong>Nom du site :</strong>Les p'tits Plats de Lucas et Léa<br>
                                    <strong>Propriétaire :</strong>Y.V.<br>
                                    <strong>Adresse :</strong> Adresse du proprio<br>
                                    <strong>Contact :</strong> contact@petitsplatsgourmands.com<br>
                                    <strong>Hébergeur :</strong> Héroku
                                </p>
                            </div>

                            <!-- RGPD -->
                            <div class="tab-pane fade" id="rgpd" role="tabpanel" aria-labelledby="rgpd-tab">
                                <h6 class="tb">Règlement Général sur la Protection des Données (RGPD)</h6>
                                <p class="tb">
                                    Nous respectons votre vie privée. Les données collectées sur ce site (exemple : formulaire de contact) sont utilisées uniquement pour répondre à vos demandes ou améliorer nos services.
                                </p>
                                <p class="tb">
                                    <strong>Données collectées :</strong> Nom, prénom, email.<br>
                                    <strong>Finalité :</strong> Répondre aux demandes des utilisateurs.<br>
                                    <strong>Durée de conservation :</strong> 1 an après la dernière interaction.
                                </p>
                                <p class="tb">
                                    Vous pouvez exercer vos droits (accès, rectification, suppression) en nous contactant à l'adresse suivante : contact@lespetitsplats.com.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <?php if (isset($script)) : ?>
        <script src=" <?= '/assets/js/' . $script . '.js' ?>"></script>
    <?php endif; ?>
    <?php if (isset($scripts)) : ?>
        <script src="<?= '/assets/js/' . $scripts . '.js' ?>"></script>
    <?php endif; ?>
    <script src="/assets/js/fetchPost.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>