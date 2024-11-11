<?php

namespace App\controllers;

use App\config\CloudinaryService;
use App\models\RecipeModel;
use App\models\TypeModel;
use Cloudinary\Transformation\Resize;

class RecipesController extends Controller
{
    public function listRecipes($type)
    {
        $recipeModel = new RecipeModel();
        $recipes = $recipeModel->selectRecipeByType($type);

        $this->render('recipes/recipes', ['recipes' => $recipes, 'type' => $type]);
    }

    public function addRecipe()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $recipeModel = new RecipeModel();
            $cloudinaryService = new CloudinaryService();

            if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
                $image = $_FILES['image'];

                // Vérifier le type de fichier
                $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];
                if (in_array($image['type'], $allowedTypes)) {
                    // Télécharger l'image sur Cloudinary
                    $fileUrl = $cloudinaryService->uploadFile($image['tmp_name']);
                    if ($fileUrl) {
                        // Utiliser l'URL de l'image comme slug
                        $slug = $fileUrl;

                        // Créer une nouvelle recette avec les données du formulaire
                        $recipeModel->hydrate([
                            'title' => $_POST['title'],
                            'type_id' => $_POST['type_id'], // Utiliser `type_id` au lieu de `type`
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

        // Charger les types pour le champ de sélection
        $typeModel = new TypeModel();
        $types = $typeModel->selectAll();

        $this->render('recipes/add', ['types' => $types]);
    }

    public function updateRecipe($recipeId)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $recipeModel = new RecipeModel();
            $cloudinaryService = new CloudinaryService();

            // Récupérer la recette existante
            $recipe = $recipeModel->select($recipeId);

            // Vérifier si une nouvelle image est envoyée
            if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
                $image = $_FILES['image'];

                // Vérifier le type de fichier
                $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];
                if (in_array($image['type'], $allowedTypes)) {

                    // Supprimer l'ancienne image de Cloudinary si elle existe
                    if ($recipe->slug) {
                        // Extraire le public_id de l'URL de l'ancienne image
                        $oldImageUrl = $recipe->slug; // L'URL de l'ancienne image
                        $publicId = $cloudinaryService->getPublicIdFromUrl($oldImageUrl); // Méthode qui extrait le public_id

                        if ($publicId) {
                            // Supprimer l'image depuis Cloudinary
                            $cloudinaryService->deleteFile($publicId);
                        }
                    }

                    // Télécharger la nouvelle image sur Cloudinary
                    $fileUrl = $cloudinaryService->uploadFile($image['tmp_name']);
                    if ($fileUrl) {
                        // Utiliser l'URL de l'image comme slug
                        $slug = $fileUrl;

                        // Mettre à jour la recette avec la nouvelle image
                        $recipeModel->hydrate([
                            'title' => $_POST['title'],
                            'type' => $_POST['type'],
                            'servings' => $_POST['servings'],
                            'difficulty' => $_POST['difficulty'],
                            'prep_time' => $_POST['prep_time'],
                            'cook_time' => $_POST['cook_time'],
                            'ingredients' => $_POST['ingredients'],
                            'instructions' => $_POST['instructions'],
                            'slug' => $slug, // Nouvelle image
                            'recipes_id' => $_POST['recipes_id']
                        ])->update($recipeId);

                        echo json_encode(['success' => true, 'redirect' => '/recipes/edit/' . $recipeId]);
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
                // Si pas de nouvelle image, simplement mettre à jour les autres champs
                $recipeModel->hydrate([
                    'title' => $_POST['title'],
                    'type' => $_POST['type'],
                    'servings' => $_POST['servings'],
                    'difficulty' => $_POST['difficulty'],
                    'prep_time' => $_POST['prep_time'],
                    'cook_time' => $_POST['cook_time'],
                    'ingredients' => $_POST['ingredients'],
                    'instructions' => $_POST['instructions'],
                    'recipes_id' => $_POST['recipes_id']
                ])->update($recipeId);

                echo json_encode(['success' => true, 'redirect' => '/recipes/edit/' . $recipeId]);
                exit();
            }
        }

        $recipeModel = new RecipeModel();
        $typeModel = new TypeModel();
        $types = $typeModel->selectAll();
        $recipes = $recipeModel->selectAll();

        $this->render('recipes/edit', ['recipes' => $recipes, 'types' => $types, 'recipeId' => $recipeId]);
    }

    public function deleteRecipe($recipeId)
    {
        $recipeModel = new RecipeModel();
        $recipe = $recipeModel->select($recipeId);

        if ($recipe && !empty($recipe->slug)) {
            $publicId = pathinfo($recipe->slug, PATHINFO_FILENAME);
            $cloudinary = new CloudinaryService();
            $cloudinary->deleteFile($publicId);
        }

        $recipeModel->delete($recipeId);
        header("Location: /recipes");
        exit();
    }
}
