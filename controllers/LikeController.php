<?php

namespace App\controllers;

use App\models\LikeModel;

class LikeController extends Controller
{
    public function addLike($recipeId, $type)
    {
        $userId = $_SESSION['id'];
        $likeModel = new LikeModel();

        $existingLike = $likeModel->selectBy(['user_id' => $userId, 'recipe_id' => $recipeId]);

        if (empty($existingLike)) {
            $likeModel->hydrate([
                'user_id' => $userId,
                'recipe_id' => $recipeId,
            ])->create();
        }

        header("Location: /recipes/listRecipes/$type#$recipeId");
        exit();
    }

    public function removeLike($recipeId, $type)
    {
        $userId = $_SESSION['id'];
        $likeModel = new LikeModel();

        $existingLike = $likeModel->selectBy(['user_id' => $userId, 'recipe_id' => $recipeId]);

        if (!empty($existingLike)) {
            $likeModel->delete($existingLike[0]->id);
        }

        header("Location: /recipes/listRecipes/$type#$recipeId");
        exit();
    }
}