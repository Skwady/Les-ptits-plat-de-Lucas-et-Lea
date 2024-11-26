<section class="profile container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <aside class="col-12 col-md-2 profile-sidebar bg-light">
            <h2 class="text-center d-md-block d-none">Menu du Profil</h2>
            <button class="btn btn-primary w-100 d-md-none mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#profileMenu" aria-expanded="false" aria-controls="profileMenu">
                Menu du Profil
            </button>
            <div class="collapse d-md-block" id="profileMenu">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="/profile/viewProfile/<?= $_SESSION['id'] ?>" class="nav-link">Tableau de bord</a>
                    </li>
                    <li class="nav-item">
                        <a href="/profile/updateProfile/<?= $_SESSION['id'] ?>" class="nav-link">Modifier le profil</a>
                    </li>
                    <li class="nav-item">
                        <a href="/profile/viewRecipeFavorite/<?= $_SESSION['id'] ?>" class="nav-link">Recettes favorites</a>
                    </li>
                    <li class="nav-item">
                        <a href="/profile/activity/<?= $_SESSION['id'] ?>" class="nav-link">Fil d'actualité</a>
                    </li>
                    <li class="nav-item">
                        <a href="/logout" class="nav-link">Déconnexion</a>
                    </li>
                </ul>
            </div>
        </aside>

        <!-- Profile Content -->
        <div class="col-12 col-md-10 profile-content">
            <!-- Contenu spécifique au profil -->
            <?= $profileContent ?>
        </div>
    </div>
</section>