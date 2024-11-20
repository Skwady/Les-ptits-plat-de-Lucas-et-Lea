<?php

namespace App\controllers;

use App\config\CloudinaryService;
use App\models\RecipeModel;
use App\repository\CommentRepository;
use App\repository\FavoriteRepository;
use App\repository\RecipeRepository;
use App\repository\TypeRepository;
use App\repository\LikeRepository;

class RecipesController extends Controller
{
    public function listRecipes($type)
    {
        $recipeRepository = new RecipeRepository();
        $userId = $_SESSION['id'] ?? null; // ID de l'utilisateur connecté, ou null si non connecté

        // Récupérer toutes les recettes par type
        $recipes = $recipeRepository->selectRecipeByType($type);

        $likeRepository = new LikeRepository();
        $favoriteRepository = new FavoriteRepository();
        $commentRepository = new CommentRepository();

        // Ajouter les informations supplémentaires pour chaque recette
        foreach ($recipes as $recipe) {
            $recipe->like_count = $likeRepository->countLikes($recipe->id); // Nombre de likes
            $recipe->is_favorited = $userId ? $favoriteRepository->findBy(['user_id' => $userId, 'recipe_id' => $recipe->id]) : false;
            $recipe->is_liked = $userId ? !empty($likeRepository->findBy(['user_id' => $userId, 'recipe_id' => $recipe->id])) : false;
            $recipe->is_comment = $userId ? !empty($commentRepository->findBy(['user_id' => $userId, 'recipe_id' => $recipe->id])) : false;
        }

        $comments = new CommentRepository();
        $comments->findBy(['user_id' => $userId, 'recipe_id' => $recipe->id]);

        $this->render('recipes/recipes', ['recipes' => $recipes, 'type' => $type, 'comments' => $comments]);
    }

    public function addRecipe()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
                        $cookTime = empty($_POST['cook_time']) ? null : $_POST['cook_time'];
                        $restTime = empty($_POST['rest_time']) ? null : $_POST['rest_time'];

                        $data = [
                                'title' => $_POST['title'],
                                'type_id' => $_POST['type_id'],
                                'servings' => $_POST['servings'],
                                'difficulty' => $_POST['difficulty'],
                                'prep_time' => $_POST['prep_time'],
                                'cook_time' => $cookTime,
                                'rest_time' => $restTime,
                                'ingredients' => $_POST['ingredients'],
                                'instructions' => $_POST['instructions'],
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

        $typeRepository = new TypeRepository();
        $types = $typeRepository->findAll();
        $this->render('recipes/add', ['types' => $types]);
    }

    public function updateRecipe($recipeId, $type)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
            $cookTime = empty($_POST['cook_time']) ? null : $_POST['cook_time'];
            $restTime = empty($_POST['rest_time']) ? null : $_POST['rest_time'];

            $data = [
                'title' => $_POST['title'],
                'type_id' => $_POST['type_id'],
                'servings' => $_POST['servings'],
                'difficulty' => $_POST['difficulty'],
                'prep_time' => $_POST['prep_time'],
                'cook_time' => $cookTime,
                'rest_time' => $restTime,
                'ingredients' => $_POST['ingredients'],
                'instructions' => $_POST['instructions'],
                'slug' => $slug ?? null
            ];
            // Hydrater et mettre à jour la recette
            $recipeModel->hydrate($data);
            $reciperepository->update($recipeId, $data);

            echo json_encode(['success' => true, 'redirect' => '/recipes/listRecipes/' . $type . '#' . $recipeId]);
            exit();
        }

        // Charger les types pour le champ de sélection
        $typeRepository = new TypeRepository();
        $recipeRepository = new RecipeRepository();
        $types = $typeRepository->findAll();
        $recipe = $recipeRepository->find($recipeId);

        $this->render('recipes/edit', ['types' => $types, 'recipe' => $recipe, 'recipeId' => $recipeId]);
    }

    public function deleteRecipe($recipeId, $type)
    {
        $recipeRepository = new RecipeRepository();
        $recipe = $recipeRepository->find($recipeId);

        if ($recipe && !empty($recipe->slug)) {
            $publicId = pathinfo($recipe->slug, PATHINFO_FILENAME);
            $cloudinary = new CloudinaryService();
            $cloudinary->deleteFile($publicId);
        }

        $recipeRepository->delete($recipeId);
        header("Location: /recipes/listRecipes/$type");
        exit();
    }
}