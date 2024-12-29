<!-- user/profile.php -->
<?php $title = 'Mon Profil'; ?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Mon Profil</h2>
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0 text-center">Informations du Profil</h4>
        </div>
        <div class="card-body">
            <!-- Nom -->
            <p><strong>Nom :</strong> <?= $profile->name ?></p>
            <!-- Prénom -->
            <p><strong>Prénom :</strong> <?= $profile->firstname ?></p>
            <!-- Email -->
            <p><strong>Email :</strong> <?= $profile->email ?></p>
            <!-- Date de naissance (affichée uniquement si disponible) -->
            <?php if (!empty($profile->date_of_birth)): 
                $date = new DateTime($profile->date_of_birth);
            ?>
                <p><strong>Date de naissance :</strong> <?= $date->format('d/m/Y'); ?></p>
            <?php endif; ?>
            <!-- Bio (affichée uniquement si disponible) -->
            <?php if (!empty($profile->bio)): ?>
                <p><strong>Bio :</strong> <?= nl2br($profile->bio) ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>
