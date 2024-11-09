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

        $this->render('recipes/recipes', ['recipes' => $recipes]);
    }

    public function addRecipe()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $recipeModel = new RecipeModel();
            $cloudinaryService = new CloudinaryService();

            if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
                $image = $_FILES['image'];

                // Check file type
                $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];
                if (in_array($image['type'], $allowedTypes)) {
                    // Upload the image to Cloudinary
                    $fileUrl = $cloudinaryService->uploadFile($image['tmp_name']);
                    if ($fileUrl) {
                        // Use the image URL as the slug
                        $slug = $fileUrl;

                        $recipeModel->hydrate([
                            'title' => $_POST['title'],
                            'type' => $_POST['type'],
                            'servings' => $_POST['servings'],
                            'difficulty' => $_POST['difficulty'],
                            'prep_time' => $_POST['prep_time'],
                            'cook_time' => $_POST['cook_time'],
                            'ingredients' => $_POST['ingredients'],
                            'instructions' => $_POST['instructions'],
                            'slug' => $slug
                        ])->create();

                        // Retour JSON
                        echo json_encode(['success' => true, 'redirect' => '/recipes/addRecipe']);
                        exit();
                    } else {
                        echo json_encode(['success' => false, 'message' => 'Erreur lors de l\'enregistrement de l\'image.']);
                        exit();
                    }
                } else {
                    echo json_encode(['success' => false, 'message' => 'Le type de fichier n\'est pas autorisé.']);
                    exit();
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Erreur lors de l\'envoi de l\'image.']);
                exit();
            }
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
                $photoUrl = $uploadResult['secure_url'] ?? null;
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

            echo json_encode(["status" => "success", "redirect" => "/recipes/listRecipes"]);
            exit();
        }

        $this->render('recipes/edit', ['recipeId' => $recipeId]);
    }

    public function deleteRecipe($recipeId)
    {
        $recipeModel = new RecipeModel();
        $recipe = $recipeModel->select($recipeId);

        if ($recipe && !empty($recipe['photo'])) {
            $publicId = pathinfo($recipe['photo'], PATHINFO_FILENAME);
            $cloudinary = new CloudinaryService();
            $cloudinary->deleteFile($publicId);
        }

        $recipeModel->delete($recipeId);
        header("Location: /recipes");
        exit();
    }
}
