<?php
$title = 'Ajouter une Recette';
?>

<form method="post" action="/Recipes/addRecipe" enctype="multipart/form-data" class="container mt-4">
    <div class="mb-3">
        <label for="title" class="form-label">Titre :</label>
        <input type="text" class="form-control" id="title" name="title" maxlength="255" required>
    </div>

    <div class="mb-3">
        <label for="type" class="form-label">Type :</label>
        <input type="text" class="form-control" id="type" name="type" maxlength="50" required>
    </div>

    <div class="mb-3">
        <label for="servings" class="form-label">Nombre de portions :</label>
        <input type="number" class="form-control" id="servings" name="servings" min="1" required>
    </div>

    <div class="mb-3">
        <label for="difficulty" class="form-label">Difficulté :</label>
        <select class="form-select" id="difficulty" name="difficulty" required>
            <option value="facile">Facile</option>
            <option value="moyen">Moyen</option>
            <option value="difficile">Difficile</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="prep_time" class="form-label">Temps de préparation (en minutes) :</label>
        <input type="number" class="form-control" id="prep_time" name="prep_time" min="0" required>
    </div>

    <div class="mb-3">
        <label for="cook_time" class="form-label">Temps de cuisson (en minutes) :</label>
        <input type="number" class="form-control" id="cook_time" name="cook_time" min="0" required>
    </div>

    <div class="mb-3">
        <label for="ingredients" class="form-label">Ingrédients :</label>
        <textarea class="form-control" id="ingredients" name="ingredients" rows="5" required></textarea>
    </div>

    <div class="mb-3">
        <label for="instructions" class="form-label">Instructions :</label>
        <textarea class="form-control" id="instructions" name="instructions" rows="5" required></textarea>
    </div>

    <div class="mb-3">
        <label for="image" class="form-label">Photo :</label>
        <input type="file" class="form-control" id="image" name="image" accept="image/*">
    </div>

    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
    <button type="submit" class="btn btn-primary">Soumettre la recette</button>
</form>
<div id="error-message" class="alert alert-danger" role="alert"></div>