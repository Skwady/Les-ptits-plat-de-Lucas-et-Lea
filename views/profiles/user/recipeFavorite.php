<div class="container mt-5">
    <h3 class="text-center">Recettes favorites</h3>
    <?php if (!empty($favorites)): ?>
        <div class="row">
            <?php foreach ($favorites as $recipe): ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="<?= $recipe->slug ?>" class="card-img-top" alt="<?= $recipe->title ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= $recipe->title ?></h5>
                            <a href="/recipes/listRecipes/<?= $recipe->type_id ?>#<?= $recipe->id ?>" class="btn btn-primary">Voir la recette</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="text-center">Aucune recette favorite pour le moment.</p>
    <?php endif; ?>
</div>
