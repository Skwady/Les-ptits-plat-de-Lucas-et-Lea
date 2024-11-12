<!-- recipes/recipes.php -->
<?php
$link = "recipe";
$title = 'Liste des Recettes';
?>

<div class="container mt-5 mb-5">
    <?php foreach ($recipes as $recipe): ?>
        <div>
            <h3 class="text-center mb-3 title py-3">
                <?= $recipe->title ? $recipe->title : 'Recette sans titre' ?>
            </h3>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5>• Nombre de portions : <?= $recipe->servings ?></h5>
                        <h5>• Niveau de difficulté : <?= $recipe->difficulty ?></h5>
                        <h5>• Temps de préparation : <span data-prep-time="<?= $recipe->prep_time ?>"></span></h5>
                        <h5>• Temps de cuisson : <span data-cook-time="<?= $recipe->cook_time ?>"></span></h5>
                        <h5>• Temps de repos : <span data-rest-time="<?= $recipe->rest_time ?>"></span></h5>
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
                <div>
                    <div class="card mt-2">
                        <div class="card-body">
                            <p><?= $recipe->content ? $recipe->content : 'pas de commentaire' ?></p>
                        </div>
                    </div>
                    <?php if($_SESSION['id']): ?>
                    <form action="/recipes/comment" method="POST">
                        <input type="hidden" name="recipe_id" value="<?= $recipe->id ?>">
                        <input type="hidden" name="user_id" value="<?= $_SESSION['id'] ?>">
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                        <input type="text" name="comments" placeholder="Votre commentaire" class="form-control mt-3">
                        <button class="btn">Envoyer</button>
                    </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="d-flex flex-end gap-3 mb-5">
            <a href="/recipes/updateRecipe/<?= $recipe->id ?>" class="btn">Modifier</a>
            <a href="/recipes/deleteRecipe/<?= $recipe->id ?>" class="btn" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette recette ?')">Supprimer</a>
        </div>
    <?php endforeach; ?>
</div>

<?php $script = 'recipesTime'; ?>