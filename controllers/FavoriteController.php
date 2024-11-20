<?php

namespace App\controllers;

use App\models\FavoriteModel;
use App\repository\FavoriteRepository;

class FavoriteController extends Controller
{
    public function addFavorite($recipeId, $type)
    {
        $userId = $_SESSION['id']; // ID de l'utilisateur connecté
        $favoriteModel = new FavoriteModel();
        $favoriteRepository = new FavoriteRepository();

        // Vérifie si le favori existe déjà
        $existingFavorite = $favoriteRepository->findBy(['user_id' => $userId, 'recipe_id' => $recipeId]);

        $data = [
            'user_id' => $userId,
            'recipe_id' => $recipeId,
        ];

        if (empty($existingFavorite)) {
            $favoriteModel->hydrate($data);
            $favoriteRepository->create($data);
        }

        header("Location: /recipes/listRecipes/$type#$recipeId");
        exit();
    }

    public function removeFavorite($recipeId, $type)
    {
        $userId = $_SESSION['id']; // ID de l'utilisateur connecté
        $favoriteRepository = new FavoriteRepository();

        // Supprime le favori
        $existingFavorite = $favoriteRepository->findBy(['user_id' => $userId, 'recipe_id' => $recipeId]);

        if (!empty($existingFavorite)) {
            $favoriteRepository->delete($existingFavorite[0]->id);
        }

        header("Location: /recipes/listRecipes/$type#$recipeId");
        exit();
    }

    public function viewFavorites()
    {
        $userId = $_SESSION['id'];
        $favoriteRepository = new FavoriteRepository();

        $favorites = $favoriteRepository->findBy(['user_id' => $userId]);

        $this->render('profile/favorites', ['favorites' => $favorites]);
    }
}
