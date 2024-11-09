<?php

namespace App\controllers;

use App\models\CommentModel;

class CommentController extends Controller
{
    public function addComment($recipeId)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['id'];
            $content = $_POST['content'];
            $commentModel = new CommentModel();
            $commentModel->hydrate(['user_id' => $userId, 'recipe_id' => $recipeId, 'content' => $content])->create();
            header("Location: /recipes/view/" . $recipeId);
            exit();
        }
    }
}