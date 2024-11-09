<?php

namespace App\controllers;

use App\config\CloudinaryService;
use App\models\RecipeModel;
use Cloudinary\Transformation\Resize;

class RecipesController extends Controller
{
    public function listRecipes()
    {
        $recipeModel = new RecipeModel();
        $recipes = $recipeModel->selectAll();
        foreach ($recipes as &$recipe) {
            if (isset($recipe['photo'])) {
                $recipe['photo'] = $recipe['photo']; // Adjust the URL if needed for display
            }
        }
        $this->render('recipes/recipes', ['recipes' => $recipes]);
    }

    public function viewRecipe($recipeId)
    {
        $recipeModel = new RecipeModel();
        $recipe = $recipeModel->select($recipeId);
        if ($recipe && isset($recipe['photo'])) {
            $recipe['photo'] = $recipe['photo']; // Adjust the URL if needed for display
        }
        $this->render('recipes/view', ['recipe' => $recipe]);
    }

    public function addRecipe()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $recipeModel = new RecipeModel();
            $photoUrl = null;

            if (isset($_FILES['photo']) && $_FILES['photo']['tmp_name']) {
                $cloudinary = new CloudinaryService();
                $uploadResult = $cloudinary->uploadFile(
                    $_FILES['photo']['tmp_name'],
                    [
                        'folder' => 'recipes',
                        'transformation' => [
                            'resize' => new Resize('scale', 800, 600)
                        ]
                    ]
                );
                $photoUrl = $uploadResult['secure_url'];
            }

            $recipeModel->hydrate([
                'title' => $_POST['title'],
                'type' => $_POST['type'],
                'servings' => $_POST['servings'],
                'difficulty' => $_POST['difficulty'],
                'prep_time' => $_POST['prep_time'],
                'cook_time' => $_POST['cook_time'],
                'ingredients' => $_POST['ingredients'],
                'instructions' => $_POST['instructions'],
                'photo' => $photoUrl
            ])->create();

            header("Location: /recipes");
            exit();
        }

        $this->render('recipes/add');
    }

    public function updateRecipe($recipeId)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $recipeModel = new RecipeModel();
            $photoUrl = null;

            if (isset($_FILES['photo']) && $_FILES['photo']['tmp_name']) {
                $cloudinary = new CloudinaryService();
                $uploadResult = $cloudinary->uploadFile(
                    $_FILES['photo']['tmp_name'],
                    [
                        'folder' => 'recipes',
                        'transformation' => [
                            'resize' => new Resize('scale', 800, 600)
                        ]
                    ]
                );
                $photoUrl = $uploadResult['secure_url'];
            }

            $recipeModel->hydrate([
                'title' => $_POST['title'],
                'type' => $_POST['type'],
                'servings' => $_POST['servings'],
                'difficulty' => $_POST['difficulty'],
                'prep_time' => $_POST['prep_time'],
                'cook_time' => $_POST['cook_time'],
                'ingredients' => $_POST['ingredients'],
                'instructions' => $_POST['instructions'],
                'photo' => $photoUrl
            ])->update($recipeId);

            header("Location: /recipes/view/" . $recipeId);
            exit();
        }

        $this->render('recipes/edit', ['recipeId' => $recipeId]);
    }

    public function deleteRecipe($recipeId)
    {
        $recipeModel = new RecipeModel();
        $recipe = $recipeModel->select($recipeId);

        if ($recipe && $recipe['photo']) {
            $publicId = pathinfo($recipe['photo'], PATHINFO_FILENAME);
            $cloudinary = new CloudinaryService();
            $cloudinary->deleteFile($publicId);
        }

        $recipeModel->delete($recipeId);
        header("Location: /recipes");
        exit();
    }
}