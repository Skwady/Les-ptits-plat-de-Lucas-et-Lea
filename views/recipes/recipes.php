<?php
$link = "recipe";
$title = 'Liste des Recettes';
?>

<div class="notification" id="notification">Recette ajoutée à vos favoris</div>
<div class="notifications" id="notifications">Merci pour votre j'aime</div>
<?php foreach ($recipes as $recipe): ?>
    <div class="container mt-5 mb-8">
        <div id="<?= $recipe->id ?> <?= isset($comment->id) ?>">
            <h3 class="text-center mb-3 title parisienne-regular-title">
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
                <?php if (isset($_SESSION['role']) == 'Admin'): ?>
                    <div class="d-flex flex-end mb-8 gap-2">
                        <a href="/recipes/updateRecipe/<?= $recipe->id ?>/<?= $recipe->type_id ?>" class="btn">modifier</a>
                        <a href="/recipes/deleteRecipe/<?= $recipe->id ?>/<?= $recipe->type_id ?>" class="btn" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette recette ?')">Supprimer</a>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-md-4">
                <div class="img">
                    <img src="<?= $recipe->slug ?>" alt="Image de la recette" class="mb-4">
                </div>
                <div class="d-flex justify-content-evenly mt-1">
                    <?php if (isset($_SESSION['id'])): ?>
                        <?php if (!$recipe->is_favorited): ?>
                            <a href="/favorite/addFavorite/<?= $recipe->id ?>/<?= $recipe->type_id ?>"><i class="fa-regular fa-heart heart-icon"></i></a>
                        <?php else: ?>
                            <a href="/favorite/removeFavorite/<?= $recipe->id ?>/<?= $recipe->type_id ?>"><i class="fa-regular fa-heart heart-icon filled"></i></a>
                        <?php endif; ?>
                        <span><?= $recipe->like_count ?> likes</span>
                        <?php if (!$recipe->is_liked): ?>
                            <a href="/like/addLike/<?= $recipe->id ?>/<?= $recipe->type_id ?>"><i class="fa-regular fa-thumbs-up heart-gradient"></i></a>
                        <?php else: ?>
                            <a href="/like/removeLike/<?= $recipe->id ?>/<?= $recipe->type_id ?>"><i class="fa-regular fa-thumbs-up heart-gradient filled"></i></a>
                        <?php endif; ?>
                    <?php endif; ?>
                    <a href="/comment/addComment/<?= $recipe->id ?>/<?= $recipe->type_id ?>"><i class="fa-solid fa-comment heart-gradient"></i></a>
                    <a href="/comment/removeComment/<?= $recipe->id ?>/<?= $recipe->type_id ?>"><i class="fa-solid fa-share-nodes heart-gradient fill"></i></a>
                </div>

                <?php
                $comments = isset($recipe->content) ? explode('||', $recipe->content) : [];
                ?>
                <!-- Scrollable Comments Section -->
                <div class="comments-container mt-3">
                    <?php if (!empty($comments)): ?>
                        <div class="scrollable-comments">
                            <?php foreach ($comments as $comment): ?>
                                <div class="card mt-2">
                                    <div class="card-body">
                                        <p><?= htmlspecialchars($comment) ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p>Pas de commentaire</p>
                    <?php endif; ?>
                </div>
                <div class="comments-form">
                    <?php if (isset($_SESSION['id'])): ?>
                        <form action="/Comment/addComment/<?= $recipe->id ?>/<?= $recipe->type_id ?>" method="POST">
                            <textarea type="text" name="content" maxlength="150" placeholder="Votre commentaire Maximum 150 caractères" class="form-control mt-3"></textarea>
                            <input type="hidden" name="recipe_id" value="<?= $recipe->id ?>">
                            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                            <button type="submit" class="btn mt-1">Envoyer</button>
                            <div id="error-message" class="alert alert-danger" role="alert"></div>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?php $script = 'recipesTime'; ?>
<?php $scripts = 'comment'; ?>