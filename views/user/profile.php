<!-- user/profile.php -->
<?php $title = 'Mon Profil'; ?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Mon Profil</h2>
    <div class="card">
        <div class="card-body">
            <p><strong>Nom:</strong> <?= $profile->name ?></p>
            <p><strong>Prénom:</strong> <?= $profile->firstname ?></p>
            <p><strong>Email:</strong> <?= $profile->email ?></p>
            <?php if ($profile->date_of_birth): ?>
                <p><strong>Date de naissance:</strong> <?= $profile->date_of_birth ?></p>
            <?php endif; ?>
            
            <?php if ($profile->bio): ?>
                <p><strong>Bio:</strong> <?= $profile->bio ?></p>
            <?php endif; ?>

            <?php if ($profile->profile_picture): ?>
                <img src="/uploads/<?= $profile->profile_picture ?>" class="img-fluid mb-3" alt="Photo de profil">
            <?php endif; ?>

            <?php if($_SESSION['id'] == $userId): ?>
            <a href="/profile/edit" class="btn btn-primary">Modifier le profil</a>
            <?php endif; ?>
        </div>
    </div>
</div>