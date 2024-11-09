<?php

namespace App\controllers;

use App\models\LikeModel;

class LikeController extends Controller
{
    public function addLike($recipeId)
    {
        $userId = $_SESSION['id'];
        $likeModel = new LikeModel();
        $likeModel->addLike($userId, $recipeId);
        header("Location: /recipes/view/" . $recipeId);
        exit();
    }

    public function removeLike($recipeId)
    {
        $userId = $_SESSION['id'];
        $likeModel = new LikeModel();
        $likeModel->removeLike($userId, $recipeId);
        header("Location: /recipes/view/" . $recipeId);
        exit();
    }

    public function viewLikedRecipes()
    {
        $userId = $_SESSION['id'];
        $likeModel = new LikeModel();
        $likedRecipes = $likeModel->getLikedRecipesByUser($userId);
        $this->render('recipes/liked', ['likedRecipes' => $likedRecipes]);
    }
}