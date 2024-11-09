<!-- recipes/recipes.php -->
<?php $title = 'Liste des Recettes'; ?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Recettes</h2>
    <div class="row">
        <?php foreach ($recipes as $recipe): ?>
            <div class="col-md-4">
                <div class="card mb-4">
                    <?php if ($recipe->photo): ?>
                        <img src="/uploads/<?= $recipe->photo ?>" class="card-img-top" alt="<?= $recipe->title ?>">
                    <?php endif; ?>
                    <div class="card-body">
                        <?php if ($recipe->title): ?>
                            <h5 class="card-title"><?= $recipe->title ?></h5>
                        <?php endif; ?>
                        
                        <?php if ($recipe->type): ?>
                            <p class="card-text">Type: <?= $recipe->type ?></p>
                        <?php endif; ?>
                        
                        <a href="/recipes/viewRecipe/<?= $recipe->id ?>" class="btn btn-primary">Voir la recette</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>