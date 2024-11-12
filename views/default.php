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
    <link rel="stylesheet" href="/assets/css/<?php if (isset($link)) {echo $link;} ?>.css">
    <title><?php if (isset($title)) {echo $title;} ?></title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-gradiant">
        <div class="container-fluid">
            <a class="navbar-brand logo d-block" href="/"><img src="/assets/img/logoNav.png" alt="LOGO"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
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
                        <a class="nav-link" href="#">
                            <h4>Conseils et astuces</h4>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/contact">
                            <h4>Contact</h4>
                        </a>
                    </li>
                    </li>
                    <?php if(isset($_SESSION['id'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/profile/viewProfile/<?= $_SESSION['id'] ?>">
                            <h4>Profile</h4>
                        </a>
                    </li>
                    
                    <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/login">
                            <h4>Connexion</h4>
                        </a>
                    </li>
                    <?php endif; ?>

                    <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'Admin'): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#" id="recettesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <h4>recette</h4>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="recettesDropdown">
                                <li><a class="dropdown-item" href="/recipes/addRecipe">Ajouter une recette</a></li>
                                <li><a class="dropdown-item" href="/recipes/listRecipes">liste des recettes</a></li>
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

    <footer>
        <h3 class="text-center">&copy Copyright</h3>
    </footer>

    <script src="<?php if (isset($script)) {echo '/assets/js/'.$script.'.js';} ?>"></script>
    <script src="<?php if (isset($scripts)) {echo '/assets/js/'.$scripts.'.js';} ?>"></script>
    <script src="/assets/js/fetchPost.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>