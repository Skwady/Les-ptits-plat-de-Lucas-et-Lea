<?php 

namespace App\services;

use App\models\RecipeModel;
use App\repository\RecipeRepository;

class RecipeService
{
    public function addRecipe($data)
    {
        $reciperepository = new RecipeRepository();
        $cloudinaryService = new CloudinaryService();
        $recipeModel = new RecipeModel();

        if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
            $image = $_FILES['image'];
            $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];

            if (in_array($image['type'], $allowedTypes)) {
                $fileUrl = $cloudinaryService->uploadFile($image['tmp_name']);
                if ($fileUrl) {
                    $slug = $fileUrl;

                    // Gérer cook_time et rest_time pour éviter 0
                    $cookTime = empty($data['cook_time']) ? null : $data['cook_time'];
                    $restTime = empty($data['rest_time']) ? null : $data['rest_time'];

                    $data = [
                            'title' => $data['title'],
                            'type_id' => $data['type_id'],
                            'servings' => $data['servings'],
                            'difficulty' => $data['difficulty'],
                            'prep_time' => $data['prep_time'],
                            'cook_time' => $cookTime,
                            'rest_time' => $restTime,
                            'ingredients' => $data['ingredients'],
                            'instructions' => $data['instructions'],
                            'slug' => $slug
                    ];

                    $recipeModel->hydrate($data);
                    $reciperepository->create($data);

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

    public function UpdateRecipe($recipeId, $data)
    {
        $reciperepository = new RecipeRepository();
        $recipeRepository = new RecipeRepository();
        $cloudinaryService = new CloudinaryService();
        $recipeModel = new RecipeModel();

        // Récupérer la recette existante
        $recipe = $reciperepository->find($recipeId);

        $slug = $recipe->slug; // Garder l'URL de l'image actuelle par défaut

        // Vérifier si une nouvelle image est envoyée
        if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
            $image = $_FILES['image'];
            $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];

            if (in_array($image['type'], $allowedTypes)) {
                // Supprimer l'ancienne image si une nouvelle est uploadée
                if ($recipe->slug) {
                    $publicId = $cloudinaryService->getPublicIdFromUrl($recipe->slug);
                    if ($publicId) {
                        $cloudinaryService->deleteFile($publicId);
                    }
                }

                // Télécharger la nouvelle image sur Cloudinary
                $fileUrl = $cloudinaryService->uploadFile($image['tmp_name']);
                if ($fileUrl) {
                    $slug = $fileUrl; // Mettre à jour le slug avec la nouvelle URL
                } else {
                    echo json_encode(['success' => false, 'message' => 'Erreur lors de l\'enregistrement de l\'image.']);
                    exit();
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'Le type de fichier n\'est pas autorisé.']);
                exit();
            }
        }

        // Gérer cook_time et rest_time pour éviter 0
        $cookTime = empty($data['cook_time']) ? null : $data['cook_time'];
        $restTime = empty($data['rest_time']) ? null : $data['rest_time'];

        $data = [
            'title' => $data['title'],
            'type_id' => $data['type_id'],
            'servings' => $data['servings'],
            'difficulty' => $data['difficulty'],
            'prep_time' => $data['prep_time'],
            'cook_time' => $cookTime,
            'rest_time' => $restTime,
            'ingredients' => $data['ingredients'],
            'instructions' => $data['instructions'],
            'slug' => $slug ?? null
        ];

        if ($recipe && !empty($recipe->slug)) {
            $publicId = pathinfo($recipe->slug, PATHINFO_FILENAME);
            $cloudinary = new CloudinaryService();
            $cloudinary->deleteFile($publicId);
        }
        
        // Hydrater et mettre à jour la recette
        $recipeModel->hydrate($data);
        $reciperepository->update($recipeId, $data);
        
        $type = $data['type_id'];

        echo json_encode(['success' => true, 'redirect' => '/recipes/listRecipes/' . $type . '#' . $recipeId]);
        exit();
    }
}