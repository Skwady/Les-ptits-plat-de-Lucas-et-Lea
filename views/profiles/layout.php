<section class="profile container-fluid mt-4">
    <div class="row">
        <!-- Sidebar -->
        <aside class="col-12 col-md-3 col-lg-2 bg-light border-end profile-sidebar">
            <!-- Photo de profil (affichée uniquement si disponible) -->
            <?php if (!empty($profile->profile_picture)): ?>
                <div class="text-center pdp mb-3">
                    <img src="<?= $profile->profile_picture ?>" class="img-fluid rounded" alt="Photo de profil">
                </div>
            <?php endif; ?>
            <!-- Bouton toggle pour mobile -->
            <button class="btn btn-primary w-100 d-md-none mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#profileMenu" aria-expanded="false" aria-controls="profileMenu"></button>
            <!-- Menu de navigation -->
            <div class="collapse d-md-block" id="profileMenu">
                <ul class="nav flex-column py-2">
                    <li class="nav-item">
                        <a href="/profile/viewProfile/<?= $_SESSION['id'] ?>" class="nav-link text-dark">Tableau de bord</a>
                    </li>
                    <li class="nav-item">
                        <a href="/profile/updateProfile/<?= $_SESSION['id'] ?>" class="nav-link text-dark">Modifier le profil</a>
                    </li>
                    <li class="nav-item">
                        <a href="/profile/viewRecipeFavorite/<?= $_SESSION['id'] ?>" class="nav-link text-dark">Recettes favorites</a>
                    </li>
                    <li class="nav-item">
                        <a href="/profile/activity/<?= $_SESSION['id'] ?>" class="nav-link text-dark">Fil d'actualité</a>
                    </li>
                    <li class="nav-item">
                        <a href="/logout" class="nav-link text-danger">Déconnexion</a>
                    </li>
                </ul>
            </div>
        </aside>

        <!-- Profile Content -->
        <div class="col-12 col-md-9 col-lg-10 profile-content p-4">
            <!-- Contenu spécifique au profil -->
            <?= $profileContent ?>
        </div>
    </div>
</section>
