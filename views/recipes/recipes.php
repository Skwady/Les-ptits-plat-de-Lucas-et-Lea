<?php
$link = "recipe";
$title = 'Liste des Recettes';
?>

<div class="notification" id="notification">Recette ajoutée à vos favoris</div>
<div class="notifications" id="notifications">Merci pour votre j'aime</div>
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
                <div class="d-flex justify-content-evenly mt-1">
                    <a href="#"><i class="fa-regular fa-heart heart-icon"></i></a>
                    <a href="#"><i class="fa-regular fa-thumbs-up heart-gradient"></i></a>
                    <a href="#"><i class="fa-solid fa-comment heart-gradient"></i></a>
                    <a href="#"><i class="fa-solid fa-share-nodes heart-gradient"></i></a>
                </div>

                <!-- Scrollable Comments Section -->
                <div class="comments-container mt-3">
                    <?php if (!empty($recipe->content)): ?>
                        <?php foreach (array_slice($recipe->content, 0, 3) as $comment): ?> <!-- Limit to 3 displayed comments -->
                            <div class="card mt-2">
                                <div class="card-body">
                                    <p><?= htmlspecialchars($comment->content) ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>pas de commentaire</p>
                    <?php endif; ?>
                </div>

                <?php if ($_SESSION['id']): ?>
                    <form action="/recipes/comment" method="POST">
                        <input type="hidden" name="recipe_id" value="<?= $recipe->id ?>">
                        <input type="hidden" name="user_id" value="<?= $_SESSION['id'] ?>">
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                        <textarea type="text" name="comments" maxlength="150" placeholder="Votre commentaire Maximum 150 caractères" class="form-control mt-3"></textarea>
                        <button class="btn mt-1">Envoyer</button>
                    </form>
                <?php endif; ?>
            </div>
            <div class="d-flex flex-end">
                <a href="/recipes/updateRecipe/<?= $recipe->id ?>" class="btn">modifier</a>
                <a href="/recipes/deleteRecipe/<?= $recipe->id ?>" class="btn" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette recette ?')">Supprimer</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php $script = 'recipesTime'; ?>
<?php $scripts = 'clickColor'; ?>