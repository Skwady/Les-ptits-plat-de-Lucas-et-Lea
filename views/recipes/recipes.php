<!-- recipes/recipes.php -->
<?php
$link = "recipe";
$title = 'Liste des Recettes';
?>

<div class="container mt-5 mb-5">
    <?php foreach ($recipes as $recipe): ?>
        <div>
            <h3 class="text-center mb-3 title">
                <?= $recipe->title ? $recipe->title : 'Recette sans titre' ?>
            </h3>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5>• Nombre de portions : <?= $recipe->servings ?></h5>
                        <h5>• Niveau de difficulté : <?= $recipe->difficulty ?></h5>
                        <h5>• Temps de préparation : <?= $recipe->prep_time ?> minutes</h5>
                        <h5>• Temps de cuisson : <?= $recipe->cook_time ? $recipe->cook_time . ' minutes' : 'Aucun' ?></h5>
                        <h5>Ingrédients :</h5>
                        <p><?= nl2br($recipe->ingredients) ?></p>
                        <h5>Instructions :</h5>
                        <p><?= nl2br($recipe->instructions) ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="img">
                    <img src="<?= $recipe->slug ?>" alt="Image de la recette" class="mb-4">
                </div>
                <div class="d-flex justify-content-between mt-3">
                    <button class="btn">Like</button>
                    <button class="btn">Commentaire</button>
                    <button class="btn">Partager</button>
                </div>
            </div>
            <div class="d-flex flex-end">
                <a href="/recipes/updateRecipe/<?= $recipe->id ?>" class="btn">modifier</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>