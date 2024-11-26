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

        $this->render('recipes/recipes', 
        [
            'recipes' => $recipes, 
            'type' => $type, 
            'comments' => $comments
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
}