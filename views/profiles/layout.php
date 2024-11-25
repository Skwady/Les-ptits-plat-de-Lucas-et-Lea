<section class="profile">
    <aside class="profile-sidebar">
        <h2>Menu du Profil</h2>
        <ul>
            <li><a href="/profile/viewProfile/<?= $_SESSION['id'] ?>">Tableau de bord</a></li>
            <li><a href="/profile/updateProfile/<?= $_SESSION['id'] ?>">Modifier le profil</a></li>
            <li><a href="/profile/activity/<?= $_SESSION['id'] ?>">Fil d'actualité</a></li>
            <li><a href="/logout">Déconnexion</a></li>
        </ul>
    </aside>
    <div class="profile-content">
        <!-- Contenu spécifique au profil -->
        <?= $profileContent ?>
    </div>
</section>
