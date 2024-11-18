<?php

namespace App\controllers;

use App\models\FavoriteModel;

class FavoriteController extends Controller
{
    public function addFavorite($recipeId, $type)
    {
        $userId = $_SESSION['id']; // ID de l'utilisateur connecté
        $favoriteModel = new FavoriteModel();

        // Vérifie si le favori existe déjà
        $existingFavorite = $favoriteModel->selectBy(['user_id' => $userId, 'recipe_id' => $recipeId]);

        if (empty($existingFavorite)) {
            $favoriteModel->hydrate([
                'user_id' => $userId,
                'recipe_id' => $recipeId,
            ])->create();
        }

        header("Location: /recipes/listRecipes/$type#$recipeId");
        exit();
    }

    public function removeFavorite($recipeId, $type)
    {
        $userId = $_SESSION['id']; // ID de l'utilisateur connecté
        $favoriteModel = new FavoriteModel();

        // Supprime le favori
        $existingFavorite = $favoriteModel->selectBy(['user_id' => $userId, 'recipe_id' => $recipeId]);

        if (!empty($existingFavorite)) {
            $favoriteModel->delete($existingFavorite[0]->id);
        }

        header("Location: /recipes/listRecipes/$type#$recipeId");
        exit();
    }

    public function viewFavorites()
    {
        $userId = $_SESSION['id'];
        $favoriteModel = new FavoriteModel();

        $favorites = $favoriteModel->selectBy(['user_id' => $userId]);

        $this->render('profile/favorites', ['favorites' => $favorites]);
    }
}
