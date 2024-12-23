<?php

namespace App\controllers;

use App\services\CloudinaryService;
use App\repository\CommentRepository;
use App\repository\FavoriteRepository;
use App\repository\RecipeRepository;
use App\repository\TypeRepository;
use App\repository\LikeRepository;
use App\services\RecipeService;

class RecipesController extends Controller
{
    public function listRecipes($type)
    {
        $recipeRepository = new RecipeRepository();
        $userId = $_SESSION['id'] ?? null;
        $isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'Admin';

        // Récupérer toutes les recettes par type
        $recipes = $recipeRepository->selectRecipeByType($type);

        $likeRepository = new LikeRepository();
        $favoriteRepository = new FavoriteRepository();
        $commentRepository = new CommentRepository();

        foreach ($recipes as $recipe) {
            $recipe->like_count = $likeRepository->countLikes($recipe->id);
            $recipe->is_favorited = $userId ? $favoriteRepository->findBy(['user_id' => $userId, 'recipe_id' => $recipe->id]) : false;
            $recipe->is_liked = $userId ? !empty($likeRepository->findBy(['user_id' => $userId, 'recipe_id' => $recipe->id])) : false;

            $comments = $commentRepository->findBy(['recipe_id' => $recipe->id]);
            foreach ($comments as &$comment) {
                $comment->is_own_comment = $comment->user_id === $userId;
            }
            $recipe->comments = $comments;
        }

        $this->render('recipes/recipes', [
            'recipes' => $recipes,
            'type' => $type,
            'isAdmin' => $isAdmin,
        ]);
    }

    public function addRecipe()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            $recipeService = new RecipeService();
            $recipeService->addRecipe($data);
        }
         
        $typeRepository = new TypeRepository();
        $types = $typeRepository->findAll();
        $this->render('recipes/add', ['types' => $types]);
    }

    public function updateRecipe($recipeId)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {     
            $data = $_POST;
            $recipeService = new RecipeService();
            $recipeService->updateRecipe($recipeId, $data);
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

    public function viewRecipe($id)
    {
        $recipeRepository = new RecipeRepository();
        $recipe = $recipeRepository->find($id);

        if (!$recipe) {
            http_response_code(404);
            echo "Recette introuvable.";
            exit();
        }

        $this->render('recipes/view', ['recipe' => $recipe]);
    }

}