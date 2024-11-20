<?php

namespace App\controllers;

use App\models\LikeModel;
use App\repository\LikeRepository;

class LikeController extends Controller
{
    public function addLike($recipeId, $type)
    {
        $userId = $_SESSION['id'];
        $likeModel = new LikeModel();
        $likeRepository = new LikeRepository();

        $existingLike = $likeRepository->findBy(['user_id' => $userId, 'recipe_id' => $recipeId]);

        $data = [
            'user_id' => $userId,
            'recipe_id' => $recipeId,
        ];
        if (empty($existingLike)) {
            $likeModel->hydrate($data);
            $likeRepository->create($data);
        }

        header("Location: /recipes/listRecipes/$type#$recipeId");
        exit();
    }

    public function removeLike($recipeId, $type)
    {
        $userId = $_SESSION['id'];
        $likeRepository = new LikeRepository();

        $existingLike = $likeRepository->findBy(['user_id' => $userId, 'recipe_id' => $recipeId]);

        if (!empty($existingLike)) {
            $likeRepository->delete($existingLike[0]->id);
        }

        header("Location: /recipes/listRecipes/$type#$recipeId");
        exit();
    }
}