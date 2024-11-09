<!-- recipes/view.php -->
<?php $title = 'Détails de la Recette'; ?>

<div class="container mt-5">
    <h2 class="mb-4"><?= $recipe->title ? $recipe->title : 'Recette sans titre' ?></h2>
    <?php if ($recipe->photo): ?>
        <img src="/uploads/<?= $recipe->photo ?>" class="img-fluid mb-4" alt="<?= $recipe->title ?>">
    <?php endif; ?>
    <div class="card">
        <div class="card-body">
            <?php if ($recipe->ingredients): ?>
                <h5>Ingrédients</h5>
                <p><?= nl2br($recipe->ingredients) ?></p>
            <?php endif; ?>
            
            <?php if ($recipe->instructions): ?>
                <h5>Instructions</h5>
                <p><?= $recipe->instructions ?></p>
            <?php endif; ?>

            <a href="/like/add/<?= $recipe->id ?>" class="btn btn-success">J'aime</a>
        </div>
    </div>
</div>