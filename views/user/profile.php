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

<div class="container">
    <h3>Recettes favorites</h3>
    <?php if (!empty($favorites)): ?>
        <div class="row">
            <?php foreach ($favorites as $recipe): ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="<?= $recipe->slug ?>" class="card-img-top" alt="<?= $recipe->title ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($recipe->title) ?></h5>
                            <a href="/recipes/view/<?= $recipe->id ?>" class="btn btn-primary">Voir la recette</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>Aucune recette favorite pour le moment.</p>
    <?php endif; ?>
</div>
